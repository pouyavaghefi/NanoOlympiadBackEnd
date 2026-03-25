<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $guarded = [];

    public function recipients()
    {
        return $this->belongsToMany(User::class, 'message_recipient', 'message_id', 'user_id')->withTimestamps();
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }





}
