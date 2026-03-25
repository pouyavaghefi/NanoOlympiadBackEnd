<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\AllowedIp;
use App\Models\DepartmentTranslation;
use App\Models\TopMenu;
use App\Models\Slider;
use App\Models\Language;
use App\Models\FeatureTranslation;
use App\Models\AboutusTranslation;
use App\Models\StaticPages;
use Illuminate\Http\Request;
use DB;
class LanguagesController extends Controller
{
    public function arabicSettings()
    {
        $settings = DB::table('base_infos')->whereIn('type', [
            'arSiteName',
            'arSiteDescription',
            'arSiteOwner',
            'arOwnerUrl',
            'arSiteUrl',
            'arSiteVisibility',
        ])->pluck('value', 'type');

        $allowedIps = AllowedIp::where('is_active',1)->where('domain','ar')->get();

        return view('settings.other-languages.arabic',compact('settings','allowedIps'));
    }

    public function updateArabicSettings(Request $request)
    {
        $validatedData = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:255',
            'site_owner' => 'required|string|max:255',
            'owner_url' => 'nullable|url',
            'site_url' => 'nullable|url',
            'site_coming_soon' => 'required',
            'allowed_ips' => 'nullable|array',
            'allowed_ips.*' => 'nullable|ip',
        ]);

        $fields = [
            'site_name' => 'arSiteName',
            'site_description' => 'arSiteDescription',
            'site_owner' => 'arSiteOwner',
            'owner_url' => 'arOwnerUrl',
            'site_url' => 'arSiteUrl',
            'site_coming_soon' => 'arSiteVisibility',
        ];

        foreach ($fields as $key => $type) {
            if (isset($validatedData[$key])) {
                \DB::table('base_infos')
                    ->where('type', $type)
                    ->update(['value' => $validatedData[$key]]);
            }
        }

        if ($request->site_coming_soon == "coming_soon") {
            \DB::table('allowed_ip_exceptions')->where('domain','ar')->delete();

            if ($request->allowed_ips) {
                foreach ($request->allowed_ips as $ip) {
                    if (!empty($ip)) {
                        \DB::table('allowed_ip_exceptions')->insert([
                            'ip' => $ip,
                            'added_by' => auth()->user()->id,
                            'domain' => 'ar',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }

        return redirect()->route('adm.set.langs.ar')->with('success', 'Site settings updated successfully.');
    }

    public function translationsTopMenu()
    {
        $menuItems = TopMenu::all();
        $itemsMenu = TopMenu::all();
        $languages = Language::where('code', '!=', 'en')->get();
        $languages2 = Language::where('code', '!=', 'en')->get();

        return view('pages.landing.topmenu-navigation-translations', compact('menuItems','languages','itemsMenu','languages2'));
    }

    public function updateTranslationsTopMenu(Request $request)
    {
        $data = $request->all();

        foreach ($data['menu_item_id'] as $index => $menuItemId) {
            $languageCode = $data['language'][$index]; // Selected language
            $translateName = $data['menu_item_translate_name'][$index] ?? null;
            $translateDescription = $data['menu_item_translate_description'][$index] ?? null;

            $translation = \App\Models\TopMenuTranslation::where('menu_item_id', $menuItemId)
                ->where('language_code', $languageCode)
                ->first();

            if ($translation) {
                $updateData = [];
                if (!empty($translateName)) {
                    $updateData['translate_name'] = $translateName;
                }
                if (!empty($translateDescription)) {
                    $updateData['translate_description'] = $translateDescription;
                }

                if (!empty($updateData)) {
                    $translation->update($updateData);
                }
            } else {
                if (!empty($translateName) || !empty($translateDescription)) {
                    \App\Models\TopMenuTranslation::create([
                        'menu_item_id' => $menuItemId,
                        'language_code' => $languageCode,
                        'translate_name' => $translateName,
                        'translate_description' => $translateDescription
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Translations updated successfully!');
    }

    public function translationsSlider()
    {
        $languages = Language::where('code', '!=', 'en')->get();
        $languages2 = Language::where('code', '!=', 'en')->get();
        $sliders = Slider::all();
        $itemsMenu = Slider::all();
        return view('pages.landing.slider-translations', compact('sliders','languages','languages2','itemsMenu'));
    }

    public function updateTranslationsSlider(Request $request)
    {
        $data = $request->all();

        foreach ($data['slider_id'] as $index => $sliderId) {
            $languageCode = $data['language'][$index]; // Selected language
            $slideTitle = $data['slider_translate_title'][$index] ?? null;
            $slideSubtitle = $data['slider_translate_subtitle'][$index] ?? null;
            $slideDescription = $data['slider_translate_description'][$index] ?? null;
            $button1Text = $data['slider_translate_button1_text'][$index] ?? null;
            $button2Text = $data['slider_translate_button2_text'][$index] ?? null;

            $translation = \App\Models\SliderTranslation::where('slider_id', $sliderId)
                ->where('language_code', $languageCode)
                ->first();

            if ($translation) {
                $updateData = [];
                if (!empty($slideTitle)) {
                    $updateData['slide_title'] = $slideTitle;
                }
                if (!empty($slideSubtitle)) {
                    $updateData['slide_subtitle'] = $slideSubtitle;
                }
                if (!empty($slideDescription)) {
                    $updateData['slide_description'] = $slideDescription;
                }
                if (!empty($button1Text)) {
                    $updateData['button1_text'] = $button1Text;
                }
                if (!empty($button2Text)) {
                    $updateData['button2_text'] = $button2Text;
                }

                if (!empty($updateData)) {
                    $translation->update($updateData);
                }
            } else {
                if (!empty($slideTitle) || !empty($slideSubtitle) || !empty($slideDescription) || !empty($button1Text) || !empty($button2Text)) {
                    \App\Models\SliderTranslation::create([
                        'slider_id' => $sliderId,
                        'language_code' => $languageCode,
                        'slide_title' => $slideTitle,
                        'slide_subtitle' => $slideSubtitle,
                        'slide_description' => $slideDescription,
                        'button1_text' => $button1Text,
                        'button2_text' => $button2Text
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Slider Translations updated successfully!');
    }

    public function deleteSliderTranslation(Request $request)
    {
        $slider = Slider::findOrFail($request->slider_id);
        $slider->translations()->where('language_code', $request->language_code)->delete();

        return redirect()->back()->with('success', 'Translation deleted successfully.');
    }

    public function featuresTranslations()
    {
        $languages = Language::where('code', '!=', 'en')->get();
        $languages2 = Language::where('code', '!=', 'en')->get();
        $static = StaticPages::whereType('home')->whereKind('feature')->with('translations')->get();
        $itemsMenu = StaticPages::whereType('home')->whereKind('feature')->with('translations')->get();
        return view('pages.landing.feature-translations', compact('static','languages','languages2','itemsMenu'));
    }

    public function updateFeaturesTranslations(Request $request)
    {
        foreach ($request->input('translations', []) as $index => $translationData) {
            $languageId = $translationData['language_id'] ?? null;
            $featureId = $translationData['feature_id'] ?? null;
            $translation = trim($translationData['translation'] ?? '');
            $description = trim($translationData['description'] ?? '');

            // Ensure that feature_id, language_id exist and at least one field has a value
            if (!empty($languageId) && !empty($featureId) && (!empty($translation) || !empty($description))) {
                FeatureTranslation::updateOrCreate(
                    [
                        'language_id' => $languageId,
                        'feature_id' => $featureId,
                    ],
                    [
                        'translation' => $translation,
                        'feature_description' => $description,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Translations updated successfully!');
    }

    public function removeFeatureTranslation(Request $request)
    {
        $request->validate([
            'feature_id' => 'required',
            'language_id' => 'required',
        ]);

        FeatureTranslation::where('feature_id', $request->feature_id)
            ->where('language_id', $request->language_id)
            ->delete();

        return redirect()->back()->with('success', 'Feature translation removed successfully.');
    }

    public function translationsDepartments()
    {
        $static = StaticPages::where('type', 'home')->whereKind('department')->with('translations')->get();
        $itemsMenu = StaticPages::where('type', 'home')->whereKind('department')->with('translations')->get();
        $languages = Language::where('code', '!=', 'en')->get();
        $languages2 = Language::where('code', '!=', 'en')->get();
        return view('pages.landing.departments-translations', compact('static','languages','languages2','itemsMenu'));
    }

    public function updateTranslationsDepartments(Request $request)
    {
        $translations = [];

        if ($request->filled('department_trans')) {
            $translations[] = [
                'static_page_id' => $request->department_header_id,
                'language_id' => $request->department_trans_lang,
                'translation' => $request->department_trans,
            ];
        }

        if ($request->filled('department_title_trans')) {
            $translations[] = [
                'static_page_id' => $request->department_title_id,
                'language_id' => $request->department_title_trans_lang,
                'translation' => $request->department_title_trans,
            ];
        }

        if ($request->filled('department_description_trans')) {
            $translations[] = [
                'static_page_id' => $request->department_description_id,
                'language_id' => $request->department_description_trans_lang,
                'translation' => $request->department_description_trans,
            ];
        }

        $numbersInWords = ['one', 'two', 'three', 'four', 'five'];

        foreach ($numbersInWords as $word) {
            $titleKey = "department_title_{$word}_trans";
            $descKey = "department_description_{$word}_trans";
            $langKey = "department_title_{$word}_lang";
            $DescKeyId = "department_description_{$word}_id";
            $TitleKeyId = "department_title_{$word}_id";

            if ($request->filled($titleKey)) {
                $translations[] = [
                    'static_page_id' => $request->$TitleKeyId,
                    'language_id' => $request->$langKey,
                    'translation' => $request->$titleKey,
                ];
            }

            if ($request->filled($descKey)) {
                $translations[] = [
                    'static_page_id' => $request->$DescKeyId,
                    'language_id' => $request->$langKey,
                    'translation' => $request->$descKey,
                ];
            }
        }

        foreach ($translations as $translation) {
            $existingTranslation = DepartmentTranslation::where('static_page_id', $translation['static_page_id'])
                ->where('language_id', $translation['language_id'])
                ->first();

            if ($existingTranslation) {
                $existingTranslation->update([
                    'translation' => $translation['translation'],
                ]);
            } else {
                DB::enableQueryLog();

                DepartmentTranslation::create($translation);
            }
        }

        return redirect()->back()->with('success', 'Translations saved successfully!');
    }

    public function deleteTranslationDepartments($id)
    {
        $trans = DepartmentTranslation::find($id);
        if($trans){
            $trans->delete();
        }
        
        return redirect()->back()->with('success', 'Translations deleted successfully!');
    }

    public function aboutusTranslations()
    {
        $static = StaticPages::where('kind', 'aboutus')->with('aboutusTranslations')->get();
        $languages = Language::where('code', '!=', 'en')->get();
        $languages2 = Language::where('code', '!=', 'en')->get();

        return view('pages.landing.aboutus-translations', compact('static', 'languages', 'languages2'));
    }

    public function updateAboutusTranslations(Request $request)
    {
        foreach ($request->input('translations', []) as $aboutusId => $translationData) {
            $languageId = $translationData['language_id'] ?? null;
            $translation = trim($translationData['translation'] ?? '');
            $description = trim($translationData['description'] ?? '');

            // Ensure that language_id exists and translation is not empty
            if (!empty($languageId) && !empty($translation)) {
                AboutusTranslation::updateOrCreate(
                    [
                        'language_id' => $languageId,
                        'aboutus_id' => $aboutusId,
                    ],
                    [
                        'translation' => $translation,
                        'description' => $description,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Translations updated successfully!');
    }

    public function deleteAboutusTranslation($translationId)
    {
        $translation = AboutusTranslation::findOrFail($translationId);
        $translation->delete();

        return redirect()->back()->with('success', 'Translation deleted successfully!');
    }
}
