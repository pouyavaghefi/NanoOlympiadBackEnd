<?php

namespace Database\Seeders;

use App\Models\StaticPages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaticPageSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // StaticPages::truncate();

        DB::table('static_pages')->insert([
            [
               'type' => 'home',
               'name' => 'fa-facebook-f',
               'value' => ''
            ],
            [
                'type' => 'home',
                'name' => 'fa-instagram',
                'value' => ''
            ],
            [
                'type' => 'home',
                'name' => 'fa-youtube',
                'value' => ''
            ],
            [
                'type' => 'home',
                'name' => 'fa-whatsapp',
                'value' => ''
            ],
            [
                'type' => 'home',
                'name' => 'fa-location-dot',
                'value' => '25/B Milford Road, New York'
            ],
            [
                'type' => 'home',
                'name' => 'fa-envelopes',
                'value' => 'info@example.com'
            ],
            [
                'type' => 'home',
                'name' => 'fa-phone-volume',
                'value' => '+2 123 654 7898'
            ],
            [
                'type' => 'home',
                'name' => 'call-to-action',
                'value' => '#'
            ],
            [
                'type' => 'home',
                'name' => 'call-to-action-name',
                'value' => 'apply now'
            ],
            [
                'type' => 'home',
                'name' => 'call-to-action-icon',
                'value' => 'fal fa-pencil'
            ],
            [
                'type' => 'home',
                'name' => 'feature_one_name',
                'value' => 'Scholarship Facility'
            ],
            [
                'type' => 'home',
                'name' => 'feature_one_desc',
                'value' => 'It is a long established fact that a reader will be distracted.'
            ],
            [
                'type' => 'home',
                'name' => 'feature_one_icon',
                'value' => 'scholarship.svg'
            ],
            [
                'type' => 'home',
                'name' => 'feature_two_name',
                'value' => 'Skilled Lecturers'
            ],
            [
                'type' => 'home',
                'name' => 'feature_two_desc',
                'value' => 'It is a long established fact that a reader will be distracted.'
            ],
            [
                'type' => 'home',
                'name' => 'feature_two_icon',
                'value' => 'teacher.svg'
            ],
            [
                'type' => 'home',
                'name' => 'feature_three_name',
                'value' => 'Book Library Facility'
            ],
            [
                'type' => 'home',
                'name' => 'feature_three_desc',
                'value' => 'It is a long established fact that a reader will be distracted.'
            ],
            [
                'type' => 'home',
                'name' => 'feature_three_icon',
                'value' => 'library.svg'
            ],
            [
                'type' => 'home',
                'name' => 'feature_four_name',
                'value' => 'Affordable Price'
            ],
            [
                'type' => 'home',
                'name' => 'feature_four_desc',
                'value' => 'It is a long established fact that a reader will be distracted.'
            ],
            [
                'type' => 'home',
                'name' => 'feature_four_icon',
                'value' => 'money.svg'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_header',
                'value' => 'About Us'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_header_icon',
                'value' => 'far fa-book-open-reader'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_title',
                'value' => 'Our Edukation System Inspires You More.'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_paragraph',
                'value' => 'There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words which don\'t look even slightly believable. If you are going to use passage. '
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_secondary_title_1',
                'value' => 'Edukation Services'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_secondary_paragraph_1',
                'value' => 'It is a long established fact that reader will to using content.'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_secondary_icon_1',
                'value' => 'open-book.svg'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_secondary_title_2',
                'value' => 'International Hubs'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_secondary_paragraph_2',
                'value' => 'It is a long established fact that reader will to using content.'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_secondary_icon_2',
                'value' => 'global-education.svg'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_extra_note',
                'value' => 'It is a long established fact that a reader will be distracted by the content of a page when looking at its reader for the long words layout.'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_link_name',
                'value' => 'Discover More'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_link_url',
                'value' => '#'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_first_image',
                'value' => '02.jpg'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_second_image',
                'value' => '01.jpg'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_third_image',
                'value' => '03.jpg'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_badge_text',
                'value' => '30 Years Of Quality Service'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_badge_icon',
                'value' => 'exchange-idea.svg'
            ],
            [
                'type' => 'home',
                'name' => 'aboutus_call_number',
                'value' => '+2 123 654 7898'
            ],
            [
                'type' => 'home',
                'name' => 'counter_box_one_title',
                'value' => 'Total Cources'
            ],
            [
                'type' => 'home',
                'name' => 'counter_box_one_value',
                'value' => '500'
            ],
            [
                'type' => 'home',
                'name' => 'counter_box_one_icon',
                'value' => 'course.svg'
            ],
            [
                'type' => 'home',
                'name' => 'counter_box_two_title',
                'value' => 'Our Students'
            ],
            [
                'type' => 'home',
                'name' => 'counter_box_two_icon',
                'value' => 'graduation.svg'
            ],
            [
                'type' => 'home',
                'name' => 'counter_box_two_value',
                'value' => '1900'
            ],
            [
                'type' => 'home',
                'name' => 'counter_box_three_title',
                'value' => 'Skilled Lecturers'
            ],
            [
                'type' => 'home',
                'name' => 'counter_box_three_icon',
                'value' => 'teacher-2.svg'
            ],
            [
                'type' => 'home',
                'name' => 'counter_box_three_value',
                'value' => '750'
            ],
            [
                'type' => 'home',
                'name' => 'counter_box_four_title',
                'value' => 'Win Awards'
            ],
            [
                'type' => 'home',
                'name' => 'counter_box_four_icon',
                'value' => 'award.svg'
            ],
            [
                'type' => 'home',
                'name' => 'counter_box_four_value',
                'value' => '30'
            ],
            [
                'type' => 'home',
                'name' => 'counter_area_bg',
                'value' => '01.jpg'
            ],
            [
                'type' => 'home',
                'name' => 'gallery_icon',
                'value' => 'far fa-book-open-reader'
            ],
            [
                'type' => 'home',
                'name' => 'gallery_header',
                'value' => 'Gallery'
            ],
            [
                'type' => 'home',
                'name' => 'gallery_title',
                'value' => 'Our Photo Gallery'
            ],
            [
                'type' => 'home',
                'name' => 'gallery_description',
                'value' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'
            ],
            [
                'type' => 'home',
                'name' => 'gallery_link_one',
                'value' => '01.jpg'
            ],
            [
                'type' => 'home',
                'name' => 'gallery_link_two',
                'value' => '02.jpg'
            ],
            [
                'type' => 'home',
                'name' => 'gallery_link_three',
                'value' => '03.jpg'
            ],
            [
                'type' => 'home',
                'name' => 'gallery_link_four',
                'value' => '04.jpg'
            ],
            [
                'type' => 'home',
                'name' => 'gallery_link_five',
                'value' => '05.jpg'
            ],
            [
                'type' => 'home',
                'name' => 'gallery_link_six',
                'value' => '06.jpg'
            ],
            [
                'type' => 'home',
                'name' => 'cta_bg_image',
                'value' => '01.jpg'
            ],
            [
                'type' => 'home',
                'name' => 'cta_title',
                'value' => 'Our 20% Offer Running - Join Today For Your Course'
            ],
            [
                'type' => 'home',
                'name' => 'cta_paragraph',
                'value' => 'There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words which don\'t look even slightly believable.'
            ],
            [
                'type' => 'home',
                'name' => 'cta_button_name',
                'value' => 'Apply Now'
            ],
            [
                'type' => 'home',
                'name' => 'cta_button_link',
                'value' => '#'
            ],
            [
                'type' => 'home',
                'name' => 'department_header',
                'value' => 'Department'
            ],
            [
                'type' => 'home',
                'name' => 'department_title',
                'value' => 'Browse Our Department'
            ],
            [
                'type' => 'home',
                'name' => 'department_description',
                'value' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'
            ],
            [
                'type' => 'home',
                'name' => 'department_icon_one',
                'value' => 'monitor.svg'
            ],
            [
                'type' => 'home',
                'name' => 'department_icon_two',
                'value' => 'law.svg'
            ],
            [
                'type' => 'home',
                'name' => 'department_icon_three',
                'value' => 'data.svg'
            ],
            [
                'type' => 'home',
                'name' => 'department_icon_four',
                'value' => 'health.svg'
            ],
            [
                'type' => 'home',
                'name' => 'department_icon_five',
                'value' => 'art.svg'
            ],
            [
                'type' => 'home',
                'name' => 'department_title_one',
                'value' => 'Business And Finance'
            ],
            [
                'type' => 'home',
                'name' => 'department_title_two',
                'value' => 'Law And Criminology'
            ],
            [
                'type' => 'home',
                'name' => 'department_title_three',
                'value' => 'IT And Data Science'
            ],
            [
                'type' => 'home',
                'name' => 'department_title_four',
                'value' => 'Health And Medicine'
            ],
            [
                'type' => 'home',
                'name' => 'department_title_five',
                'value' => 'Art And Design'
            ],
            [
                'type' => 'home',
                'name' => 'department_description_one',
                'value' => 'There are many variations of passages the majority have some injected humour.'
            ],
            [
                'type' => 'home',
                'name' => 'department_description_two',
                'value' => 'There are many variations of passages the majority have some injected humour.'
            ],
            [
                'type' => 'home',
                'name' => 'department_description_three',
                'value' => 'There are many variations of passages the majority have some injected humour.'
            ],
            [
                'type' => 'home',
                'name' => 'department_description_four',
                'value' => 'There are many variations of passages the majority have some injected humour.'
            ],
            [
                'type' => 'home',
                'name' => 'department_description_five',
                'value' => 'There are many variations of passages the majority have some injected humour.'
            ],
            [
                'type' => 'home',
                'name' => 'department_link_one',
                'value' => '#'
            ],
            [
                'type' => 'home',
                'name' => 'department_link_two',
                'value' => '#'
            ],
            [
                'type' => 'home',
                'name' => 'department_link_three',
                'value' => '#'
            ],
            [
                'type' => 'home',
                'name' => 'department_link_four',
                'value' => '#'
            ],
            [
                'type' => 'home',
                'name' => 'department_link_five',
                'value' => '#'
            ],
            [
                'type' => 'coming_soon',
                'name' => 'coming_soon_title',
                'value' => 'Coming Soon!'
            ],
            [
                'type' => 'coming_soon',
                'name' => 'coming_soon_description',
                'value' => 'We\'re working hard to finish the development of this site. Soon!'
            ],
            [
                'type' => 'coming_soon',
                'name' => 'coming_soon_button_one_name',
                'value' => 'START TUTORIAL'
            ],
            [
                'type' => 'coming_soon',
                'name' => 'coming_soon_button_two_name',
                'value' => 'DOWNLOAD MDB UI KIT'
            ],
            [
                'type' => 'coming_soon',
                'name' => 'coming_soon_button_one_link',
                'value' => '#'
            ],
            [
                'type' => 'coming_soon',
                'name' => 'coming_soon_button_two_link',
                'value' => '#'
            ],
            [
                'type' => 'coming_soon',
                'name' => 'coming_soon_subscription_form_title',
                'value' => 'Subscribe to stay up to date'
            ],
            [
                'type' => 'coming_soon',
                'name' => 'coming_soon_subscription_form_description',
                'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis consequatur eligendi quisquam doloremque vero ex debitis veritatis placeat unde animi laborum sapiente illo possimus, commodi dignissimos obcaecati illum maiores corporis. '
            ],
            [
                'type' => 'coming_soon',
                'name' => 'coming_soon_background_image',
                'value' => '205.jpg'
            ],
            [
                'type' => 'home',
                'name' => 'real_data',
                'value' => 'on'
            ],
            [
                'type' => 'home',
                'name' => 'show_quick',
                'value' => 'on'
            ],
            [
                'type' => 'footer',
                'name' => 'footer_logo',
                'value' => 'logos/footer_logo.png'
            ],
            [
                'type' => 'footer',
                'name' => 'footer_description',
                'value' => 'Lorem impsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod'
            ],
            [
                'type' => 'footer',
                'name' => 'footer_email',
                'value' => 'info@domain.com'
            ],
            [
                'type' => 'footer',
                'name' => 'newsletter_enabled',
                'value' => 'on'
            ],
            [
                'type' => 'footer',
                'name' => 'newsletter_description',
                'value' => 'Subscribe Our Newsletter To Get Latest Update And News'
            ],
            [
                'type' => 'footer',
                'name' => 'newsletter_button_label',
                'value' => 'Subscribe to stay up to date'
            ],
            [
                'type' => 'footer',
                'name' => 'newsletter_button_icon',
                'value' => 'far fa-paper-plane'
            ],
            [
                'type' => 'footer',
                'name' => 'footer_links',
                'value' => 'on'
            ]
        ]);
    }
}
