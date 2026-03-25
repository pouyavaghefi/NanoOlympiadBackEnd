<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class BookshelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bookshelves')->insert([
            [
                'name' => 'Sample Questions',
                'source' => 'sampleq2.pdf',
                'author' => 'Questions',
                'slug' => 'sample-questions',
            ],
            [
                'name' => 'Booklet 1',
                'source' => 'Nanotechnology_booklet.pdf',
                'author' => 'Booklets',
                'slug' => 'booklet-1',
            ],
            [
                'name' => 'Booklet 2',
                'source' => 'booklet2-final.pdf',
                'author' => 'Booklets',
                'slug' => 'booklet-2',
            ],
            [
                'name' => 'Guide For Supervisors',
                'source' => 'guide-for-supervisors.pdf',
                'author' => 'Guidelines',
                'slug' => 'guide-for-supervisors',
            ],
            [
                'name' => 'Guide For Website Registration',
                'source' => 'guide-to-website-registration.pdf',
                'author' => 'Guidelines',
                'slug' => 'guide-to-website-registration',
            ],
            [
                'name' => 'Digital Library',
                'source' => 'broshor-ino1.pdf',
                'author' => 'Guidelines',
                'slug' => 'digital-library',
            ]
        ]);
    }
}
