<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends UsersMainController
{
    public function index()
    {
        $users = User::where('super_user',1)->get();
        return view('users.admins.index', compact('users'));
    }

    public function create()
    {
        return view('users.admins.create');
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
        $validated['super_user'] = 1;

        $validated['password'] = bcrypt($validated['password']);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $user = User::create($validated);

        return redirect()->route('adm.site.admins.index')
            ->with('success', 'User Admin created successfully!');
    }

}
