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
    public function getActionsForProfile()
    {
        
        $userActions = Action::where("created_by", $this->user->id)
        ->whereNotIn("event_type", $this->invalidTypes)->get();

        return $userActions
            ->merge($this->getActionsForPostsTargetedAtUser())
            ->sortByDesc('created_at')
            ->values();
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

        //$postsActions = collect();
        $postsActions = Action::where('item_type', 'post')
                ->whereIn('item_id', $postIds)
                ->get();

        /*foreach($postActionLists as $postAction) {
            $postsActions->push($postAction);
        }*/

        return $postsActions;
    }
}
