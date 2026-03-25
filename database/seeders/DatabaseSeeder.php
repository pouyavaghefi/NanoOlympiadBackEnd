<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//       $this->call(UserSeeder::class);
//       $this->call(StaticPageSeeders::class);
//       $this->call(TopMenuSeeder::class);
//       $this->call(BaseSeeder::class);
//       $this->call(PartnerSeeder::class);
//
//       $this->call(AdminNotifSeeder::class);
//    //    $this->call(AllowedIpSeeder::class);
//       $this->call(WebPageSeeder::class);
//       $this->call(LanguageSeeder::class);
//       $this->call(LocalizationSeeder::class);
//       $this->call(ContactInfoSeeder::class);
//         $this->call(PageSectionSeeder::class);
//         $this->call(MembersCountrySeeder::class);
//         $this->call(CountrySeeder::class);
//          $this->call(WidgetSeeder::class);
//         $this->call(EmailFolderSeeder::class);
         $this->call(BookshelfSeeder::class);
    }
}
