<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Admin\PagesController;
use App\Models\Partner;
use App\Models\StaticPages;
use App\Models\TopMenu;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Sections\LandingPageSection;
use Illuminate\Support\Facades\File;
class LandingController extends PagesController
{
    public function priority()
    {
        $sections = LandingPageSection::orderBy('priority')->get();
        return view('pages.landing.priority', compact('sections'));
    }

    public function updatePriority(Request $request)
    {
        LandingPageSection::query()->update(['is_enabled' => false]);

        if ($request->has('sections')) {
            foreach ($request->sections as $index => $sectionName) {
                LandingPageSection::where('section_name', $sectionName)
                    ->update([
                        'is_enabled' => true,
                        'priority' => $index + 1
                    ]);
            }
        }

        return redirect()->back()->with('success', 'Sections updated successfully.');
    }
    public function quickContact()
    {
        $static = StaticPages::all();
        return view('pages.landing.quick-contact', compact('static'));
    }

    public function updateQuickContact(Request $request)
    {
        $request->validate([
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'whatsapp' => 'nullable|url',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'show_quick' => 'nullable|in:on',
        ]);

        if(!isset($data['show_quick']))
            $data['show_quick'] = null;

        $data = [
            'fa-facebook-f' => $request->input('facebook'),
            'fa-instagram' => $request->input('instagram'),
            'fa-youtube' => $request->input('youtube'),
            'fa-whatsapp' => $request->input('whatsapp'),
            'fa-location-dot' => $request->input('address'),
            'fa-envelopes' => $request->input('email'),
            'fa-phone-volume' => $request->input('phone'),
            'show_quick' => $request->input('show_quick'),
        ];

        foreach ($data as $name => $value) {
            StaticPages::where('name', $name)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Landing page updated successfully.');
    }
    public function getMenuHierarchy($menuItems, $parentId = null, $level = 0)
    {
        $hierarchy = [];
        foreach ($menuItems as $item) {
            if ($item->parent_id == $parentId) {
                $item->level = $level;
                $hierarchy[] = $item;
                $hierarchy = array_merge($hierarchy, $this->getMenuHierarchy($menuItems, $item->id, $level + 1));
            }
        }
        return $hierarchy;
    }

    public function topmenu()
    {
        $menuItems = TopMenu::all();
        $static = StaticPages::all();
        $menuHierarchy = $this->getMenuHierarchy($menuItems);
        return view('pages.landing.topmenu-navigation', compact('menuItems','static','menuHierarchy'));
    }

    public function updateTopMenu(Request $request)
    {
        $validated = $request->validate([
            'new_menu_item.label' => 'nullable|string|max:255',
            'new_menu_item.url' => 'nullable|max:255',
            'new_menu_item.icon' => 'nullable|string|max:255',
            'new_menu_item.priority' => 'nullable|integer',
            'new_menu_item.parent_id' => 'nullable|exists:topmenu_navigation,id',
            'new_menu_item.is_active' => 'nullable|boolean',
            'menu_items.*.id' => 'required|exists:topmenu_navigation,id',
            'menu_items.*.label' => 'required|string|max:255',
            'menu_items.*.url' => 'nullable|max:255',
            'menu_items.*.icon' => 'nullable|string|max:255',
            'menu_items.*.priority' => 'nullable|integer',
            'menu_items.*.parent_id' => 'nullable|exists:topmenu_navigation,id',
            'menu_items.*.is_active' => 'required|boolean',
        ]);

        // Handle the creation of a new menu item
        if (!empty($validated['new_menu_item']['label'])) {
            TopMenu::create([
                'label' => $validated['new_menu_item']['label'],
                'url' => $validated['new_menu_item']['url'],
                'icon' => $validated['new_menu_item']['icon'],
                'priority' => $validated['new_menu_item']['priority'],
                'parent_id' => $validated['new_menu_item']['parent_id'],
                'is_active' => $validated['new_menu_item']['is_active'] ?? 0,
            ]);
        }

        // Handle the update of existing menu items
        foreach ($validated['menu_items'] as $menuItemData) {
            $menuItem = TopMenu::find($menuItemData['id']);
            if ($menuItem) {
                $menuItem->update([
                    'label' => $menuItemData['label'],
                    'url' => $menuItemData['url'],
                    'icon' => $menuItemData['icon'],
                    'priority' => $menuItemData['priority'],
                    'parent_id' => $menuItemData['parent_id'],
                    'is_active' => $menuItemData['is_active'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Menu items saved successfully!');
    }

    public function updateCallToAction(Request $request)
    {
        $callToAction = StaticPages::where('type','home')->where('name','call-to-action')->first();
        $callToActionName = StaticPages::where('type','home')->where('name','call-to-action-name')->first();
        $callToActionIcon = StaticPages::where('type','home')->where('name','call-to-action-icon')->first();

        $callToAction->value = $request->call_to_action;
        $callToActionName->value = $request->call_to_action_name;
        $callToActionIcon->value = $request->call_to_action_icon;

        $callToAction->save();
        $callToActionName->save();
        $callToActionIcon->save();

        return redirect()->back()->with('success','Call to action button updated successfully!');
    }

    public function features()
    {
        $static = StaticPages::all();
        $svgFiles = File::files(public_path('features'));
        $svgFileNames = collect($svgFiles)->map(function ($file) {
            return $file->getFilename();
        });

        return view('pages.landing.features', compact('static','svgFileNames'));
    }

    public function updateFeatures(Request $request)
    {
        $request->validate([
            'feature_one_name' => 'nullable',
            'feature_one_desc' => 'nullable',
            'feature_one_icon' => 'nullable',
            'feature_two_name' => 'nullable',
            'feature_two_desc' => 'nullable',
            'feature_two_icon' => 'nullable',
            'feature_three_name' => 'nullable',
            'feature_three_desc' => 'nullable',
            'feature_three_icon' => 'nullable',
            'feature_four_name' => 'nullable',
            'feature_four_desc' => 'nullable',
            'feature_four_icon' => 'nullable'
        ]);

        $data = [
            'feature_one_name' => $request->input('feature_one_name'),
            'feature_one_desc' => $request->input('feature_one_desc'),
            'feature_one_icon' => $request->input('feature_one_icon'),
            'feature_two_name' => $request->input('feature_two_name'),
            'feature_two_desc' => $request->input('feature_two_desc'),
            'feature_two_icon' => $request->input('feature_two_icon'),
            'feature_three_name' => $request->input('feature_three_name'),
            'feature_three_desc' => $request->input('feature_three_desc'),
            'feature_three_icon' => $request->input('feature_three_icon'),
            'feature_four_name' => $request->input('feature_four_name'),
            'feature_four_desc' => $request->input('feature_four_desc'),
            'feature_four_icon' => $request->input('feature_four_icon')
        ];

        foreach ($data as $name => $value) {
            StaticPages::where('name', $name)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Landing page updated successfully.');
    }

    public function aboutus()
    {
        $static = StaticPages::all();
        return view('pages.landing.aboutus', compact('static'));
    }

    public function updateAboutUs(Request $request)
    {
        $request->validate([
            'aboutus_header' => 'nullable|string|max:255',
            'aboutus_header_icon' => 'nullable|string|max:255',
            'aboutus_title' => 'nullable|string|max:255',
            'aboutus_paragraph' => 'nullable|string',
            'aboutus_secondary_title_1' => 'nullable|string|max:255',
            'aboutus_secondary_paragraph_1' => 'nullable|string',
            'aboutus_secondary_icon_1' => 'nullable|string|max:255',
            'aboutus_secondary_title_2' => 'nullable|string|max:255',
            'aboutus_secondary_paragraph_2' => 'nullable|string',
            'aboutus_secondary_icon_2' => 'nullable|string|max:255',
            'aboutus_extra_note' => 'nullable|string',
            'aboutus_link_name' => 'nullable|string|max:255',
            'aboutus_link_url' => 'nullable|url|max:255',
            'aboutus_first_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aboutus_second_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aboutus_third_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aboutus_badge_text' => 'nullable|string|max:255',
            'aboutus_badge_icon' => 'nullable|string|max:255',
            'aboutus_call_number' => 'nullable|string|max:20',
        ]);

        $data = $request->except(['aboutus_first_image', 'aboutus_second_image', 'aboutus_third_image']);

        foreach ($data as $name => $value) {
            StaticPages::where('name', $name)->update(['value' => $value]);
        }

        if ($request->hasFile('aboutus_first_image')) {
            $file = $request->file('aboutus_first_image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('about');
            $file->move($destinationPath, $fileName);
            $filePath = 'about/' . $fileName;
            StaticPages::where('name', 'aboutus_first_image')->update(['value' => $filePath]);
        }

        if ($request->hasFile('aboutus_second_image')) {
            $file = $request->file('aboutus_second_image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('about');
            $file->move($destinationPath, $fileName);
            $filePath = 'about/' . $fileName;
            StaticPages::where('name', 'aboutus_second_image')->update(['value' => $filePath]);
        }

        if ($request->hasFile('aboutus_third_image')) {
            $file = $request->file('aboutus_third_image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('about');
            $file->move($destinationPath, $fileName);
            $filePath = 'about/' . $fileName;
            StaticPages::where('name', 'aboutus_third_image')->update(['value' => $filePath]);
        }

        return redirect()->back()->with('success', 'About Us section updated successfully.');
    }

    public function counter()
    {
        $static = StaticPages::all();
        return view('pages.landing.counter', compact('static'));
    }

    public function updateCounter(Request $request)
    {
        $data = $request->validate([
            'counter_box_one_title' => 'required|string|max:255',
            'counter_box_one_value' => 'required|string|max:255',
            'counter_box_one_icon' => 'required|string|max:255',
            'counter_box_two_title' => 'required|string|max:255',
            'counter_box_two_value' => 'required|string|max:255',
            'counter_box_two_icon' => 'required|string|max:255',
            'counter_box_three_title' => 'required|string|max:255',
            'counter_box_three_value' => 'required|string|max:255',
            'counter_box_three_icon' => 'required|string|max:255',
            'counter_box_four_title' => 'required|string|max:255',
            'counter_box_four_value' => 'required|string|max:255',
            'counter_box_four_icon' => 'required|string|max:255',
            'counter_area_bg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'real_data' => 'nullable|in:on',
        ]);

        if(!isset($data['real_data']))
            $data['real_data'] = null;

        foreach ($data as $name => $value) {
            StaticPages::where('name', $name)->update(['value' => $value]);
        }

        if ($request->hasFile('counter_area_bg')) {
            $file = $request->file('counter_area_bg');
            $fileName = $file->getClientOriginalName();

            $destinationPath = public_path('counter');

            $file->move($destinationPath, $fileName);

            $filePath = 'counter/' . $fileName;

            StaticPages::where('name', 'counter_area_bg')->update(['value' => $filePath]);
        }

        return redirect()->back()->with('success', 'About Us section updated successfully.');
    }

    public function gallery()
    {
        $static = StaticPages::all();
        return view('pages.landing.gallery', compact('static'));
    }

    public function updateGallery(Request $request)
    {
        $request->validate([
            'gallery_header' => 'nullable|string|max:255',
            'gallery_icon' => 'nullable|string|max:255',
            'gallery_title' => 'nullable|string|max:255',
            'gallery_description' => 'nullable|string|max:255',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $staticPages = [
            'gallery_header' => $request->input('gallery_header'),
            'gallery_icon' => $request->input('gallery_icon'),
            'gallery_title' => $request->input('gallery_title'),
            'gallery_description' => $request->input('gallery_description'),
        ];

        foreach ($staticPages as $key => $value) {
            StaticPages::where('name', $key)->update(['value' => $value]);
        }

        for ($i = 1; $i <= 6; $i++) {
            if ($request->hasFile("image.{$i}")) {
                $file = $request->file("image.{$i}");
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path('gallery');
                $file->move($destinationPath, $fileName);
                $filePath = 'gallery/' . $fileName;

                $imageKey = 'gallery_link_' . $this->numberToWord($i);
                StaticPages::where('name', $imageKey)->update(['value' => $filePath]);
            }
        }

        return back()->with('success', 'Gallery information updated successfully.');
    }

    public function cta()
    {
        $static = StaticPages::all();
        return view('pages.landing.cta', compact('static'));
    }

    public function updateCta(Request $request)
    {

    }

    public function departments()
    {
        $static = StaticPages::all();
        return view('pages.landing.departments', compact('static'));
    }

    public function updateDepartments(Request $request)
    {
        $validatedData = $request->validate([
            'department_header' => 'nullable|string|max:255',
            'department_title' => 'nullable|string|max:255',
            'department_description' => 'nullable|string|max:500',
            'department_icon_one' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department_title_one' => 'nullable|string|max:255',
            'department_description_one' => 'nullable|string|max:500',
            'department_link_one' => 'nullable',
            'department_icon_two' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department_title_two' => 'nullable|string|max:255',
            'department_description_two' => 'nullable|string|max:500',
            'department_link_two' => 'nullable',
            'department_icon_three' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department_title_three' => 'nullable|string|max:255',
            'department_description_three' => 'nullable|string|max:500',
            'department_link_three' => 'nullable',
            'department_icon_four' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department_title_four' => 'nullable|string|max:255',
            'department_description_four' => 'nullable|string|max:500',
            'department_link_four' => 'nullable',
            'department_icon_five' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department_title_five' => 'nullable|string|max:255',
            'department_description_five' => 'nullable|string|max:500',
            'department_link_five' => 'nullable',
        ]);

        $icons = [
            'department_icon_one',
            'department_icon_two',
            'department_icon_three',
            'department_icon_four',
            'department_icon_five',
        ];

        foreach ($icons as $icon) {
            if ($request->hasFile($icon)) {
                $file = $request->file($icon);
                $path = $file->storeAs('departed', $file->getClientOriginalName(), 'public'); // Store in public/departed
                $validatedData[$icon] = $path;
            }
        }

        foreach ($validatedData as $key => $value) {
            StaticPages::where('name', $key)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Departments updated successfully!');
    }

    public function partners()
    {
        $partners = Partner::all();
        return view('pages.landing.partners', compact('partners'));
    }

    public function updatePartners(Request $request)
    {
        // Delete selected partner images
        if ($request->has('remove_partner_ids')) {
            foreach ($request->remove_partner_ids as $partnerId) {
                $partner = Partner::find($partnerId);

                // Remove the existing image file
                $filePath = public_path('/partners/' . $partner->partner_image);
                if ($partner->partner_image && file_exists($filePath)) {
                    unlink($filePath);
                }

                // Clear the partner_image field
                $partner->partner_image = null;
                $partner->save();
            }
        }

        // Update existing partner images
        foreach ($request->partner_ids as $partnerId) {
            $partner = Partner::find($partnerId);

            // Update partner image
            if ($request->hasFile('partner_brand_' . $partnerId)) {
                $file = $request->file('partner_brand_' . $partnerId);

                $destinationPath = public_path('/partners');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $fileName);

                $partner->partner_image = $fileName;
            }

            $linkKey = 'partner_link_' . $partnerId;
            if ($request->has($linkKey)) {
                $partner->partner_link = $request->$linkKey;
            }

            $partner->save();
        }

        // Add new partners with uploaded images
        if ($request->hasFile('new_partner_brands')) {
            foreach ($request->file('new_partner_brands') as $file) {
                $destinationPath = public_path('/partners');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $fileName);

                // Create a new partner
                Partner::create([
                    'partner_name' => 'New Partner',
                    'partner_image' => $fileName,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Partners updated successfully!');
    }
    public function slider()
    {
        $sliders = Slider::all();
        return view('pages.landing.slider', compact('sliders'));
    }

    public function sliderNew(Request $request)
    {
        $validated = $request->validate([
            'slideImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slideTitle' => 'required|string|max:255',
            'slideSubtitle' => 'required|string|max:255',
            'slideDescription' => 'required|string',
            'button1Text' => 'nullable|string|max:255',
            'button1Link' => 'nullable|url',
            'button2Text' => 'nullable|string|max:255',
            'button2Link' => 'nullable|url',
        ]);

        if ($request->hasFile('slideImage')) {
            $imagePath = $request->file('slideImage')->store('slider_images', 'public');
        } else {
            $imagePath = null;
        }

        Slider::create([
            'slide_image' => $imagePath,
            'slide_title' => $validated['slideTitle'],
            'slide_subtitle' => $validated['slideSubtitle'],
            'slide_description' => $validated['slideDescription'],
            'button1_text' => $validated['button1Text'],
            'button1_link' => $validated['button1Link'],
            'button2_text' => $validated['button2Text'],
            'button2_link' => $validated['button2Link'],
        ]);

        return redirect()->back()->with('success', 'Slider has been added successfully.');
    }

    public function subscribers()
    {

    }

    public function updateSubscribers(Request $request)
    {

    }

    public function editSlider($id)
    {
        $slider = Slider::find($id);
        return view('pages.landing.slider-single', compact('slider'));
    }

    public function deleteSlider($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        return redirect()->back()->with('success', 'Slider has been deleted successfully.');
    }

    public function updateSlider(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'slideImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slideTitle' => 'required|string|max:255',
            'slideSubtitle' => 'required|string|max:255',
            'slideDescription' => 'required|string',
            'button1Text' => 'nullable|string|max:255',
            'button1Link' => 'nullable|url|max:255',
            'button2Text' => 'nullable|string|max:255',
            'button2Link' => 'nullable|url|max:255',
        ]);

        // Find the slider by ID
        $slider = Slider::findOrFail($id);

        // Handle file upload if a new image is uploaded
        if ($request->hasFile('slideImage')) {
            // Delete old image if it exists
            if ($slider->slide_image && file_exists(storage_path('app/public/' . $slider->slide_image))) {
                unlink(storage_path('app/public/' . $slider->slide_image));
            }

            // Store the new image and get the path
            $imagePath = $request->file('slideImage')->store('sliders', 'public');
            $slider->slide_image = $imagePath;
        }

        // Update the slider fields
        $slider->slide_title = $request->input('slideTitle');
        $slider->slide_subtitle = $request->input('slideSubtitle');
        $slider->slide_description = $request->input('slideDescription');
        $slider->button1_text = $request->input('button1Text');
        $slider->button1_link = $request->input('button1Link');
        $slider->button2_text = $request->input('button2Text');
        $slider->button2_link = $request->input('button2Link');

        // Save the updated slider
        $slider->save();

        // Redirect back with a success message
        return redirect()->route('adm.pgs.slider.info')->with('success', 'Slider updated successfully');
    }

    public function viewSlider($id)
    {
        $slider = Slider::findOrFail($id);
        return response()->redirectTo(asset('storage/' . $slider->slide_image));
    }

    public function footer()
    {
        $static = StaticPages::all();
        return view('pages.landing.footer-single', compact('static'));
    }

    public function updateFooter(Request $request)
    {
        $validatedData = $request->validate([
            'footer_logo' => 'nullable|image',
            'footer_description' => 'nullable',
            'footer_email' => 'nullable|email',
            'newsletter_enabled' => 'nullable',
            'newsletter_button_label' => 'nullable',
            'newsletter_button_icon' => 'nullable',
            'footer_links' => 'nullable',
        ]);

        if ($request->hasFile('footer_logo')) {
            $uploadDirectory = public_path('logos/');

            $logo = $_FILES['footer_logo'];
            $logoName = now()->format('Y_m_d_His') . '_footer_logo.' . pathinfo($logo['name'], PATHINFO_EXTENSION);

            $logoPath = $uploadDirectory . $logoName;

            if (!file_exists($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            if (move_uploaded_file($logo['tmp_name'], $logoPath)) {
                $validatedData['footer_logo'] = 'logos/' . $logoName;
            } else {
                $errors[] = 'There was an error uploading the footer logo.';
            }
        }

        foreach ($validatedData as $key => $value) {
            StaticPages::updateOrCreate(['name' => $key], ['value' => $value]);
        }

        return redirect()->route('adm.pgs.footer')->with('success', 'Footer settings updated successfully.');
    }
}
