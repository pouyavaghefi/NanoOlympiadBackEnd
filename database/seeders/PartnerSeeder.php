<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Partner::truncate();

        DB::table('partners')->insert([
            [
                'partner_name' => 'Nano Club',
                'partner_image' => '01.jpg',
                'partner_link' => 'https://www.nanoclub.com/'
            ]
        ]);
    }
}
