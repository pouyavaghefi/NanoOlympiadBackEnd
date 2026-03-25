<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaseInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SeoSetting;
use App\Models\StaticPages;
use App\Models\AllowedIp;
class SettingsController extends Controller
{
    public function siteSettings()
    {
        $settings = DB::table('base_infos')->whereIn('type', [
            'siteName',
            'siteDescription',
            'siteOwner',
            'ownerUrl',
            'siteUrl',
            'subdomain1Url',
            'subdomain2Url',
            'siteLogo',
            'siteFavicon',
            'siteLangs',
            'siteVisibility',
            'sitePublication',
        ])->pluck('value', 'type');

        $allowedIps = AllowedIp::where('domain',null)->get();

        return view('settings.site-settings', compact('settings','allowedIps'));
    }
    public function updateSiteSettings(Request $request)
    {
        $validatedData = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:255',
            'site_owner' => 'required|string|max:255',
            'owner_url' => 'nullable|url',
            'site_url' => 'nullable|url',
            'site_coming_soon' => 'required',
            'site_under_construction' => 'required',
            'site_langs' => 'required',
            'allowed_ips' => 'nullable|array',
            'allowed_ips.*' => 'nullable|ip',
        ]);

        $fields = [
            'site_name' => 'siteName',
            'site_description' => 'siteDescription',
            'site_owner' => 'siteOwner',
            'owner_url' => 'ownerUrl',
            'site_url' => 'siteUrl',
            'subdomain1_url' => 'subdomain1Url',
            'subdomain2_url' => 'subdomain2Url',
            'site_logo' => 'siteLogo',
            'site_favicon' => 'siteFavicon',
            'site_langs' => 'siteLangs',
            'site_coming_soon' => 'siteVisibility',
            'site_under_construction' => 'sitePublication',
        ];

        foreach ($fields as $key => $type) {
            if (isset($validatedData[$key])) {
                \DB::table('base_infos')
                    ->where('type', $type)
                    ->update(['value' => $validatedData[$key]]);
            }
        }

        if ($request->has('allowed_ips')) {
            $existingIps = AllowedIp::where('domain', null)->pluck('ip')->toArray();
            $newIps = array_filter($request->allowed_ips);

            $ipsToDelete = array_diff($existingIps, $newIps);
            $ipsToInsert = array_diff($newIps, $existingIps);

            AllowedIp::where('domain', '')->whereIn('ip', $ipsToDelete)->delete();

            foreach ($ipsToInsert as $ip) {
                AllowedIp::create(['ip' => $ip]);
            }
        }else {
            AllowedIp::where('domain', null)->delete();
        }

        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');

            $uploadDir = public_path('logos/');
            $timestamp = date('Y_m_d_His');
            $extension = $file->getClientOriginalExtension();
            $fileName = "{$timestamp}_logo.{$extension}";
            $destination = $uploadDir . $fileName;

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (move_uploaded_file($file->getPathname(), $destination)) {
                \DB::table('base_infos')->where('type', 'siteLogo')->update(['value' => 'logos/' . $fileName]);
            }
        }

        if ($request->hasFile('site_favicon')) {
            $file = $request->file('site_favicon');
            $uploadDir = public_path('logos/');
            $timestamp = date('Y_m_d_His');
            $extension = $file->getClientOriginalExtension();
            $fileName = "{$timestamp}_favicon.{$extension}";
            $destination = $uploadDir . $fileName;

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (move_uploaded_file($file->getPathname(), $destination)) {
                \DB::table('base_infos')->where('type', 'siteFavicon')->update(['value' => 'logos/' . $fileName]);
            }
        }

        return redirect()->route('adm.set.site')->with('success', 'Site settings updated successfully.');
    }

    public function siteSeo()
    {
        $seoSettings = SeoSetting::first();

        return view('settings.site-seo', compact('seoSettings'));
    }

    public function updateSiteSeo(Request $request)
    {
        $data = $request->only([
            'meta_title',
            'meta_description',
            'meta_keywords',
            'canonical_url',
            'og_title',
            'og_description',
            'twitter_title',
            'twitter_description'
        ]);

        $data['og_image'] = $request->file('og_image') ? $request->file('og_image')->store('seo-images', 'public') : null;
        $data['twitter_image'] = $request->file('twitter_image') ? $request->file('twitter_image')->store('seo-images', 'public') : null;

        if (!empty($data['canonical_url']) && !filter_var($data['canonical_url'], FILTER_VALIDATE_URL)) {
            return redirect()->back()->withErrors(['canonical_url' => 'Invalid Canonical URL']);
        }

        $seoSettings = SeoSetting::first();
        if (!$seoSettings) {
            $seoSettings = new SeoSetting();
        }
        $seoSettings->fill($data);

        if ($seoSettings->save()) {
            return redirect()->back()->with('success', 'SEO settings updated successfully.');
        }

        return redirect()->back()->withErrors(['error' => 'Failed to update SEO settings. Please try again.']);
    }

    public function siteAdm()
    {
        $settings = DB::table('base_infos')->whereIn('type', [
            'panelName',
            'panelLogo',
            'panelFavicon'
        ])->pluck('value', 'type');

        $allowedIps = AllowedIp::where('domain','admin')->where('is_active',1)->get();

        return view('settings.admin-settings', compact('settings','allowedIps'));
    }

    public function updateAdmSettings(Request $request)
    {
        $validatedData = $request->validate([
            'panel_name' => 'required|string|max:255',
            'panel_logo' => 'nullable|image|max:2048',
            'panel_favicon' => 'nullable|image|max:2048',
            'allowed_ips' => 'nullable|array',
            'allowed_ips.*' => 'nullable|ip'
        ]);

        if ($request->hasFile('panel_logo')) {
            $file = $request->file('panel_logo');

            $destinationPath = public_path('adm');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move($destinationPath, $filename);

            $validatedData['panel_logo'] = 'adm/' . $filename;
        }

        if ($request->hasFile('panel_favicon')) {
            $file = $request->file('panel_favicon');

            $destinationPath = public_path('adm');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move($destinationPath, $filename);

            $validatedData['panel_favicon'] = 'adm/' . $filename;
        }

        if ($request->has('allowed_ips')) {
            $existingIps = AllowedIp::where('domain', 'admin')->pluck('ip')->toArray();
            $newIps = array_filter($request->allowed_ips);

            $ipsToDelete = array_diff($existingIps, $newIps);
            $ipsToInsert = array_diff($newIps, $existingIps);

            AllowedIp::where('domain', 'admin')->whereIn('ip', $ipsToDelete)->delete();

            foreach ($ipsToInsert as $ip) {
                AllowedIp::create(['ip' => $ip, 'domain' => 'admin']);
            }
        }else{
            AllowedIp::where('domain','admin')->delete();
        }

        $fields = [
            'panel_name' => 'panelName',
            'panel_logo' => 'panelLogo',
            'panel_favicon' => 'panelFavicon',
        ];

        foreach ($fields as $key => $type) {
            if (isset($validatedData[$key])) {
                \DB::table('base_infos')
                    ->where('type', $type)
                    ->update(['value' => $validatedData[$key]]);
            }
        }

        return redirect()->route('adm.set.adm')->with('success', 'Admin panel settings updated successfully.');
    }

    public function siteUsr()
    {
        $settings = DB::table('base_infos')->whereIn('type', [
            'dashName',
            'dashLogo',
            'dashFavicon'
        ])->pluck('value', 'type');

        return view('settings.user-settings', compact('settings'));
    }

    public function updateUsrSettings(Request $request)
    {
        $validatedData = $request->validate([
            'dashboard_name' => 'required|string|max:255',
            'dashboard_logo' => 'nullable|image|max:2048',
            'dashboard_favicon' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('dashboard_logo')) {
            $file = $request->file('dashboard_logo');

            $destinationPath = public_path('dash');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move($destinationPath, $filename);

            $validatedData['dashboard_logo'] = 'dash/' . $filename;
        }

        if ($request->hasFile('dashboard_favicon')) {
            $file = $request->file('dashboard_favicon');

            $destinationPath = public_path('dash');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move($destinationPath, $filename);

            $validatedData['dashboard_favicon'] = 'dash/' . $filename;
        }

        $fields = [
            'dashboard_name' => 'dashName',
            'dashboard_logo' => 'dashLogo',
            'dashboard_favicon' => 'dashFavicon',
        ];

        foreach ($fields as $key => $type) {
            if (isset($validatedData[$key])) {
                \DB::table('base_infos')
                    ->where('type', $type)
                    ->update(['value' => $validatedData[$key]]);
            }
        }

        return redirect()->route('adm.set.usr')->with('success', 'User panel settings updated successfully.');
    }

    public function comingSoon()
    {
        $static = DB::table('static_pages')->where('type', 'coming_soon')->get();

        return view('settings.coming-soon-settings', compact('static'));
    }

    public function updateComingSettings(Request $request)
    {
        $request->validate([
            'counter_box_one_title' => 'nullable|string|max:255',
            'counter_box_one_description' => 'nullable|string|max:255',
            'button_one_link' => 'nullable',
            'button_one_name' => 'nullable|string|max:255',
            'button_two_link' => 'nullable',
            'button_two_name' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|max:2048',
            'subscription_form_title' => 'nullable|string|max:255',
            'subscription_form_description' => 'nullable|string|max:255',
        ]);

        StaticPages::where('name', 'coming_soon_title')->update(['value' => $request->counter_box_one_title]);
        StaticPages::where('name', 'coming_soon_description')->update(['value' => $request->counter_box_one_description]);
        StaticPages::where('name', 'coming_soon_button_one_link')->update(['value' => $request->button_one_link]);
        StaticPages::where('name', 'coming_soon_button_one_name')->update(['value' => $request->button_one_name]);
        StaticPages::where('name', 'coming_soon_button_two_link')->update(['value' => $request->button_two_link]);
        StaticPages::where('name', 'coming_soon_button_two_name')->update(['value' => $request->button_two_name]);
        StaticPages::where('name', 'coming_soon_subscription_form_title')->update(['value' => $request->subscription_form_title]);
        StaticPages::where('name', 'coming_soon_subscription_form_description')->update(['value' => $request->subscription_form_description]);

        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->store('coming_soon', 'public');
            StaticPages::where('name', 'coming_soon_background_image')->update(['value' => $path]);
        }

        return redirect()->back()->with('success', 'Data updated successfully!');
    }

}
