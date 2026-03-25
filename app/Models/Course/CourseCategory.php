<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;
use DB;

class CourseCategory extends Model
{
    protected $table = 'course_categories';
    protected $guarded = [];

    public function relatedCourses()
    {
        $courses = DB::table('course_category_course')->where('course_category_id',$this->id)->get();
        return $courses;
    }
}
