<?php

namespace App\Phase\Feed;

use App\Post;
use App\User;
use App\Action;

/**
 * Class ProfileActivityFeedGenerator
 *
 * Return a collection of actions that can be used to make an activity feed for a user.
 *
 * @package App\Phase\Feed
 */
class ProfileActivityFeedGenerator
{
    protected $user;
    private $invalidTypes = ['user_placed_order', 'user_submitted_report'];
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get all actions which should be displayed on the users profile
     *
     * @return mixed
     */
    public function getActionsForProfile($request)
    {
        $postIds = Post::targetedAt($this->user)
            ->pluck('id')->toArray();

        $returnUserActionQuery = Action::whereNotIn("event_type", $this->invalidTypes)
        ->where( function($query) use( $postIds) {
            $query->where("created_by", $this->user->id)
            ->orWhere( function($q) use( $postIds) {
                $q->where('item_type', 'post')
                ->whereIn('item_id', $postIds);
            });
        })->orderByDesc('created_at');

        if($request->newsearch == 1) {
            $start = $request->get("start", 0);
            $perpage = ($start == 0 ) ? 5 : 10;
            $totalActions = $returnUserActionQuery->count();
            $returnUserActions = $returnUserActionQuery->skip($start)->take($perpage)->get();

            if( $totalActions > ($start + $perpage) ) {
                $nextStart = ($start + $perpage);
            } else {
                $nextStart = false;
            }

        } else {
            $returnUserActions = $returnUserActionQuery->get();
        }

        
        $relatedIds = [];

        foreach($returnUserActions as &$action) {
            if(!isset($relatedIds[$action->item_type])) {
                $relatedIds[$action->item_type] = [];
            }
            $relatedIds[$action->item_type][] = $action->item_id;
        }

        $relatedItems = [];
        $relatedItems['release'] = (isset($relatedIds['release']) && !empty($relatedIds['release'])) ? \App\Release::whereIn("id", $relatedIds['release'])
        ->get()->keyBy('id')->toArray() : [];
        $relatedItems['event'] = (isset($relatedIds['event']) && !empty($relatedIds['event'])) ? \App\Event::whereIn("id", $relatedIds['event'])
        ->get()->keyBy('id')->toArray() : [];
        $relatedItems['merch'] = (isset($relatedIds['merch']) && !empty($relatedIds['merch'])) ? \App\Merch::whereIn("id", $relatedIds['merch'])
        ->get()->keyBy('id')->toArray() : [];
        $relatedItems['user'] = (isset($relatedIds['user']) && !empty($relatedIds['user'])) ? User::whereIn("id", $relatedIds['user'])
        ->get()->keyBy('id')->toArray() : [];
        $relatedItems['post'] = (isset($relatedIds['post']) && !empty($relatedIds['post'])) ? Post::whereIn("id", $relatedIds['post'])
        ->get()->keyBy('id')->toArray() : [];
        $relatedItems['share'] = (isset($relatedIds['share']) && !empty($relatedIds['share'])) ? \App\Share::whereIn("id", $relatedIds['share'])
        ->get()->keyBy('id')->toArray() : [];

        foreach($returnUserActions as $key => $action) {
            $returnUserActions[$key]->item = isset($relatedItems[$action->item_type][$action->item_id]) ? $relatedItems[$action->item_type][$action->item_id] : null; 
        }
        if($request->newsearch == 1) {
           return ['next_start' => $nextStart, 'returndata' => $returnUserActions ]; 
        }
        return $returnUserActions;
    }

    /**
     * Get all actions which relate to posts targeted at the user
     *
     * @return \Illuminate\Support\Collection
     */
    public function getActionsForPostsTargetedAtUser()
    {
        $postIds = Post::targetedAt($this->user)
            ->pluck('id')->toArray();

        $postsActions = Action::where('item_type', 'post')
                ->whereIn('item_id', $postIds)
                ->get();
        return $postsActions;
    }
}
