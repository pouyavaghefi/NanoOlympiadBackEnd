<?php
use Illuminate\Support\Facades\Route;
use App\Models\FileToken;
use Illuminate\Http\Request;

//Route::prefix('api')->group(function () {
    Route::delete('/landing/partners/{id}/delete', function($id){
        $partner = \App\Models\Partner::find($id);

        if (!$partner) {
            return response()->json(['success' => false, 'message' => 'Partner not found.']);
        }

        // Delete the existing image from the filesystem
        $imagePath = public_path('/partners/' . $partner->partner_image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Remove the partner image from the database
        $partner->partner_image = null;
        $partner->save();

        return response()->json(['success' => true, 'message' => 'Partner brand removed successfully.']);
    });

    Route::get('/update-passport-photo/{user_id}', function ($user_id, Request $request) {
        try {
            // Validate input
            if (!$request->has('file_name')) {
                return response()->json([
                    'success' => false,
                    'message' => 'file_name is required'
                ], 422);
            }

            $user = DB::table('users')->where('id', $user_id)->first();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            $member = DB::table('members')->where('user_id', $user_id)->first();
            if (!$member) {
                return response()->json(['success' => false, 'message' => 'Member not found'], 404);
            }

            $fileName = $request->query('file_name');
            $isVerified = $request->has('is_verified') && $request->query('is_verified') == 1;

            if ($isVerified) {
                DB::table('members')
                    ->where('user_id', $user_id)
                    ->update([
                        'passport_photo' => $fileName,
                        'passport_verified' => 1
                    ]);
            } else {
                if (basename($member->passport_photo) === $fileName) {
                    DB::table('members')
                        ->where('user_id', $user_id)
                        ->update(['passport_verified' => 0]);
                } else {
                    Log::info("🟡 No changes to verification status for user_id: {$user_id}");
                }
            }

            $updated = DB::table('members')->where('user_id', $user_id)->first();

            return response()->json([
                'success' => true,
                'message' => 'Passport photo updated successfully',
                'passport_photo' => $updated->passport_photo,
                'passport_verified' => $updated->passport_verified
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    });

//});

