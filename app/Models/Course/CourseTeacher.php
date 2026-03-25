<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CourseTeacher extends Model
{
    protected $table = 'course_teachers';
    protected $guarded = [];

    public function user()
    {
        return DB::table('users')->where('id',$this->user_id)->first();
    }
}
