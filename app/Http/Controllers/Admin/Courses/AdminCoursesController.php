<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Teacher;
use App\Models\Course\CourseTranslation;
use Illuminate\Support\Facades\File;
use DB;
class AdminCoursesController extends CourseMainController
{
    public function allCourses()
    {
        $courses = Course::whereDeletedAt(null)->get();
        return view('courses.index', compact('courses'));
    }

    public function createNewCourse()
    {
        return view('courses.create');
    }

    public function storeNewCourse(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'body' => 'nullable|string',
            'slug' => 'nullable|string|max:255|unique:courses,slug',
            'sessions' => 'required|integer',
            'price' => 'required|numeric',
            'total_hours' => 'nullable|integer',
            'value' => 'nullable|string'
        ]);

        $validated['user_id'] = auth()->user()->id;
        $coursePrivate = $request->input('course_private');

        if (!$request->has('custom_slug') || !$request->input('custom_slug')) {
            $validated['slug'] = \Str::slug($request->input('title'));
        }

        $course = new Course();
        $course->title = $validated['title'];
        $course->user_id = $validated['user_id'];
        $course->description = $validated['description'];
        $course->body = $validated['body'];
        $course->slug = $validated['slug'];
        $course->sessions = $validated['sessions'];
        $course->price = $validated['price'];
        $course->total_hours = $validated['total_hours'] ?? null;
        $course->value = $validated['value'] ?? null;
        $course->course_private = $coursePrivate;

        $course->save_draft = $request->has('save_draft') && $request->input('save_draft') == 1 ? 1 : 0;

        $course->save();

        return redirect()->route('adm.crs.index')->with('success', 'Course created successfully!');
    }

    public function deleteCourse(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return redirect()->route('adm.crs.index')->with('error', 'Course not found!');
        }

        if ($course->save_draft == 1) {
            $course->save_draft = 0;
        }

        $course->deleted_at = date('Y-m-d H:i:s');
        $course->save();

        return redirect()->route('adm.crs.index')->with('success', 'Course deleted successfully!');
    }

    public function quickEditTitle(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $course = Course::findOrFail($id);
        $course->title = $validated['title'];

        if ($course->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 500);
        }
    }
    public function changeStatus($id)
    {
        $course = Course::findOrFail($id);

        if($course->save_draft == 1){
            $course->save_draft = 0;
        }else{
            $course->save_draft = 1;
        }

        $course->save();

        return redirect()->back()->with('success', 'Course status changed successfully.');
    }

    public function showCourse($slug)
    {
        $path = env('URL_FRONT');
        $path = $path . '/courses/' . $slug;
        return redirect()->to($path);
    }

    public function translate($id)
    {
        // Fetch the course
        $course = Course::findOrFail($id);

        // Fetch all translations for this course and key them by language_id
        $courseTranslations = CourseTranslation::where('course_id', $id)
            ->get()
            ->keyBy('language_id'); // Key by language_id

        // Fetch all languages
        $languages = Language::all();

        return view('courses.translate', compact('course', 'courseTranslations', 'languages'));
    }

    public function submitTranslation(Request $request, $id)
    {
        $request->validate([
            'language_id' => 'required|exists:languages,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:course_translations,slug,' . $id . ',course_id',
            'description' => 'nullable|string',
            'body' => 'nullable|string',
        ]);

        $translation = CourseTranslation::where('course_id', $id)
            ->where('language_id', $request->language_id)
            ->first();

        if ($translation) {
            $translation->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
                'body' => $request->body,
            ]);
        } else {
            CourseTranslation::create([
                'course_id' => $id,
                'language_id' => $request->language_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
                'body' => $request->body,
            ]);
        }

        return redirect()->route('adm.crs.translate', $id)->with('success', 'Translation saved successfully!');
    }

    public function editTranslation($courseId, $languageId)
    {
        $course = Course::findOrFail($courseId);

        $translation = CourseTranslation::where('course_id', $courseId)
            ->where('language_id', $languageId)
            ->first();

        $language = Language::findOrFail($languageId);

        return view('courses.translate_edit', compact('course', 'translation', 'language'));
    }

    public function deleteTranslation(Request $request, $courseId)
    {
        $request->validate([
            'language_id' => 'required|exists:languages,id',
        ]);

        CourseTranslation::where('course_id', $courseId)
            ->where('language_id', $request->language_id)
            ->delete();

        return redirect()->back()->with('success', 'Translation deleted successfully!');
    }

    public function deleteImage($courseId)
    {
        $course = Course::findOrFail($courseId);

        if ($course->image_url) {
            $imagePath = public_path($course->image_url);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $course->image_url = null;
            $course->save();
        }

        return redirect()->route('adm.crs.edit', $courseId)->with('success', 'Image deleted successfully');
    }

    public function editCourse($id)
    {
        $courseId = $id;
        $course = Course::findOrFail($id);
        $categories = DB::table('course_categories')->pluck('name', 'id');
        $teachers = DB::table('course_teachers')->get();
        $selectedCategories = DB::table('course_category_course')
            ->where('course_id', $id)
            ->pluck('course_category_id')
            ->toArray();
        $selectedTeachers = DB::table('course_teachers_course')
            ->where('course_id', $id)
            ->get();

        return view('courses.edit', compact('course', 'categories', 'selectedCategories','selectedTeachers','teachers','courseId'));
    }

    public function updateCourse(Request $request, $courseId)
    {
        $course = Course::find($courseId);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'body' => 'nullable|string',
            'slug' => 'nullable|string|max:255',
            'sessions' => 'required|integer',
            'price' => 'required|numeric',
            'total_hours' => 'nullable|numeric',
            'type' => 'required|string|in:online,video,none',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:course_categories,id',
            'intro_video' => 'nullable|file|mimes:mp4,mov,avi',
            'intro_video_url' => 'nullable|string|url',
            'teachers' => 'nullable|array',
            'teachers.*' => 'exists:teachers,id',
        ]);

        if ($request->hasFile('intro_video')) {
            $video = $request->file('intro_video');
            $videoName = 'intro_vid.' . $video->getClientOriginalExtension();
            $directory = public_path('courses/' . $course->id . '/videos');

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            $video->move($directory, $videoName);

            if ($course->intro_video && File::exists(public_path($course->intro_video))) {
                File::delete(public_path($course->intro_video));
            }

            $course->intro_video = 'courses/' . $course->id . '/videos/' . $videoName;
        }

        if ($request->filled('intro_video_url')) {
            $course->intro_video_url = $request->input('intro_video_url');
        } else {
            $course->intro_video_url = null;
        }


        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');

            $imageName = 'main_img.' . $image->getClientOriginalExtension();

            $directory = public_path('courses/' . $course->id . '/images');

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            $image->move($directory, $imageName);

            if ($course->image_url && File::exists(public_path($course->image_url))) {
                File::delete(public_path($course->image_url));
            }

            $course->image_url = 'courses/' . $course->id . '/images/' . $imageName;
        }

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');

            $imageName = 'cover_img.' . $image->getClientOriginalExtension();

            $directory = public_path('courses/' . $course->id . '/images');

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            $image->move($directory, $imageName);

            if ($course->image_url && File::exists(public_path($course->image_url))) {
                File::delete(public_path($course->image_url));
            }

            $course->image_url = 'courses/' . $course->id . '/images/' . $imageName;
        }

        if (!empty($validatedData['categories'])) {
            DB::table('course_category_course')
                ->where('course_id', $courseId)
                ->delete();

            foreach ($validatedData['categories'] as $categoryId) {
                DB::table('course_category_course')->insert([
                    'course_id' => $courseId,
                    'course_category_id' => $categoryId,
                ]);
            }
        }

        $course->title = $validatedData['title'];
        $course->description = $validatedData['description'];
        $course->body = $validatedData['body'];
        $course->slug = $validatedData['slug'] ?: str_slug($validatedData['title']);
        $course->sessions = $validatedData['sessions'];
        $course->price = $validatedData['price'];
        $course->total_hours = $validatedData['total_hours'];
        $course->type = $validatedData['type'];

        $course->save();

        if (!empty($validatedData['categories'])) {
            DB::table('course_category_course')
                ->where('course_id', $courseId)
                ->delete();

            foreach ($validatedData['categories'] as $categoryId) {
                DB::table('course_category_course')->insert([
                    'course_id' => $courseId,
                    'course_category_id' => $categoryId,
                ]);
            }
        }

        if (!empty($validatedData['teachers'])) {
            DB::table('course_teachers_course')
                ->where('course_id', $courseId)
                ->delete();

            foreach ($validatedData['teachers'] as $teacherId) {
                DB::table('course_teachers_course')->insert([
                    'course_id' => $courseId,
                    'teacher_id' => $teacherId,
                ]);
            }
        }

        return redirect()->route('adm.crs.index')->with('success', 'Course updated successfully');
    }
}
