<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    public function showToken()
    {
        return DB::table('admin_tokens')->where('admin_id',$this->id)->first()->token ?? 'NOT SET YET';
    }
}
