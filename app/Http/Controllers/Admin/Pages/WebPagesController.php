<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Member\CountryMember;
use Illuminate\Http\Request;
use App\Models\WebPage;
use App\Http\Controllers\Admin\PagesController;
class WebPagesController extends PagesController
{
    public function createNewDynamic()
    {
       
    }

    public function createStatic()
    {
        return view('pages.static.create');
    }

    public function storeStatic(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:web_pages,slug',
            'route_name' => 'required|string|max:255|unique:web_pages,route_name',
            'wall_paper' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'content' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('wall_paper')) {
            $validated['wall_paper'] = $request->file('wall_paper')->store('wallpapers', 'public');
        }

        $validated['type'] = 'static';
        $validated['editable'] = true;
        $validated['status'] = $request->filled('status') ? 1 : 0;
        $validated['slug'] = strtolower($validated['slug']);

        WebPage::create($validated);

        return redirect()->route('adm.pgs.statics.index')->with('success', 'Static page created successfully.');
    }
    public function showAllStatics()
    {
        $webpages = WebPage::where('type','static')->get();
        return view('pages.static.index', compact('webpages'));
    }
    public function editStatic($id)
    {
        $webpage = WebPage::find($id);
        if($webpage->editable == 1){
            if((!$webpage->created_at) && (!$webpage->updated_at)){
                if($webpage->id == 5){
                    $flags = array_map('basename', array_merge(
                        glob(public_path('members-country') . '/*.png'),
                        glob(public_path('members-country') . '/*.svg')
                    ));

                    $countries = CountryMember::orderByDesc('pinned')->get();

                    return view('pages.static.edit', compact('webpage','flags','countries'));
                }

                return view('pages.static.edit', compact('webpage'));
            }else{

                 /// youre here
                return view('pages.static.editContent', compact('webpage'));
            }
        }else{
            abort(403);
        }
    }
    public function updateStatic(Request $request, $id)
    {
        $country = CountryMember::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'country_url' => 'nullable|url',
            'flag' => 'nullable|string',
            'pinned' => 'nullable|boolean',
            'members_page' => 'nullable|boolean',
        ]);

        $country->name = $request->name;
        $country->c_link = $request->c_link;
        $country->pinned = $request->has('pinned');
        $country->members_page = $request->has('members_page');
        $country->save();

        return back()->with('success', 'Country updated successfully.');
    }

    public function updateStaticContent(Request $request, $id)
    {
        $webpage = WebPage::findOrFail($id);

        if (!$webpage->editable) {
            abort(403);
        }

        $request->validate([
//            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'page_title' => 'required|string|max:255',
//            'route_name' => 'required|string|max:255',
            'wall_paper' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required|boolean',
            'content' => 'nullable|string',
        ]);

        if ($request->hasFile('wall_paper')) {
            if ($webpage->wall_paper && file_exists(public_path('storage/' . $webpage->wall_paper))) {
                unlink(public_path('storage/' . $webpage->wall_paper));
            }

            $wallpaperPath = $request->file('wall_paper')->store('wallpapers', 'public');
        } else {
            $wallpaperPath = $webpage->wall_paper;
        }

        $webpage->update([
            'page_title' => $request->page_title,
            'slug' => strtolower($request->slug),
            'wall_paper' => $wallpaperPath,
            'status' => $request->status,
            'content' => $request->content,
        ]);

        return redirect()->route('adm.pgs.statics.index')->with('success', 'Static page updated successfully!');
    }

    public function postStatic(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_url' => 'nullable|url',
            'flag' => 'nullable|string',
            'pinned' => 'nullable|boolean'
        ]);

        $country = new CountryMember();
        $country->name = $request->name;
        $country->c_link = $request->country_url;
        $country->flag = $request->flag;
        $country->pinned = $request->has('pinned');
        $country->save();

        return back()->with('success', 'New country added successfully.');
    }
}
