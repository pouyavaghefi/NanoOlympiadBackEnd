<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
class PagesController extends Controller
{
    private function numberToWord($number)
    {
        $words = [
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
        ];

        return $words[$number] ?? 'one';
    }
    public function uploadWallPaper(Request $request, $directory)
    {
        if (!$request->hasFile('file')) {
            return back()->with('error', 'No file uploaded.');
        }

        if ($directory == "members-country") {
            $file = $request->file('file');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $slogan = strtolower($filename);

//            $countryExists = \App\Models\Country::where('code', $slogan)->exists();
//
//            if (!$countryExists) {
//                return back()->with('error', 'No country found with the slogan "' . $slogan . '". Please make sure the filename matches a valid country slogan.');
//            }
        } else {
            $file = $request->file('file');
        }

        $allowedMimeTypes = ['image/png', 'image/svg+xml'];
        $allowedExtensions = ['png', 'svg'];

        if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
            return back()->with('error', 'Invalid file type. Only PNG and SVG files are allowed.');
        }

        if (!in_array($file->getClientOriginalExtension(), $allowedExtensions)) {
            return back()->with('error', 'Invalid file extension. Only PNG and SVG files are allowed.');
        }

        $uploadPath = public_path($directory);
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $filename = $file->getClientOriginalName();
        $file->move($uploadPath, $filename);

        return back()->with('success', 'File uploaded successfully.');
    }

    public function uploadStaticPageImg(Request $request, $pageId = null)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Ensure the path is being stored correctly in the `uploads/web-pages/{pageId}`
            $folderPath = $pageId ? "uploads/web-pages/{$pageId}" : "uploads/web-pages/default";

            // Store the image file in the correct path
            $path = $file->store($folderPath, 'public');

            // Generate the full URL for the uploaded file
            $url = Storage::url($path);

            // Return the complete URL in the response
            return "<script>window.parent.CKEDITOR.tools.callFunction(1 , '{$url}' , '')</script>";

        }
        return response()->json([
            'uploaded' => false,
            'error' => ['message' => 'Failed to upload image']
        ], 400);
    }

}
