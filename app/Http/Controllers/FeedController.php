<?php

namespace App\Http\Controllers;

use App\Post;
use App\Action;
use App\Track;
use App\Video;
use App\Event;
use App\Merch;
use App\Genre;
use App\Release;
use App\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class FeedController extends Controller
{
    protected $input;

    public function __construct(Request $request)
    {
        $this->input = $request->all();
    }

    /**
     *
     */
    public function index()
    {
        // 6 hours
        $cache_seconds = now()->addMinutes(30);
        $cache_token = 'feed';

        try {

            $cached_result = Cache::remember($cache_token, $cache_seconds, function () {

                $default_limit = 10;
                //$collection = collect([]);
                $collection = [];

                $releases = Release::statuslive()->with([
                    'image',
                    'uploader' => function ($query) {
                        $query->select('id', 'name', 'path');
                    },
                ])->withCount('shares', 'comments', 'likes')
                ->take(10)->get();
                $this->mergeArrays($collection, $releases, 'feed-release', 'release');
                
                $tracks = Track::namenotnull()->isApproved()->with([
                    'preview',
                    'release',
                    'release.image',
                    'release.uploader' => function ($query) {
                        $query->select('id', 'name', 'path');
                    },
                ])->whereHas('release', function($query) {
                    $query->statuslive();
                })->with('asset')->take(10)->get();
                $this->mergeArrays($collection, $tracks, 'feed-track', 'track');
                
                if (auth()->check()) {

                    $videos = Video::published()->take(8)->get();
                    $this->mergeArrays($collection, $videos, 'feed-video', 'video');
                    
                    $events = Event::datenotnull()->withCount('shares')->take(7)->get();
                    $this->mergeArrays($collection, $events, 'feed-event', 'event');
                   
                    $merchs = Merch::namenotnull()->take(6)->get();
                    $this->mergeArrays($collection, $merchs, 'feed-merch', 'merch');
                    
                }

                $posts = Post::bodynotnull()->withCount(['comments', 'likes', 'shares'])->take(7)->get();
               

                $this->mergeArrays($collection, $posts, 'feed-post', 'post');


                //                Playlist::namenotnull()->limit(7)->get()->each( function( $item ) use ( &$collection ) {
                //                    $item->component = 'feed-playlist';
                //                    $item->type = 'playlist';
                //                    $collection->push($item);
                //                });

                // TODO - Charts.

                // We have a flat array with each item assigned a frontend component.
                return $collection;
            });
        } catch (\Exception $e) {
            // Log::info("FeedController:index -> " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 422);
        }

        return ['data' => $cached_result];
    }

    function mergeArrays(&$collection = [], $object = [], $component = '', $type = '')
    {
        foreach($object as $ob) {
            $ob->component = $component;
            $ob->type = $type;
            $collection[] = $ob;
        }
    }

    public function deleteAction($id)
    {
        $types = [
            'post' => 'App\Post',
            'video' => 'App\Video',
        ];

        $action = Action::find($id);
        $actionItem = $action->item_id;
        $type = $types[$action->item_type];
        $item = $type::find($actionItem);

        $type::destroy($item->id);
        Action::destroy($id);

        $type = ucfirst($action->item_type);

        return "This {$type} Has Been Deleted";
    }
}
