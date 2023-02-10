<?php

namespace App\Http\Controllers;

use App\Download;
use App\Order;
use App\Release;
use Exception;
use Illuminate\Http\Request;

use App\Track;
use App\User;
use Storage;
use File;

class APIMyMusicController extends Controller
{
    public function getMyMusic(Request $request, $user_id = null)
    {
        $user_id = !empty($user_id) ? $user_id : $request->user()->id;
        if (empty($user_id)) {
            return response('Invalid Request', 403);
        }

        $mymusic = collect();

        $userOrders = Order::where('purchaser_id', $user_id)
            ->where('status', 'complete')
            ->orderByDesc('created_at')
            ->get()->pluck('id');
        $downloads = Download::whereIn('order_id', $userOrders)
            ->with([
                'track',
                'track.release' => function ($query) {
                    $query->select('id', 'name', 'slug', 'featured', 'royalty_fee', 'created_at', 'class', 'uploaded_by', 'status', 'image_id', 'release_date');
                },
                'track.release.uploader' => function ($query) {
                    $query->select('id', 'name', 'path');
                },
                'track.release.image',
                'track.streamable'
            ])
            ->orderByDesc("order_id")
            ->get()->groupBy('track.release_id')->sortByDesc('order_id');
        return array_values($downloads->toArray());
        // Remove items where the user has reached the download limit
        //        for ($i = 0; $i < count($mymusic); $i++) {
        //            if ($mymusic[$i]->count >= 3) {
        //                $mymusic->forget($i);
        //            }
        //        }
    }
    public function getUploadedMusic($user_id = null)
    {
        $uploadedMusic = Release::where('uploaded_by', $user_id)->where('status', 'live')
            ->where('release_date', '<=', date('Y-m-d'))
            ->with([
                'image',
                'tracks',
                'tracks.release',
                'genres',
                'tracks.preview',
                'uploader' => function ($query) {
                    $query->select(['id', 'name', 'path']);
                }
            ])
            ->latest('release_date')
            ->paginate(10);
        return $uploadedMusic;
    }

    public function downloadTrack(Request $request, $format, $trackid)
    {
        $download = $this->userCanDownloadTrack($request->user(), $format, $trackid);

        if ($download) {
            try {
                $url = $download->track->asset->files->filter(function ($file) use ($format) {
                    return (in_array($format, ['mp3', 'wav'])) ? (in_array($file->size, ['mp3', 'wav'])) : ($file->size == $format);
                })->first()->tempUrl(10);

                $download->count += 1;
                $download->save();

                return redirect($url);
            } catch (Exception $e) {
                return response('File does not exist', 403);
            }
        } else {
            return response(null, 403);
        }
    }

    /*
    public function streamTrack(Request $request, $trackid) {
        $download = $this->userCanDownloadTrack($request->user(), null, $trackid);
        if($download) {
            $track = Track::findOrFail($trackid);
            $filename = 'public/releases/' . $track->release->id . '/' . $track->id . '.' . $download->format;
            $file = Storage::disk('local')->get($filename);
            //$filesize = (int) File::size($filename);

            return response($file, 200)
                ->header('Content-Type', 'audio/mpeg')
                ->header('Content-Length', '12231373')
                ->header('Content-Range', 'bytes 3211264-15442636/15442637');
        } else {
            return response(null, 403);
        }
    }
    */

    private function userCanDownloadTrack($user, $format, $trackid)
    {
        $track = Track::findOrFail($trackid);

        foreach ($user->orders->where('status', 'complete') as $order) {
            foreach ($order->downloads as $download) {
                // IF requested track matches current track in iteration
                // AND they have downloaded the track less than three times
                // AND the download format matches the requested download format
                if ($download->track->id === $track->id && $download->count < 5 && $download->format == $format) {
                    return $download;
                } elseif ($format == null) { // If no format is specified, we don't check if the download format matches
                    if ($download->track->id === $track->id && $download->count < 5) {
                        return $download;
                    }
                }
            }
        }

        return false;
    }
}
