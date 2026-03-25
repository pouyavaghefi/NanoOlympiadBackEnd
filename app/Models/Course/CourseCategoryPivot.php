<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;

class CourseCategoryPivot extends Model
{
    protected $table = 'course_category_course';
    protected $guarded = [];

    public $timestamps = false;
}
