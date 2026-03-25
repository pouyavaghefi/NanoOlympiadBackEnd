<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\Teacher;
use DB;
use File;
class AdminTeachersController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'expertise' => 'nullable|string|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $teacher = Teacher::create([
            'user_id' => $request->user_id,
            'expertise' => $request->expertise,
            'bio' => $request->bio,
        ]);

        $teacherFolder = public_path("teachers/{$teacher->id}");

        if (!file_exists($teacherFolder)) {
            mkdir($teacherFolder, 0777, true);
        }

        if ($request->hasFile('profile_picture')) {
            $profilePicName = 'profile_picture.' . $request->file('profile_picture')->getClientOriginalExtension();
            $request->file('profile_picture')->move($teacherFolder, $profilePicName);
            $teacher->profile_picture = "teachers/{$teacher->id}/{$profilePicName}";
        }

        if ($request->hasFile('resume')) {
            $resumeExt = $request->file('resume')->getClientOriginalExtension();
            $resumeName = "resume." . $resumeExt;
            $request->file('resume')->move($teacherFolder, $resumeName);
            $teacher->resume_url = "teachers/{$teacher->id}/{$resumeName}";
        }

        $teacher->save();

        return redirect()->route('adm.aca.tea.index')->with('success', 'Teacher added successfully!');
    }

    public function edit($id)
    {
        $teacher = DB::table('course_teachers')->where('id', $id)->first();
        $users = DB::table('users')->where('is_active', 1)->where('super_user', 0)->get();

        return view('teachers.edit', compact('teacher', 'users'));
    }

    // Handle update request
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'expertise' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        $teacher = DB::table('course_teachers')->where('id', $id)->first();

        // Prepare update data
        $updateData = [
            'user_id' => $request->user_id,
            'expertise' => $request->expertise,
            'bio' => $request->bio,
            'updated_at' => now(),
        ];

        // Handle Profile Picture Upload
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = "teachers/{$id}/profile_picture.png";
            Storage::delete($profilePicturePath);
            $request->file('profile_picture')->storeAs("public/$profilePicturePath");
            $updateData['profile_picture'] = $profilePicturePath;
        }

        // Handle Resume Upload
        if ($request->hasFile('resume')) {
            $extension = $request->file('resume')->getClientOriginalExtension();
            $resumePath = "teachers/{$id}/resume.$extension";
            Storage::delete($resumePath);
            $request->file('resume')->storeAs("public/$resumePath");
            $updateData['resume_url'] = $resumePath;
        }

        // Update teacher record
        DB::table('course_teachers')->where('id', $id)->update($updateData);

        return redirect()->route('adm.aca.tea.index')->with('success', 'Teacher updated successfully.');
    }

    // Handle file removal
    public function removeFile($id, $type)
    {
        $teacher = DB::table('course_teachers')->where('id', $id)->first();
        if (!$teacher) {
            return back()->with('error', 'Teacher not found.');
        }

        $filePath = null;
        if ($type === 'profile_picture' && $teacher->profile_picture) {
            $filePath = public_path($teacher->profile_picture);
        } elseif ($type === 'resume' && $teacher->resume_url) {
            $filePath = public_path($teacher->resume_url);
        }

        if ($filePath && File::exists($filePath)) {
            File::delete($filePath);
            DB::table('course_teachers')->where('id', $id)->update([$type === 'profile_picture' ? 'profile_picture' : 'resume_url' => null]);
            return back()->with('success', ucfirst(str_replace('_', ' ', $type)) . ' removed successfully.');
        }

        return back()->with('error', 'File not found.');
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return redirect()->route('adm.aca.tea.index')->with('error', 'Teacher not found.');
        }

        $teacherFolder = public_path("teachers/{$teacher->id}");

        if (File::exists($teacherFolder)) {
            File::deleteDirectory($teacherFolder);
        }

        $teacher->delete();

        return redirect()->route('adm.aca.tea.index')->with('success', 'Teacher deleted successfully!');
    }
}