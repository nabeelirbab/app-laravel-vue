<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 *
 * A single message sent from a single user to a thread.
 *
 * @package App
 */
class Message extends Model
{
    protected $fillable = ['body', 'sender_id', 'thread_id'];

    protected $touches = ['thread'];
    protected $appends = ['type'];

    // protected $hidden = ['thread'];

    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function views()
    {
        return $this->hasMany('App\MessageView', 'message_id');
    }

    public function scopeReceivers($query)
    {
        $sender = $this->sender;

        return $this->thread
                    ->users
                    ->where('id', '!=', $sender->id);
    }

    function getTypeAttribute()
    {
        return 'message';
    }

    public function saveViews($receiver_id = null)
    {
        //save view for sender
        \App\MessageView::create([
            'message_id' => $this->id,
            'user_id' => $this->sender_id,
            'view' => 1
        ]);

        //save view for receiver
        \App\MessageView::create([
            'message_id' => $this->id,
            'user_id' => $receiver_id,
            'view' => 1
        ]);
    }

    function hideMessage()
    {
        \App\MessageView::where("message_id", $this->id)
        ->where("user_id", auth()->id())
        ->update(['view' => 0]);
    }
}
