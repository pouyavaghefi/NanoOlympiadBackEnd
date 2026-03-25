<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WebPage;
use DB;
class WebPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // WebPage::truncate();
        DB::table('web_pages')->insert([
            [
                'title' => 'About Us',
                'slug' => 'about',
                'route_name' => 'about-us',
                'type' => 'static'
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'route_name' => 'contact-us',
                'type' => 'static'
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms',
                'route_name' => 'terms-conditions',
                'type' => 'static'
            ],
            [
                'title' => 'Homepage',
                'slug' => '/',
                'route_name' => 'index',
                'type' => 'static'
            ],
        ]);
    }
}
