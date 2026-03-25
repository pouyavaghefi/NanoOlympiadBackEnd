<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;
use DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Language::truncate();

        DB::table('languages')->insert([
           [
               'name' => 'Arabic',
               'code' => 'ar',
               'is_active' => 1
           ],
            [
                'name' => 'English',
                'code' => 'en',
                'is_active' => 1

            ],
            [
                'name' => 'French',
                'code' => 'fr',
                'is_active' => 1

            ],
            [
                'name' => 'Spanish',
                'code' => 'es',
                'is_active' => 1

            ],
            [
                'name' => 'Deutsch',
                'code' => 'de',
                'is_active' => 1
            ]
        ]);
    }
}
