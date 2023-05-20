<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $table = 'otp';
    
    protected $fillable = [
        'user_id',
        'code',
    ];
    
    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
