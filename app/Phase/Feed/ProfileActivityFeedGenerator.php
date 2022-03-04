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

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get all actions which should be displayed on the users profile
     *
     * @return mixed
     */
    public function getActionsForProfile($from = 0, $to = 0)
    {
        //\DB::enableQueryLog();
        $postIds = Post::targetedAt($this->user)->get()->pluck("id");
        $actionQuery = Action::where("created_by", $this->user->id)
        ->orWhere( function($query) use ($postIds) {
            $query->whereIn("item_id", $postIds)
            ->where("item_type", 'post');
        })->orderByDesc('created_at');

        if($from > 0 || $to > 0) {
            if($from > 0 && $to <= 0) {
                $to = $actionQuery->count() - $from;
            }
            $actions = $actionQuery->skip($from)->take($to)->get()->toArray();
        } else {
            $actions = $actionQuery->get()->toArray();
        }
        

        echo json_encode($actions);
        die();

        //dd(\DB::getQueryLog());
        
        
    }

    /**
     * Get all actions which relate to posts targeted at the user
     *
     * @return \Illuminate\Support\Collection
     */
    public function getActionsForPostsTargetedAtUser()
    {
        /*$posts = Post::targetedAt($this->user)
            ->withCount('comments', 'likes', 'shares')
            ->get();

        $postsActions = collect();
        foreach ($posts as $post) {
            $postAction = Action::where('item_type', 'post')
                ->where('item_id', $post->id)
                ->first();

            $postsActions->push($postAction);
        }*/

        $postIds = Post::targetedAt($this->user)->get()->pluck("id");
        $postsActions = Action::where('item_type', 'post')
                ->whereIn('item_id', $postIds)
                ->get();
        return $postsActions;
    }
}
