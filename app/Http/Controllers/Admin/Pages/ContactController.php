<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\PagesController;
use Illuminate\Http\Request;
use App\Models\Pages\ContactPage;

class ContactController extends PagesController
{
    public function info()
    {
        $contact = ContactPage::first();
        return view('pages.contact.info', compact('contact'));
    }

    public function updateContactInfo(Request $request)
    {
        $validatedData = $request->validate([
            'office_address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'open_time' => 'nullable|string|max:100',
            'map_embed_url' => 'nullable|max:500',
            'show_contact_form' => 'nullable|boolean',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'box_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $validatedData['show_contact_form'] = $request->has('show_contact_form');

        $contact = ContactPage::firstOrCreate([]);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('contact');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            if (!empty($contact->cover_image)) {
                $oldImagePath = $destinationPath . '/' . $contact->cover_image;
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file->move($destinationPath, $fileName);
            $validatedData['cover_image'] = $fileName;
        }

        if ($request->hasFile('box_image')) {
            $file = $request->file('box_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('contact');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            if (!empty($contact->cover_image)) {
                $oldImagePath = $destinationPath . '/' . $contact->cover_image;
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file->move($destinationPath, $fileName);
            $validatedData['box_image'] = $fileName;
        }

        $contact->update($validatedData);

        return redirect()->back()->with('success', 'Contact information updated successfully.');
    }

    public function deleteCoverImage()
    {
        $contact = ContactPage::first();
        if (!empty($contact->cover_image)) {
            $imagePath = public_path('contact/' . $contact->cover_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $contact->cover_image = null;
            $contact->save();
        }

        return redirect()->back()->with('success', 'Cover image deleted successfully.');
    }

    public function deleteBoxImage()
    {
        $contact = ContactPage::first();
        if (!empty($contact->box_image)) {
            $imagePath = public_path('contact/' . $contact->box_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $contact->box_image = null;
            $contact->save();
        }

        return redirect()->back()->with('success', 'Box image deleted successfully.');
    }

    public function messenger()
    {
        dd(2);
    }
}
