<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\AdminToken;
use Log;
use Str;
use Illuminate\Http\Request;

class SuperUsersController extends UsersMainController
{
    public function index()
    {
        $users = Admin::all();
        return view('users.supers.index', compact('users'));
    }

    public function regenerateToken(Request $request)
    {
        $user = AdminToken::first();

        $newToken = Str::random(60);
        $user->token = $newToken;
        $user->save();

        return response()->json([
            'success' => true,
            'new_token' => $newToken,
        ]);
    }
}
