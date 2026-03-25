<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model
{
    protected $table = 'members';
    protected $guarded = [];

    public function user()
    {
        return DB::table('users')->where('id',$this->user_id)->first();
    }
}
