<?php

namespace Database\Seeders;

use App\Models\BaseInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // BaseInfo::truncate();

        DB::table('base_infos')->insert([
            [
                'type' => 'siteName',
                'value' => 'NanOlympiad',
                'can_user_edit' => 1
            ],
            [
                'type' => 'siteDescription',
                'value' => 'Nano Internation Olympiad For Students of Whole World',
                'can_user_edit' => 1
            ],
            [
                'type' => 'siteOwner',
                'value' => 'Nano Club',
                'can_user_edit' => 1
            ],
            [
                'type' => 'ownerUrl',
                'value' => 'https://nanoclub.ir',
                'can_user_edit' => 1
            ],
            [
                'type' => 'siteUrl',
                'value' => 'https://nanolympiad.org',
                'can_user_edit' => 1
            ],
            [
                'type' => 'subdomain1Url',
                'value' => 'https://admin.nanolympiad.org',
                'can_user_edit' => 1
            ],
            [
                'type' => 'subdomain2Url',
                'value' => 'https://panel.nanolympiad.org',
                'can_user_edit' => 1
            ],
            [
                'type' => 'siteLogo',
                'value' => 'logo.png',
                'can_user_edit' => 1
            ],
            [
                'type' => 'siteFavicon',
                'value' => 'favicon.png',
                'can_user_edit' => 1
            ],
            [
                'type' => 'panelName',
                'value' => 'Admin Dashboard',
                'can_user_edit' => 1
            ],
            [
                'type' => 'panelLogo',
                'value' => 'logo.png',
                'can_user_edit' => 1
            ],
            [
                'type' => 'panelFavicon',
                'value' => 'favicon.png',
                'can_user_edit' => 1
            ],
            [
                'type' => 'dashName',
                'value' => 'User Profile',
                'can_user_edit' => 1
            ],
            [
                'type' => 'dashLogo',
                'value' => 'logo.png',
                'can_user_edit' => 1
            ],
            [
                'type' => 'dashFavicon',
                'value' => 'favicon.png',
                'can_user_edit' => 1
            ],
            [
                'type' => 'siteLangs',
                'value' => 'en,ar',
                'can_user_edit' => 1
            ],
            [
                'type' => 'siteVisibility',
                'value' => 'coming_soon',
                'can_user_edit' => 1
            ],
            [
                'type' => 'arSiteName',
                'value' => 'NanOlympiad',
                'can_user_edit' => 1
            ],
            [
                'type' => 'arSiteDescription',
                'value' => 'أولمبياد النانو الدولي للطلاب من جميع أنحاء العالم',
                'can_user_edit' => 1
            ],
            [
                'type' => 'arSiteOwner',
                'value' => 'نادي النانو',
                'can_user_edit' => 1
            ],
            [
                'type' => 'arOwnerUrl',
                'value' => 'https://nanoclub.ir',
                'can_user_edit' => 1
            ],
            [
                'type' => 'arSiteUrl',
                'value' => 'https://ar.nanolympiad.org',
                'can_user_edit' => 1
            ],
            [
                'type' => 'arSiteVisibility',
                'value' => '0',
                'can_user_edit' => 1
            ],
            [
                'type' => 'sitePublication',
                'value' => 'under_construction',
                'can_user_edit' => 1
            ],
        ]);
    }
}
