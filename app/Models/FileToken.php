<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/FileToken.php
class FileToken extends Model
{
    protected $fillable = ['user_id', 'file_name', 'token', 'expires_at'];

    public $timestamps = true;

    protected $dates = ['expires_at'];
}
