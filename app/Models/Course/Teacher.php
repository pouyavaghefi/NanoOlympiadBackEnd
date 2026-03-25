<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Teacher extends Model
{
    protected $table = 'course_teachers';
    protected $guarded = [];

//    public function courses()
//    {
//        return $this->belongsToMany(Course::class, 'course_teachers_course', 'teacher_id', 'course_id');
//    }

    public function courses()
    {
        $courseNames = [];

        $courseIds = DB::table('course_teachers_course')
            ->where('teacher_id', $this->id)
            ->pluck('course_id');

        if ($courseIds->isNotEmpty()) {
            $courses = DB::table('courses')
                ->whereIn('id', $courseIds)
                ->get();

            foreach ($courses as $course) {
                $courseNames[] = $course->name;
            }
        }

        return $courseNames;
    }
}
