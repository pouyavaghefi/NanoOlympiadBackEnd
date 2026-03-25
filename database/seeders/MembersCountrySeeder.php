<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class MembersCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('members_country')->insert([
            ['name' => 'Islamic Republic of Iran', 'flag' => 'ir.png', 'pinned' => 1],
            ['name' => 'Tajikistan', 'flag' => 'tj.png', 'pinned' => 0],
            ['name' => 'Palestine', 'flag' => 'ps.png', 'pinned' => 0],
            ['name' => 'Oman', 'flag' => 'om.png', 'pinned' => 0],
            ['name' => 'Jordan', 'flag' => 'jo.png', 'pinned' => 0],
            ['name' => 'Kuwait', 'flag' => 'kw.png', 'pinned' => 0],
            ['name' => 'Saudi Arabia', 'flag' => 'sa.png', 'pinned' => 0],
        ]);
    }
}
