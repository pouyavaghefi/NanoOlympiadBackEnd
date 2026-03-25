<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Models\Localization;
class LocalizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Localization::truncate();
        DB::table('localizations')->insert([
            [
                'key' => 'course-index-heading',
                'value' => 'أحدث دوراتنا',
                'language_id' => 5,
            ],
            [
                'key' => 'course-courses-heading',
                'value' => 'دوراتنا',
                'language_id' => 5,
            ],
            [
                'key' => 'course-index-subheading',
                'value' => 'لنلقِ نظرة على أحدث دوراتنا',
                'language_id' => 5,
            ],
            [
                'key' => 'course-courses-subheading',
                'value' => 'لنلقِ نظرة على دوراتنا',
                'language_id' => 5,
            ],
            [
                'key' => 'course-index-desc',
                'value' => 'من الحقائق المعروفة أن القارئ سيتشتت بسبب محتوى الصفحة عند الاطلاع على تنسيقها.',
                'language_id' => 5,
            ],
            [
                'key' => 'course-btn-one',
                'value' => 'اشترك الآن',
                'language_id' => 5,
            ],
            [
                'key' => 'course-btn-two',
                'value' => 'أضف إلى قائمة الأمنيات',
                'language_id' => 5,
            ],
            [
                'key' => 'hero-index-heading',
                'value' => 'مرحبًا بكم في أولمبياد النانو',
                'language_id' => 5
            ],
            [
                'key' => 'hero-index-subheading',
                'value' => 'أولمبياد النانوتكنولوجي الدولي',
                'language_id' => 5
            ],
            [
                'key' => 'hero-index-desc',
                'value' => 'أولمبياد النانوتكنولوجي الدولي (INO) هو مسابقة عالمية بين طلاب الجامعات من دول مختلفة، تُقام بشكل مستمر في الاقتصادات الأعضاء.',
                'language_id' => 5
            ],
        ]);
    }
}
