<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('Godfather1');

        // Instead of truncate use delete:
        // User::query()->delete();

        DB::table('users')->insert([
            [
                'fname' => 'Pouya',
                'lname' => 'Vaghefi',
                'uname' => 'vaghefi_p',
                'email' => 'vagefipouya@yahoo.com',
                'password' => $password,
                'email_verified_at' => Carbon::now(),
                'super_user' => 0,
                'is_active' => 1
            ],
            [
                'fname' => 'Mahdi',
                'lname' => 'Khorsand',
                'uname' => 'mahdikhorsand',
                'email' => 'mahdikhorsand@gmail.com',
                'password' => $password,
                'email_verified_at' => Carbon::now(),
                'super_user' => 0,
                'is_active' => 1
            ],
            [
                'fname' => 'Nano',
                'lname' => 'Olympiad',
                'uname' => 'admin',
                'email' => 'info@nanoclub.ir',
                'password' => $password,
                'email_verified_at' => Carbon::now(),
                'super_user' => 1,
                'is_active' => 1
            ]
        ]);
    }

}
