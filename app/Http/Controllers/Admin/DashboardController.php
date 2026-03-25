<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Query the number of unique visitors today
        $todayVisitors = DB::table('user_logs')
            ->whereDate('created_at', $today)
            ->distinct('ip_address')
            ->count('ip_address');

        // Query the number of unique visitors yesterday
        $yesterdayVisitors = DB::table('user_logs')
            ->whereDate('created_at', $yesterday)
            ->distinct('ip_address')
            ->count('ip_address');

        // Get the start of this week and this month
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Count the number of signups this week
        $signupsThisWeek = User::where('created_at', '>=', $startOfWeek)->count();

        // Count the number of signups this month
        $signupsThisMonth = User::where('created_at', '>=', $startOfMonth)->count();

        // Count the number of users who logged in this week
        $loginsThisWeek = User::where('last_login', '>=', $startOfWeek)->count();

        // Count the number of users who logged in this month
        $loginsThisMonth = User::where('last_login', '>=', $startOfMonth)->count();

        $users = User::query();
        return view('index', compact('users','todayVisitors', 'yesterdayVisitors','signupsThisWeek', 'signupsThisMonth','loginsThisWeek', 'loginsThisMonth'));
    }
}
