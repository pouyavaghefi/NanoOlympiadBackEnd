<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class PageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            ['page_id' => 4, 'section_name' => 'hero', 'priority' => 1, 'is_enabled' => true],
            ['page_id' => 4, 'section_name' => 'feature-area', 'priority' => 2, 'is_enabled' => true],
            ['page_id' => 4, 'section_name' => 'about-area', 'priority' => 3, 'is_enabled' => true],
            ['page_id' => 4, 'section_name' => 'counter-area', 'priority' => 4, 'is_enabled' => true],
            ['page_id' => 4, 'section_name' => 'course-area', 'priority' => 5, 'is_enabled' => true],
            ['page_id' => 4, 'section_name' => 'department-area', 'priority' => 6, 'is_enabled' => true],
            ['page_id' => 4, 'section_name' => 'partner-area', 'priority' => 7, 'is_enabled' => true],
        ];

        DB::table('web_page_sections')->insert($sections);
    }
}