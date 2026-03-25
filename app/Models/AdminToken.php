<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminToken extends Model
{
    public function relatedAdmin()
    {
        return DB::table('admins')->where($this->admin_id,'id')->first();
    }
}
