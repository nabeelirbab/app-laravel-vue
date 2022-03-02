<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageView extends Model
{
    protected $table = 'message_views';
    protected $fillable = ['message_id', 'user_id', 'view'];
}
