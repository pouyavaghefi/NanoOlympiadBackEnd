<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Models\ContactInfo;
class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ContactInfo::truncate();
        $contactInfos = [
            [
                'type' => 'address',
                'title' => 'Office Address',
                'content' => '25/B Milford, New York, USA',
                'icon_class' => 'fal fa-map-location-dot',
            ],
            [
                'type' => 'phone',
                'title' => 'Call Us',
                'content' => '+2 123 4565 789',
                'icon_class' => 'fal fa-phone-volume',
            ],
            [
                'type' => 'email',
                'title' => 'Email Us',
                'content' => 'info@example.com',
                'icon_class' => 'fal fa-envelopes',
            ],
            [
                'type' => 'open_time',
                'title' => 'Open Time',
                'content' => 'Mon - Sat (10.00AM - 05.30PM)',
                'icon_class' => 'fal fa-alarm-clock',
            ],
        ];

        foreach ($contactInfos as $info) {
            ContactInfo::create($info);
        }
    }
}
