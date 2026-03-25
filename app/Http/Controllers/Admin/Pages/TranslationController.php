<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('settings.other-languages.config_index', compact('languages'));
    }

    public function storeNewLanguage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:languages,code',
            'is_active' => 'required|boolean',
        ]);

        Language::create([
            'name' => $request->name,
            'code' => $request->code,
            'is_active' => 0,
        ]);

        return redirect()->route('adm.set.langs.cfg.index')->with('success', 'Language created successfully.');
    }

    /**
     * Show the form for editing a language.
     */
    public function editExistingLanguage($id)
    {
        $language = Language::findOrFail($id);
        return view('settings.other-languages.config_lang_edit', compact('language'));
    }

    /**
     * Update an existing language.
     */
    public function updateExistingLanguage(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:languages,code,' . $id,
            'is_active' => 'required|boolean',
        ]);

        $language = Language::findOrFail($id);
        $language->update([
            'name' => $request->name,
            'code' => $request->code,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('adm.set.langs.cfg.index')->with('success', 'Language updated successfully.');
    }

    /**
     * Delete a language.
     */
    public function destroyExistingLanguage($id)
    {
        $language = Language::findOrFail($id);
        $language->delete();

        return redirect()->route('adm.set.langs.cfg.index')->with('success', 'Language deleted successfully.');
    }

    public function changeLanguageStatus($id, Request $request)
    {
        try {
            $language = Language::findOrFail($id);
            $newStatus = $request->input('status') == '1' ? 0 : 1;
            $language->is_active = $newStatus;
            $language->save();

            return response()->json(['success' => true, 'new_status' => $newStatus]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function setConfigLangs(Request $request)
    {
        dd(1);
    }

    public function setConfigLocals(Request $request)
    {
        dd(1);
    }
}
