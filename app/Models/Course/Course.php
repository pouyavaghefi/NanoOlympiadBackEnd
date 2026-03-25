<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;
use DB;

class Course extends Model
{
    protected $table = 'courses';
    protected $guarded = [];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class, 'course_id');
    }

    public function categories()
    {
        $categoryNames = [];

        $categoryIds = DB::table('course_category_course')
            ->where('course_id', $this->id)
            ->pluck('course_category_id');

        if ($categoryIds->isNotEmpty()) {
            $categories = DB::table('course_categories')
                ->whereIn('id', $categoryIds)
                ->get();

            foreach ($categories as $category) {
                $categoryNames[] = $category->name;
            }
        }

        return $categoryNames;
    }

    public function teachers()
    {
        $teacherNames = [];

        $teacherIds = DB::table('course_teachers_course')
            ->where('course_id', $this->id)
            ->pluck('teacher_id');

        if ($teacherIds->isNotEmpty()) {
            $teachers = DB::table('users')
                ->whereIn('id', $teacherIds)
                ->get();

            foreach ($teachers as $teacher) {
                $teacherNames[] = $teacher->name;
            }
        }

        return $teacherNames;
    }

    public function translations()
    {
        return $this->hasMany(CourseTranslation::class, 'course_id');
    }
}
