<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CourseCategory;
class CourseCategoriesController extends CourseMainController
{
    public function showAllCats()
    {
        $cats = CourseCategory::all();
        return view('courses.categories.all-categories', compact('cats'));
    }

    public function relatedCourses($id)
    {
        $category = CourseCategory::find($id);

        return view('courses.categories.related-courses', compact('category'));
    }

    public function createNewCat()
    {
        return view('courses.categories.create-category');
    }

    public function editCat($id)
    {
        dd(2);
    }

    public function updateCat(Request $request)
    {

    }

    public function destroyCat(Request $request, $id)
    {
        $category = CourseCategory::find($id);

        if (!$category) {
            return redirect()->route('adm.crs.cats.index')->with('error', 'Category not found!');
        }

        $category->deleted_at = date('Y-m-d H:i:s');
        $category->save();

        return redirect()->route('adm.crs.cats.index')->with('success', 'Category deleted successfully!');
    }

    public function quickEditTitle(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $category = CourseCategory::findOrFail($id);
        $category->name = $validated['title'];

        if ($category->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 500);
        }
    }
    public function changeStatus($id)
    {
        $category = CourseCategory::findOrFail($id);

        if($category->status == 1){
            $category->status = 0;
        }else{
            $category->status = 1;
        }

        $category->save();

        return redirect()->back()->with('success', 'Course status changed successfully.');
    }

    public function showCat($slug)
    {
        $path = env('URL_FRONT');
        $path = $path . '/courses/categories/' . $slug;
        return redirect()->to($path);
    }
}
