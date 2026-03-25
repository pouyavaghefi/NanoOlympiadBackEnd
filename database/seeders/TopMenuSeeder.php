<?php

namespace Database\Seeders;

use App\Models\TopMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TopMenu::truncate();

        DB::table('topmenu_navigation')->insert([
            [
                'parent_id' => null,
                'label' => 'Home',
                'url' => '#',
                'priority' => 1,
                'is_active' => 1,
            ],
            [
                'parent_id' => null,
                'label' => 'Courses',
                'url' => '#',
                'priority' => 2,
                'is_active' => 1,
            ],
            [
                'parent_id' => null,
                'label' => 'Academics',
                'url' => '#',
                'priority' => 3,
                'is_active' => 1,
            ],
            [
                'parent_id' => null,
                'label' => 'Pages',
                'url' => '#',
                'priority' => 4,
                'is_active' => 1,
            ],
            [
                'parent_id' => null,
                'label' => 'Admissions',
                'url' => '#',
                'priority' => 5,
                'is_active' => 1,
            ],
            [
                'parent_id' => null,
                'label' => 'Blog',
                'url' => '#',
                'priority' => 6,
                'is_active' => 1,
            ],
            [
                'parent_id' => null,
                'label' => 'Contact',
                'url' => 'contact.html',
                'priority' => 7,
                'is_active' => 1,
            ],
            [
                'parent_id' => 1,
                'label' => 'Home Page 01',
                'url' => 'index.html',
                'priority' => 1,
                'is_active' => 1,
            ],
            [
                'parent_id' => 1,
                'label' => 'Home Page 02',
                'url' => 'index-2.html',
                'priority' => 2,
                'is_active' => 1,
            ],
            [
                'parent_id' => 1,
                'label' => 'Home Page 03',
                'url' => 'index-3.html',
                'priority' => 3,
                'is_active' => 1,
            ],
            [
                'parent_id' => 2,
                'label' => 'Courses One',
                'url' => 'course.html',
                'priority' => 1,
                'is_active' => 1,
            ],
            [
                'parent_id' => 2,
                'label' => 'Courses Two',
                'url' => 'course-2.html',
                'priority' => 2,
                'is_active' => 1,
            ],
            [
                'parent_id' => 2,
                'label' => 'Course Single One',
                'url' => 'course-single.html',
                'priority' => 3,
                'is_active' => 1,
            ],
            [
                'parent_id' => 2,
                'label' => 'Course Single Two',
                'url' => 'course-single-2.html',
                'priority' => 4,
                'is_active' => 1,
            ],
        ]);
    }
}
