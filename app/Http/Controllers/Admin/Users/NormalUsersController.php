<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member\Member;
use App\Models\Course\CourseComment;
use App\Models\Course\CourseRegistration;
use Auth;
use Cache;
use App\Models\UserAccessToken;
use DB;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Response;
use Log;
use Illuminate\Support\Facades\Http;
class NormalUsersController extends UsersMainController
{
    public function index()
    {
        $admin = auth()->user();

        $lastSeen = $admin->last_seen_users_at ?? '1970-01-01 00:00:00';

        $newUsersCount = User::where('super_user', 0)
            ->where('created_at', '>', $lastSeen)
            ->count();

        $users = User::where('super_user', 0)->get();

        $admin->last_seen_users_at = now();
        $admin->save();

        return view('users.normal.index', compact('users', 'newUsersCount'));
    }

    public function create()
    {
        return view('users.normal.create');
    }

    public function view($id)
    {
        $user = User::findOrFail($id);
        $cacheKey = "user_files_{$id}";

        try {
            $apiUrl = "https://ino-official.org/api/user-files/{$user->id}";
            $response = Http::timeout(15)
                ->retry(2, 1000)
                ->get($apiUrl);

            if ($response->successful()) {
                $data = $response->json();

                $files = $data['files'] ?? [];

                Cache::put($cacheKey, $files, now()->addMinutes(30));
            } else {
                $files = Cache::get($cacheKey, []);
            }
        } catch (\Exception $e) {
            \Log::error("Failed to fetch files for user {$id}: " . $e->getMessage());

            $files = Cache::get($cacheKey, []);
        }

        $course_comments = CourseComment::with('course')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $course_registrations = CourseRegistration::with('course')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $user_access_tokens = UserAccessToken::where('user_id', $user->id)
            ->latest()
            ->get();

        $now = now();
        $isOnline = $user_access_tokens->contains(function ($token) use ($now) {
            return $token->expires_at && $token->expires_at->gt($now);
        });

        return view('users.normal.view', compact(
            'user',
            'files',
            'course_comments',
            'course_registrations',
            'user_access_tokens',
            'isOnline'
        ));
    }

    public function requestZip($id)
    {
        $apiUrl = env('URL_FRONT') . '/api/user-files/' . $id . '/download-zip';

        try {
            $response = Http::withOptions(['stream' => true])->get($apiUrl);
            if ($response->successful()) {
                return Response::stream(function () use ($response) {
                    echo $response->body();
                }, 200, [
                    'Content-Type' => $response->header('Content-Type', 'application/zip'),
                    'Content-Disposition' => 'attachment; filename="user_' . $id . '_files.zip"',
                ]);
            }

            return back()->with('error', 'Failed to download ZIP. API error.');
        } catch (\Exception $e) {
            \Log::channel('adm')->error("ZIP download failed for user {$id}: " . $e->getMessage());
            return back()->with('error', 'Download failed. Try again later.');
        }
    }

    public function deleteAllFiles($id)
    {
        $apiUrl = env('URL_FRONT') . '/api/user-files/delete-all-files/' . $id;

        try {
            $response = Http::delete($apiUrl);

            if ($response->successful()) {
                $data = $response->json();
                $message = $data['message'] ?? 'All files deleted successfully.';

                if (isset($data['deleted_count'])) {
                    $message .= " ({$data['deleted_count']} files removed)";
                }

                return back()->with('success', $message);
            }

            $error = $response->json()['error'] ?? $response->body();
            \Log::channel('adm')->error("Failed to delete all files for user {$id}: " . $error);
            return back()->with('error', $error ?? 'Could not delete files. Try again.');

        } catch (\Exception $e) {
            \Log::channel('adm')->error("Exception deleting files for user {$id}: " . $e->getMessage());
            return back()->with('error', 'Something went wrong while deleting files.');
        }
    }

    public function uploadFile(Request $request, $user_id)
    {
        $apiUrl = env('URL_FRONT') . '/api/user-files/upload/' . $user_id;

        try {
            $file = $request->file('file');

            if (!$file) {
                return back()->with('error', 'No file provided');
            }

            $filename = $file->getClientOriginalName();
            $fileContent = file_get_contents($file->getRealPath());
            $base64Content = base64_encode($fileContent);

            // Send as GET with base64-encoded content and filename
            $response = Http::get($apiUrl, [
                'filename' => $filename,
                'content' => $base64Content,
            ]);

            if ($response->successful()) {
                return back()->with('success', 'File uploaded successfully!');
            }

            $error = $response->json()['error'] ?? 'Upload failed';
            return back()->with('error', $error);

        } catch (\Exception $e) {
            Log::error("File upload failed: " . $e->getMessage());
            return back()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    public function downloadPdf($id)
    {
        $user = User::findOrFail($id);

        $pdf = Pdf::loadView('pdf.user_profile', compact('user'));
        return $pdf->download("user-profile-{$user->id}.pdf");
    }

    public function renameUserFile(Request $request, $id)
    {
        $apiUrl = env('URL_FRONT') . '/api/user-files/rename-custom-file/' . $id;
        try {
            $response = Http::get($apiUrl, [
                'old_name' => $request->old_name,
                'new_name' => $request->new_name,
            ]);

            if ($response->successful()) {
                return back()->with('success', 'File renamed successfully.');
            }

            Log::channel('adm')->error("Rename failed: " . $response->body());
            return back()->with('error', 'Failed to rename file.');
        } catch (\Exception $e) {
            Log::channel('adm')->error("Exception during file rename: " . $e->getMessage());
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function moveUserFile(Request $request)
    {
        $sourceUserId = $request->input('source_user_id');
        $targetUserId = $request->input('target_user_id');
        $fileName     = $request->input('file_name');

        $apiUrl = rtrim(env('URL_FRONT'), '/') . "/api/user-files/move/{$sourceUserId}/{$targetUserId}/{$fileName}";

        $response = Http::get($apiUrl, [
            'source_user_id' => $request->source_user_id,
            'target_user_id' => $request->target_user_id,
            'file_name' => $request->file_name,
        ]);

        $responseData = $response->json();

        if ($response->successful() === true) {
            return back()->with('success', $responseData['message'] ?? 'File moved successfully.');
        }else{
            return back()->with('error', 'Something went wrong while moving the file.');
        }
    }

    public function softDelete(Request $request, $userId, $fileName)
    {
        $apiUrl = rtrim(env('URL_FRONT'), '/') . "/api/user-files/soft-delete/{$userId}/{$fileName}";

        $response = Http::get($apiUrl);

        if ($response->successful()) {
            FileHistory::create([
                'user_id' => $userId,
                'file_name' => $fileName,
                'action' => 'deleted',
                'details' => json_encode(['to' => 'trashed']),
            ]);

            return back()->with('success', 'File SOFT deleted successfully.');
        } else {
            return back()->with('error', 'Something went wrong while deleting the file.');
        }
    }
    public function restore(Request $request, $userId)
    {
        $filename = $request->input('file_name');
        $apiUrl = env('URL_FRONT') . '/api/user-files/restore';

        try {
            $response = Http::get($apiUrl, [
                'user_id' => $userId,
                'file_name' => $filename,
            ]);

            if ($response->successful()) {
                // Log the history in your database (locally)
                FileHistory::create([
                    'user_id' => $userId,
                    'file_name' => $filename,
                    'action' => 'restored',
                    'details' => json_encode(['from' => 'trashed']),
                ]);
                return response()->json(['status' => 'restored']);
            }

            return response()->json(['status' => 'error', 'message' => 'Failed to restore file.'], 500);
        } catch (\Exception $e) {
            Log::channel('adm')->error("Error during restore for user {$userId}: " . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Something went wrong.'], 500);
        }
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'uname' => 'required|string|max:255|unique:users,uname',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required',
            'is_active' => 'nullable',
        ]);
        $validated['password'] = bcrypt($validated['password']);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $user = User::create($validated);

        return redirect()->route('adm.site.users.index')
            ->with('success', 'User created successfully!');
    }

    public function remove($id)
    {
        $user = User::find($id);
        return view('users.normal.remove', compact('user'));
    }

    public function destroy(Request $request)
    {
        $userId = $request->input('id');

        DB::beginTransaction();

        try {
            $userEmail = DB::table('users')->where('id', $userId)->value('email');

            $membersDeleted = DB::table('members')->where('user_id', $userId)->delete();
            $tokensDeleted = DB::table('user_access_tokens')->where('user_id', $userId)->delete();

            $registrationsDeleted = DB::table('course_registrations')->where('user_id', $userId)->delete();
            $commentsDeleted = DB::table('course_comments')->where('user_id', $userId)->delete();

            DB::table('users')->where('id', $userId)->delete();

            DB::commit();

            Log::channel('del')->info("User #$userId (email: $userEmail) deleted with $registrationsDeleted registrations, $commentsDeleted comments, $membersDeleted members, and $tokensDeleted tokens.");

            return redirect()->route('adm.site.users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to delete user #$userId: " . $e->getMessage());

            return back()->with('error', 'Failed to delete user.');
        }
    }

    public function uploadAvatar(Request $request,$id)
    {
        $user = User::find($id);
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store("public/users/{$user->id}");
            $validated['avatar'] = str_replace('public/', '', $path);

            $this->syncAvatarWithMainProject($user, $request->file('avatar'));
        }

        return redirect()->back()->withSuccess('User avatar photo updated successfully.');
    }

    protected function syncAvatarWithMainProject($user, $avatarFile)
    {
        try {
            $client = new \GuzzleHttp\Client([
                'verify' => file_exists(storage_path('app/certs/cacert.pem'))
                    ? storage_path('app/certs/cacert.pem')
                    : true,
                'timeout' => 30,
            ]);

            $response = $client->post(config('services.main_project.base_url') . '/api/sync-avatar', [
                'headers' => [
                    'Authorization' => 'Bearer ' . config('services.main_project.api_key'),
                    'Accept' => 'application/json',
                ],
                'multipart' => [
                    [
                        'name' => 'user_id',
                        'contents' => $user->id
                    ],
                    [
                        'name' => 'avatar',
                        'contents' => fopen($avatarFile->getRealPath(), 'r'),
                        'filename' => $avatarFile->getClientOriginalName(),
                        'headers' => [
                            'Content-Type' => $avatarFile->getMimeType()
                        ]
                    ]
                ]
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (!isset($responseData['success'])) {
                throw new \Exception('Invalid API response format');
            }

            return $responseData;

        } catch (\Exception $e) {
            \Log::error('Avatar sync failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateFullName(Request $request,$id)
    {
        $user = User::find($id);

        $fullName = $request->input('full_name');
        $nameParts = explode(' ', trim($fullName));

        $firstName = $nameParts[0] ?? null;
        $lastName = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : null;

        $user->fname = $firstName;
        $user->lname = $lastName;
        $user->save();

        $findMember = Member::where('user_id',$user->id)->first();
        if($findMember) {
            $findMember->surname = $lastName;
            $findMember->save();
        }

        return redirect()->back()->with('success', 'Full name & Surname updated successfully.');
    }

    public function destroyAvatar(Request $request,$id)
    {
        $user = User::find($id);
        $this->notifyAvatarDeletionToMainProject($user);

        return redirect()->back()->withSuccess('User Avatar photo deleted successfully.');
    }
    protected function notifyAvatarDeletionToMainProject($user)
    {
        try {
            $client = new \GuzzleHttp\Client([
                'verify' => file_exists(storage_path('app/certs/cacert.pem'))
                    ? storage_path('app/certs/cacert.pem')
                    : true,
                'timeout' => 30,
            ]);

            $response = $client->post(config('services.main_project.base_url') . '/api/delete-avatar', [
                'headers' => [
                    'Authorization' => 'Bearer ' . config('services.main_project.api_key'),
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'user_id' => $user->id,
                ]
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (!isset($responseData['success'])) {
                throw new \Exception('Invalid API response format');
            }

            return $responseData;

        } catch (\Exception $e) {
            \Log::error('Avatar deletion sync failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}
