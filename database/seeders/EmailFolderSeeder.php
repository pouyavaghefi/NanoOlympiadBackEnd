<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class EmailFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $folders = [
            ['name' => 'Inbox', 'slug' => 'inbox', 'system' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sent', 'slug' => 'sent', 'system' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Drafts', 'slug' => 'drafts', 'system' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Trash', 'slug' => 'trash', 'system' => true, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($folders as $folder) {
            // Check if folder exists first
            $exists = DB::table('email_folders')
                ->where('slug', $folder['slug'])
                ->exists();

            if (!$exists) {
                DB::table('email_folders')->insert($folder);
            }
        }
    }
}
