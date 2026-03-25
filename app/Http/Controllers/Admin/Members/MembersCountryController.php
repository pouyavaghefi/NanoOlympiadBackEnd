<?php

namespace App\Http\Controllers\Admin\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryMember;
use Validator;

class MembersCountryController extends Controller
{
    public function index()
    {
        $countriesNum = CountryMember::count();
        $countriesList = CountryMember::all();
        $existingFlags = [];
        $flagPath = public_path('members-country');
        if (file_exists($flagPath)) {
            $existingFlags = array_diff(scandir($flagPath), ['.', '..']);
        }

        return view('members.country.index', compact('countriesNum','countriesList','existingFlags'));
    }

    public function updateStatus($id, Request $request)
    {
        $country = CountryMember::findOrFail($id);
        $country->members_page = $request->members_page;
        $country->save();

        return response()->json(['success' => true]);
    }

    public function addCountry(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:members_country,name'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $country = new CountryMember();
            $country->name = $request->name;
            $country->flag = 'default.png';
            $country->pinned = 0;
            $country->members_page = 0;
            $country->save();

            return response()->json([
                'success' => true,
                'message' => 'Country added successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add country: ' . $e->getMessage()
            ], 500);
        }
    }

// In your controller
    public function updateFlag($id, Request $request)
    {
        try {
            $request->validate([
                'flag' => 'required|string'
            ]);

            $country = CountryMember::findOrFail($id);
            $country->flag = $request->flag;
            $country->save();

            return response()->json([
                'success' => true,
                'message' => 'Flag updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
