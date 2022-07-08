<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

use App\Events\User\UploadedVideo;

use App\Phase\VideoTranscoder;

use App\Video;

use Storage;


class VideoController extends Controller
{
    /**
     * Create the video model in the database
     *
     * @param Request $request
     * @return Video|\Illuminate\Database\Eloquent\Model
     */
    public function createVideo(Request $request)
    {
        $video = Video::create([
            'user_id' => $request->has('userid') ? $request->get("userid") : $request->user()->id,
        ]);

        /*if (session()->get("uploading_video_id")) {
            \Log::info("Forget the session key ");
            session()->forget("uploading_video_id");

            \Log::info("old video  session id :: " . session()->get("uploading_video_id"));
        }
        session()->put('uploading_video_id', $video->id);
        session()->save();*/

        $video->refresh();
        //\Log::info("Saved video id :: " . session()->get("uploading_video_id"));
        
        return $video;
    }

    /**
     * Handles the file upload
     *
     * @param Request $request
     * @param FileReceiver $receiver
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws UploadMissingFileException
     *
     */
    public function uploadFile(Request $request)
    {
        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        // receive the file
        $save = $receiver->receive();

        $isLast = ($request->get("resumableChunkNumber") == $request->get("resumableTotalChunks"));

        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            sleep(2);
            // save the file and return any response you need
            $this->saveFile($request, $save->getFile());
        }
        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone()
        ]);
    }

    /**
     * Save / Update the title and description of a video.
     *
     * @param Request $request
     * @param $videoID
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function save(Request $request, $videoID)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);
        $video = Video::findOrFail($videoID);
            $video->fill([
                'title' => $data['title'],
                'description' => $data['description'],
            ])->save();

        event(new UploadedVideo($video));
        
        return $video;

        
    }

    /**
     * Saves & transcodes the file
     *
     * @param Request $request
     * @param UploadedFile $file
     *
     * @return void
     */
    protected function saveFile(Request $request, UploadedFile $file)
    {
        /*$videoID = session()->get('uploading_video_id');
        \Log::info("Retrieved Video Id :: " . $videoID);
        $video = Video::find($videoID);*/
        // _tb TODO: Uncomment these lines. If they are commented, uploaded videos will never be uploded and transcoded!
        $video = Video::where("user_id", auth()->user()->id)->orderByDesc('created_at')->first();
        \Log::info("Retrieved Video Id :: " . $video->id);
        $transcoder = new VideoTranscoder($video, $file);
        $transcoder->makeItHappen();
    }

    public function deleteVideo($id)
    {
        $video = Video::find($id);
        print_r($video->asset->files);die();
        if (!empty($video->asset->files->original->path)) {
            Storage::disk('s3')->delete($video->asset->files->original->path);
        }

        if (!empty($video->asset->files->hls_playlist->path)) {
            Storage::disk('s3')->delete($video->asset->files->hls_playlist->path);
        }

        if (!empty($video->asset->files->video_thumbnail->path)) {
            Storage::disk('s3')->delete($video->asset->files->video_thumbnail->path);
        }

        $video->delete();
        \App\Action::where("item_type", "video")->where("item_id", $id)->delete();

        return "This Video Has Been Deleted";
    }
}
