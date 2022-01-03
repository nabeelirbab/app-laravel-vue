<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App {
	/**
	 * Class News
	 * 
	 * A news article
	 *
	 * @package App
	 * @property int $id
	 * @property string $title
	 * @property string $content
	 * @property string $path
	 * @property int|null $image_id
	 * @property int $user_id
	 * @property \Illuminate\Support\Carbon|null $deleted_at
	 * @property \Illuminate\Support\Carbon|null $published_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
	 * @property-read int|null $categories_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
	 * @property-read int|null $comments_count
	 * @property-read mixed $comments_count
	 * @property-read mixed $is_liked
	 * @property-read mixed $is_shared
	 * @property-read mixed $likes_count
	 * @property-read mixed $shares_count
	 * @property-read mixed $type
	 * @property-read \App\Asset $image
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
	 * @property-read int|null $likes_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Share[] $shares
	 * @property-read int|null $shares_count
	 * @property-read \App\User $user
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News drafts()
	 * @method static bool|null forceDelete()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News newQuery()
	 * @method static \Illuminate\Database\Query\Builder|\App\News onlyTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News published()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News query()
	 * @method static bool|null restore()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereContent($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereImageId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News wherePath($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News wherePublishedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereTitle($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereUserId($value)
	 * @method static \Illuminate\Database\Query\Builder|\App\News withTrashed()
	 * @method static \Illuminate\Database\Query\Builder|\App\News withoutTrashed()
	 */
	class News extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Subscription
	 * 
	 * Represents a single users subscription to a single subscription plan
	 *
	 * @package App
	 * @property int $id
	 * @property int $user_id
	 * @property string $name
	 * @property string $braintree_id
	 * @property string $braintree_plan
	 * @property int $quantity
	 * @property \Illuminate\Support\Carbon|null $trial_ends_at
	 * @property \Illuminate\Support\Carbon|null $ends_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read mixed $active
	 * @property-read mixed $expired
	 * @property-read mixed $on_grace_period
	 * @property-read mixed $on_trial
	 * @property-read mixed $type
	 * @property-read \App\SubscriptionPlan $subscription_plan
	 * @property-read \App\User $user
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription findUserOnPlan($userID, $planID)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereBraintreeId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereBraintreePlan($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereEndsAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereQuantity($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereTrialEndsAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereUserId($value)
	 */
	class Subscription extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Category
	 * 
	 * A news article category
	 *
	 * @package App
	 * @property int $id
	 * @property string $title
	 * @property string $path
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read mixed $type
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\News[] $news
	 * @property-read int|null $news_count
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category wherePath($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereTitle($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
	 */
	class Category extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Event
	 * 
	 * An Event is a user created Event e.g. concert / gig / show
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $user_id
	 * @property int $image_id
	 * @property string $name
	 * @property string $location
	 * @property string $url
	 * @property string $date
	 * @property-read mixed $is_shared
	 * @property-read mixed $shares_count
	 * @property-read mixed $type
	 * @property-read \App\Asset $image
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Share[] $shares
	 * @property-read int|null $shares_count
	 * @property-read \App\User $user
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event dateNotNull()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereDate($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereImageId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereLocation($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereName($value)
	 * @method static \Illuminate\Databnewsase\Eloquent\Builder|\App\Event whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereUrl($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereUserId($value)
	 */
	class Event extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * A user created playlist for tracks
	 * 
	 * Class Playlist
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $user_id
	 * @property string $name
	 * @property string $description
	 * @property-read mixed $type
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Track[] $tracks
	 * @property-read int|null $tracks_count
	 * @property-read \App\User $user
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Playlist nameNotNull()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Playlist newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Playlist newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Playlist query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Playlist whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Playlist whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Playlist whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Playlist whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Playlist whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Playlist whereUserId($value)
	 */
	class Playlist extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Download
	 * 
	 * A Download represents the ability for a user to download a Track at a specified quality but a limited number of times.
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $order_id
	 * @property int $track_id
	 * @property string $format
	 * @property int $count
	 * @property-read mixed $type
	 * @property-read \App\Order $order
	 * @property-read \App\Track $track
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Download newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Download newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Download query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Download whereCount($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Download whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Download whereFormat($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Download whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Download whereOrderId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Download whereTrackId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Download whereUpdatedAt($value)
	 */
	class Download extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * An order represents a single payment for goods on the site
	 * 
	 * Class Order
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $purchaser_id
	 * @property int $sub_total
	 * @property int $tax
	 * @property int $total
	 * @property string $status
	 * @property string|null $gateway
	 * @property string|null $gateway_charge
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Download[] $downloads
	 * @property-read int|null $downloads_count
	 * @property-read mixed $type
	 * @property-read \App\User $purchaser
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Release[] $releases
	 * @property-read int|null $releases_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Track[] $tracks
	 * @property-read int|null $tracks_count
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order cancelled()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order complete()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order pending()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereGateway($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereGatewayCharge($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePurchaserId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereStatus($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereSubTotal($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereTax($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereTotal($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
	 */
	class Order extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * A user created 'post'. Like a 'status update'
	 * 
	 * Class Post
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $user_id
	 * @property int|null $target_id
	 * @property string $body
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
	 * @property-read int|null $comments_count
	 * @property-read mixed $comments_count
	 * @property-read mixed $is_liked
	 * @property-read mixed $is_shared
	 * @property-read mixed $likes_count
	 * @property-read mixed $shares_count
	 * @property-read mixed $type
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
	 * @property-read int|null $likes_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Report[] $reports
	 * @property-read int|null $reports_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Share[] $shares
	 * @property-read int|null $shares_count
	 * @property-read \App\User $user
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post bodyNotNull()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post by(\App\User $user)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post targetedAt(\App\User $user)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereBody($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereTargetId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUserId($value)
	 */
	class Post extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Action
	 * 
	 * This model represents a database saved event. E.g. when a user updates an avatar, or uploads a new release, that
	 * event is saved as an 'Action'
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $created_by
	 * @property string $event_type
	 * @property int $public
	 * @property string $item_type
	 * @property int $item_id
	 * @property-read mixed $item
	 * @property-read mixed $type
	 * @property-read \App\User $user
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action forUser($userID)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action public($public = true)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereCreatedBy($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereEventType($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereItemId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereItemType($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action wherePublic($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereUpdatedAt($value)
	 */
	class Action extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class SubscriptionPlan
	 * 
	 * Represents a subscription plan that a user can subscribe to.
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property string $name
	 * @property string $description
	 * @property int $monthly_cost
	 * @property-read mixed $type
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Subscription[] $subscriptions
	 * @property-read int|null $subscriptions_count
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubscriptionPlan newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubscriptionPlan newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubscriptionPlan query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubscriptionPlan whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubscriptionPlan whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubscriptionPlan whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubscriptionPlan whereMonthlyCost($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubscriptionPlan whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubscriptionPlan whereUpdatedAt($value)
	 */
	class SubscriptionPlan extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class File
	 * 
	 * Represents a referable single file in storage
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $asset_id
	 * @property string $size
	 * @property string $path
	 * @property string $mime
	 * @property-read \App\Asset $asset
	 * @property-read mixed $type
	 * @property-read mixed $url
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\File newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\File newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\File query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\File size($size)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereAssetId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereMime($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\File wherePath($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereSize($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereUpdatedAt($value)
	 */
	class File extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class User
	 * 
	 * A site user
	 *
	 * @package App
	 * @property int $id
	 * @property int|null $avatar_id
	 * @property string $path
	 * @property string $name
	 * @property string $first_name
	 * @property string $last_name
	 * @property string|null $bio
	 * @property string $email
	 * @property string $phone
	 * @property string $password
	 * @property string $status
	 * @property string|null $braintree_id
	 * @property string|null $paypal_email
	 * @property string|null $card_brand
	 * @property string|null $card_last_four
	 * @property \Illuminate\Support\Carbon|null $trial_ends_at
	 * @property string $payment_method
	 * @property string|null $social_web
	 * @property string|null $social_youtube
	 * @property string|null $social_twitter
	 * @property string|null $social_facebook
	 * @property int|null $notification_setting_id
	 * @property \Illuminate\Support\Carbon|null $deleted_at
	 * @property string|null $remember_token
	 * @property string|null $approved_at
	 * @property string|null $banned_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Action[] $actions
	 * @property-read int|null $actions_count
	 * @property-read \App\Asset|null $avatar
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Release[] $cart_releases
	 * @property-read int|null $cart_releases_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Track[] $cart_tracks
	 * @property-read int|null $cart_tracks_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
	 * @property-read int|null $comments_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Event[] $events
	 * @property-read int|null $events_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $followers
	 * @property-read int|null $followers_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $following
	 * @property-read int|null $following_count
	 * @property-read mixed $account_type
	 * @property-read mixed $all_permissions
	 * @property-read mixed $follower_count
	 * @property-read bool $paypal_linked
	 * @property-read mixed $tracks_count_this_month
	 * @property-read mixed $type
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Genre[] $interests
	 * @property-read int|null $interests_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
	 * @property-read int|null $likes_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Merch[] $merch
	 * @property-read int|null $merch_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\News[] $news_posts
	 * @property-read int|null $news_posts_count
	 * @property-read \App\NotificationSetting $notification_setting
	 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
	 * @property-read int|null $notifications_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
	 * @property-read int|null $orders_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Page[] $pages
	 * @property-read int|null $pages_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $permissions
	 * @property-read int|null $permissions_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Playlist[] $playlists
	 * @property-read int|null $playlists_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
	 * @property-read int|null $posts_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Release[] $releases
	 * @property-read int|null $releases_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Report[] $reports
	 * @property-read int|null $reports_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
	 * @property-read int|null $roles_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Share[] $shares
	 * @property-read int|null $shares_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Cashier\Subscription[] $subscriptions
	 * @property-read int|null $subscriptions_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Thread[] $threads
	 * @property-read int|null $threads_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Track[] $tracks
	 * @property-read int|null $tracks_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Video[] $videos
	 * @property-read int|null $videos_count
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User byPath($path)
	 * @method static bool|null forceDelete()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
	 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User permission($permissions)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
	 * @method static bool|null restore()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User role($roles, $guard = null)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereApprovedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatarId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBannedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBio($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBraintreeId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardBrand($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardLastFour($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereNotificationSettingId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePath($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePaymentMethod($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePaypalEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSocialFacebook($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSocialTwitter($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSocialWeb($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSocialYoutube($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatus($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTrialEndsAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
	 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
	 */
	class User extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * App\Role
	 *
	 * @property int $id
	 * @property string $name
	 * @property string $guard_name
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $permissions
	 * @property-read int|null $permissions_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
	 * @property-read int|null $users_count
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\Spatie\Permission\Models\Role permission($permissions)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereGuardName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereUpdatedAt($value)
	 */
	class Role extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Meta
	 * 
	 * Why does this class exist? I'm not sure.
	 *
	 * @package App
	 * @property int $id
	 * @property string $key
	 * @property string $value
	 * @property string $option
	 * @property string $metable_type
	 * @property int $metable_id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read mixed $type
	 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $metable
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereKey($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereMetableId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereMetableType($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereOption($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereValue($value)
	 */
	class Meta extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Track
	 * 
	 * A single musical track. (a 'song')
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property string $name
	 * @property int|null $length
	 * @property int $bpm
	 * @property string $key
	 * @property int|null $asset_id
	 * @property int|null $preview_id
	 * @property int|null $streamable_id
	 * @property int|null $release_id
	 * @property int|null $uploaded_by
	 * @property int $price
	 * @property string $status
	 * @property string|null $frozen_at
	 * @property \Illuminate\Support\Carbon|null $deleted_at
	 * @property-read \App\Asset|null $asset
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
	 * @property-read int|null $comments_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Download[] $downloads
	 * @property-read int|null $downloads_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Genre[] $genres
	 * @property-read int|null $genres_count
	 * @property-read mixed $comments_count
	 * @property-read mixed $is_liked
	 * @property-read mixed $is_shared
	 * @property-read mixed $likes_count
	 * @property-read mixed $shares_count
	 * @property-read mixed $type
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
	 * @property-read int|null $likes_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
	 * @property-read int|null $orders_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Playlist[] $playlists
	 * @property-read int|null $playlists_count
	 * @property-read \App\Asset|null $preview
	 * @property-read \App\Release|null $release
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Report[] $reports
	 * @property-read int|null $reports_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Share[] $shares
	 * @property-read int|null $shares_count
	 * @property-read \App\Asset|null $streamable
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $user_carts
	 * @property-read int|null $user_carts_count
	 * @method static bool|null forceDelete()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track nameNotNull()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track newQuery()
	 * @method static \Illuminate\Database\Query\Builder|\App\Track onlyTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track query()
	 * @method static bool|null restore()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereAssetId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereBpm($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereFrozenAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereKey($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereLength($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track wherePreviewId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track wherePrice($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereReleaseId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereStatus($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereStreamableId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Track whereUploadedBy($value)
	 * @method static \Illuminate\Database\Query\Builder|\App\Track withTrashed()
	 * @method static \Illuminate\Database\Query\Builder|\App\Track withoutTrashed()
	 */
	class Track extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Like
	 * 
	 * A like represents when a single user 'likes' a likeable object
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property string $likeable_id
	 * @property string $likeable_type
	 * @property int $user_id
	 * @property-read mixed $type
	 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $likeable
	 * @property-read \App\User $liker
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereLikeableId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereLikeableType($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereUserId($value)
	 */
	class Like extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * App\FeaturedReleaseDates
	 *
	 * @property int $id
	 * @property int $release_id
	 * @property string $featured_date
	 * @property \Illuminate\Support\Carbon|null $approved_at
	 * @property \Illuminate\Support\Carbon|null $declined_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read mixed $available_dates
	 * @property-read \App\Release $release
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FeaturedReleaseDates newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FeaturedReleaseDates newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FeaturedReleaseDates query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FeaturedReleaseDates whereApprovedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FeaturedReleaseDates whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FeaturedReleaseDates whereDeclinedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FeaturedReleaseDates whereFeaturedDate($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FeaturedReleaseDates whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FeaturedReleaseDates whereReleaseId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FeaturedReleaseDates whereUpdatedAt($value)
	 */
	class FeaturedReleaseDates extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Component
	 * 
	 * A database representation of a Vue component. Used to dynamically create new pages using existing Vue components.
	 *
	 * @package App
	 * @property int $id
	 * @property string $name
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read mixed $type
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereUpdatedAt($value)
	 */
	class Component extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Genre
	 * 
	 * A musical genre used to group tracks / releases
	 *
	 * @package App
	 * @property int $id
	 * @property string $name
	 * @property int|null $image_id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property \Illuminate\Support\Carbon|null $deleted_at
	 * @property-read mixed $type
	 * @property-read \App\Asset $image
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Release[] $releases
	 * @property-read int|null $releases_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Release[] $samples
	 * @property-read int|null $samples_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Track[] $tracks
	 * @property-read int|null $tracks_count
	 * @method static bool|null forceDelete()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre nameNotNull()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre newQuery()
	 * @method static \Illuminate\Database\Query\Builder|\App\Genre onlyTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre query()
	 * @method static bool|null restore()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre whereImageId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Query\Builder|\App\Genre withTrashed()
	 * @method static \Illuminate\Database\Query\Builder|\App\Genre withoutTrashed()
	 */
	class Genre extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Video
	 * 
	 * A video which can be uploaded by a user.
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $user_id
	 * @property int|null $asset_id
	 * @property string|null $title
	 * @property string|null $description
	 * @property int $published
	 * @property-read \App\Asset|null $asset
	 * @property-read mixed $type
	 * @property-read \App\User $user
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video published()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereAssetId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video wherePublished($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereTitle($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereUserId($value)
	 */
	class Video extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Stores users preferences on the emails they receive from the application
	 * 
	 * Class NotificationSetting
	 *
	 * @package App
	 * @property int $id
	 * @property int $user_id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $activity_follower_on_me_email
	 * @property int $activity_share_on_mine_email
	 * @property int $activity_post_from_followee_email
	 * @property int $activity_like_on_mine_email
	 * @property int $activity_comment_on_mine_email
	 * @property int $activity_message_email
	 * @property int $phase_new_features_email
	 * @property int $phase_surveys_feedback_email
	 * @property int $phase_tips_offers_email
	 * @property int $phase_newsletter_email
	 * @property-read \App\User $user
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting whereActivityCommentOnMineEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting whereActivityFollowerOnMeEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting whereActivityLikeOnMineEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting whereActivityMessageEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting whereActivityPostFromFolloweeEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting whereActivityShareOnMineEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting wherePhaseNewFeaturesEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting wherePhaseNewsletterEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting wherePhaseSurveysFeedbackEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting wherePhaseTipsOffersEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationSetting whereUserId($value)
	 */
	class NotificationSetting extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Comment
	 * 
	 * A polymorphic comment which can be attached to any commentable
	 *
	 * @package App
	 * @property int $id
	 * @property string $body
	 * @property int $commentable_id
	 * @property string $commentable_type
	 * @property int $user_id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property \Illuminate\Support\Carbon|null $deleted_at
	 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
	 * @property-read mixed $type
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Report[] $reports
	 * @property-read int|null $reports_count
	 * @property-read \App\User $user
	 * @method static bool|null forceDelete()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment newQuery()
	 * @method static \Illuminate\Database\Query\Builder|\App\Comment onlyTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment query()
	 * @method static bool|null restore()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereBody($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCommentableId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCommentableType($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUserId($value)
	 * @method static \Illuminate\Database\Query\Builder|\App\Comment withTrashed()
	 * @method static \Illuminate\Database\Query\Builder|\App\Comment withoutTrashed()
	 */
	class Comment extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Share
	 * 
	 * Represents a single user 'sharing' a single shareable
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $user_id
	 * @property int $shareable_id
	 * @property string $shareable_type
	 * @property string|null $message
	 * @property-read mixed $type
	 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $shareable
	 * @property-read \App\User $user
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereMessage($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereShareableId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereShareableType($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereUserId($value)
	 */
	class Share extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class FaqCategory
	 * 
	 * A way of grouping frequently asked questions
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property string $name
	 * @property string $icon
	 * @property int $sort_id
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Faq[] $faqs
	 * @property-read int|null $faqs_count
	 * @property-read mixed $type
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FaqCategory inOrder()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FaqCategory newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FaqCategory newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FaqCategory query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FaqCategory whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FaqCategory whereIcon($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FaqCategory whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FaqCategory whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FaqCategory whereSortId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\FaqCategory whereUpdatedAt($value)
	 */
	class FaqCategory extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Faq
	 * 
	 * A frequently asked question
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $category_id
	 * @property string $question
	 * @property string $answer
	 * @property int $sort_id
	 * @property-read \App\FaqCategory $category
	 * @property-read mixed $type
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq inOrder()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq whereAnswer($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq whereCategoryId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq whereQuestion($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq whereSortId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faq whereUpdatedAt($value)
	 */
	class Faq extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * A top level router-view view which will get sent to Vue and is navigable to using the Vue Router
	 * 
	 * Class Page
	 *
	 * @package App
	 * @property int $id
	 * @property string $name
	 * @property string $title
	 * @property string $path
	 * @property int $user_id
	 * @property int $component_id
	 * @property int|null $parent_id
	 * @property \Illuminate\Support\Carbon|null $deleted_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Page[] $children
	 * @property-read int|null $children_count
	 * @property-read \App\Component $component
	 * @property-read mixed $type
	 * @property-read \App\Page|null $parent
	 * @property-read \App\User $user
	 * @method static bool|null forceDelete()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page isParent()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page newQuery()
	 * @method static \Illuminate\Database\Query\Builder|\App\Page onlyTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page query()
	 * @method static bool|null restore()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereComponentId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereParentId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page wherePath($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereTitle($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereUserId($value)
	 * @method static \Illuminate\Database\Query\Builder|\App\Page withTrashed()
	 * @method static \Illuminate\Database\Query\Builder|\App\Page withoutTrashed()
	 */
	class Page extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * ALL MODELS EXCEPT USER SHOULD EXTEND THIS MODEL
	 * 
	 * This model simply adds a 'type' attribute to array representations of a model so we can easily determine what 'type'
	 * (class) an object is. The 'type' of a model is simply the snake case representation of the base class name (not
	 * including the namespace)
	 * 
	 * Class PhaseModel
	 *
	 * @package App
	 * @property-read mixed $type
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhaseModel newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhaseModel newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhaseModel query()
	 */
	class PhaseModel extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Thread
	 * 
	 * Represents a conversation between (currently) two users. Messages can be posted to this thread
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read mixed $first_message
	 * @property-read mixed $is_liked
	 * @property-read mixed $last_message
	 * @property-read mixed $likes_count
	 * @property-read mixed $type
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
	 * @property-read int|null $likes_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Message[] $messages
	 * @property-read int|null $messages_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Report[] $reports
	 * @property-read int|null $reports_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
	 * @property-read int|null $users_count
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread byUserId($id = null)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereUpdatedAt($value)
	 */
	class Thread extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Release
	 * 
	 * A selection of grouped tracks all release at the same time. Can be classed as an 'album' or a 'single' etc...
	 *
	 * @package App
	 * @property int $id
	 * @property string $name
	 * @property string $description
	 * @property string $status
	 * @property string|null $class
	 * @property int $price
	 * @property int $featured
	 * @property int|null $image_id
	 * @property int $uploaded_by
	 * @property \Illuminate\Support\Carbon $release_date
	 * @property string|null $frozen_at
	 * @property \Illuminate\Support\Carbon|null $deleted_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
	 * @property-read int|null $comments_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FeaturedReleaseDates[] $featuredDates
	 * @property-read int|null $featured_dates_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Genre[] $genres
	 * @property-read int|null $genres_count
	 * @property-read mixed $comments_count
	 * @property-read mixed $is_liked
	 * @property-read mixed $is_shared
	 * @property-read mixed $likes_count
	 * @property-read mixed $score
	 * @property-read mixed $shares_count
	 * @property-read mixed $type
	 * @property-read \App\Asset $image
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
	 * @property-read int|null $likes_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
	 * @property-read int|null $orders_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Report[] $reports
	 * @property-read int|null $reports_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Share[] $shares
	 * @property-read int|null $shares_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Track[] $tracks
	 * @property-read int|null $tracks_count
	 * @property-read \App\User $uploader
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $user_carts
	 * @property-read int|null $user_carts_count
	 * @method static bool|null forceDelete()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release newQuery()
	 * @method static \Illuminate\Database\Query\Builder|\App\Release onlyTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release released()
	 * @method static bool|null restore()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release statusLive()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release statusOffline()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release statusPending()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release unreleased()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereClass($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereFeatured($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereFrozenAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereImageId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release wherePrice($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereReleaseDate($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereStatus($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Release whereUploadedBy($value)
	 * @method static \Illuminate\Database\Query\Builder|\App\Release withTrashed()
	 * @method static \Illuminate\Database\Query\Builder|\App\Release withoutTrashed()
	 */
	class Release extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * App\Notification
	 *
	 * @property int $id
	 * @property string $type
	 * @property string $notifiable_type
	 * @property int $notifiable_id
	 * @property string $data
	 * @property string|null $read_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereData($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereNotifiableId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereNotifiableType($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereReadAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereType($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereUpdatedAt($value)
	 */
	class Notification extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Setting
	 * 
	 * A single key/value pair to represent a site wide setting
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $public
	 * @property string $key
	 * @property string $value
	 * @property-read mixed $type
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting byKey($key)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereKey($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting wherePublic($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereValue($value)
	 */
	class Setting extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * App\Permission
	 *
	 * @property int $id
	 * @property string $name
	 * @property string $guard_name
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $permissions
	 * @property-read int|null $permissions_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
	 * @property-read int|null $roles_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
	 * @property-read int|null $users_count
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\Spatie\Permission\Models\Permission permission($permissions)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\Spatie\Permission\Models\Permission role($roles, $guard = null)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission whereGuardName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission whereUpdatedAt($value)
	 */
	class Permission extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Message
	 * 
	 * A single message sent from a single user to a thread.
	 *
	 * @package App
	 * @property int $id
	 * @property string $body
	 * @property int $thread_id
	 * @property int $sender_id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \App\User $sender
	 * @property-read \App\Thread $thread
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message receivers()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereBody($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereSenderId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereThreadId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereUpdatedAt($value)
	 */
	class Message extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Report
	 * 
	 * A user submitted report used to alert site admins to disallowed content
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int $user_id
	 * @property string $reportable_type
	 * @property int $reportable_id
	 * @property int $acknowledged
	 * @property string $message
	 * @property-read mixed $type
	 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $reportable
	 * @property-read \App\User $user
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report acknowledged()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report unAcknowledged()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report whereAcknowledged($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report whereMessage($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report whereReportableId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report whereReportableType($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report whereUserId($value)
	 */
	class Report extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * App\Plan
	 *
	 * @property int $id
	 * @property string $title
	 * @property string|null $subtitle
	 * @property int $price
	 * @property string|null $content
	 * @property int|null $image_id
	 * @property int $role_id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \App\Asset $image
	 * @property-read \App\Role $role
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereContent($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereImageId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan wherePrice($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereRoleId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereSubtitle($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereTitle($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereUpdatedAt($value)
	 */
	class Plan extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * App\Merch
	 *
	 * @property int $id
	 * @property string $title
	 * @property string|null $description
	 * @property int|null $image_id
	 * @property array|null $links
	 * @property int $user_id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read mixed $type
	 * @property-read \App\Asset $image
	 * @property-read \App\User $user
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Merch nameNotNull()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Merch newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Merch newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Merch query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Merch whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Merch whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Merch whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Merch whereImageId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Merch whereLinks($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Merch whereTitle($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Merch whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Merch whereUserId($value)
	 */
	class Merch extends \Eloquent
	{
	}
}

namespace App {
	/**
	 * Class Asset
	 * 
	 * An asset represents a group of the same / similar / related files. E.g. if a user uploads an avatar, we will create
	 * multiple files at different resolutions. These files will each have individual file models associated with them but
	 * are considered a single asset.
	 * 
	 * Another example is videos. A video will have an original file, a transcoded playlist file and a thumbnail file but
	 * these files are all considered a single asset.
	 *
	 * @package App
	 * @property int $id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property string|null $alt
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\File[] $files
	 * @property-read int|null $files_count
	 * @property-read mixed $mime_type
	 * @property-read mixed $type
	 * @property-read \App\Track $track
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asset fileBySize($size)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asset newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asset newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asset query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asset whereAlt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asset whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asset whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asset whereUpdatedAt($value)
	 */
	class Asset extends \Eloquent
	{
	}
}
