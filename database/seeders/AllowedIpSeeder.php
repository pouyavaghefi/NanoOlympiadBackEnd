<?php

namespace Database\Seeders;

use App\Models\AllowedIp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AllowedIpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // AllowedIp::truncate();
        DB::table('allowed_ips')->insert([
            [
                'ip' => '127.0.0.1',
                'added_by' => 1
            ],
            [
                'ip' => '192.168.1.1',
                'added_by' => 1
            ],
            [
                'ip' => '84.241.11.116',
                'added_by' => 1
            ],
            [
                'ip' => '178.131.21.62',
                'added_by' => 1,
                'domain' => 'ar'
            ],
            [
                'ip' => '127.0.0.1',
                'added_by' => 1,
                'domain' => 'ar'
            ],
            [
                'ip' => '192.168.1.1',
                'added_by' => 1,
                'domain' => 'ar'
            ],
            [
                'ip' => '84.241.11.116',
                'added_by' => 1,
                'domain' => 'ar'
            ],
            [
                'ip' => '178.131.21.62',
                'added_by' => 1,
                'domain' => 'ar'
            ],
        ]);
    }
}
