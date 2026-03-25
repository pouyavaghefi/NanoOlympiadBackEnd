<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function viewProfile()
    {
        $user = auth()->user();

        $activities = [];

        return view('users.admins.profile', ['user' => $user, 'activities' => $activities]);
    }

    public function accSettings()
    {
        $user = auth()->user();


        return view('users.admins.account', ['user' => $user]);
    }
}
