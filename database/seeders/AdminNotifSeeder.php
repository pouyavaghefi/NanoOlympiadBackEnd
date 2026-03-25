<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Models\Notification\AdminNotif;
class AdminNotifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // AdminNotif::truncate();

        DB::table('admin_notifications')->insert([
            'title' => 'Welcome to Admin Area',
            'message' => 'Checkout this guideline...',
            'type' => 'success'
        ]);
    }
}
