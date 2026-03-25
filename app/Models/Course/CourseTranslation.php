<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CourseTranslation extends Model
{
    protected $table = 'course_translations';
    protected $guarded = [];

    public function mainCourse()
    {
        return DB::table('courses')->where('course_id',$this->course_id)->first();
    }
}
