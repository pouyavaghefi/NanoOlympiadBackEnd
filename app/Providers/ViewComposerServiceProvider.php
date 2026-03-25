<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification\AdminNotif;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $adminId = auth()->id();

            $adminNotifs = AdminNotif::whereIn('admin_id', [null, $adminId])
            ->whereNotIn('id', function ($query) use ($adminId) {
                $query->select('notification_id')
                    ->from('admin_notifications_viewers')
                    ->where('admin_id', $adminId);
            })
                ->latest()
                ->limit(10)
                ->get();

            $bases = DB::table('base_infos')
                ->whereIn('type', [
                    'panelName',
                    'panelLogo',
                    'panelFavicon',
                    'siteLangs'
                ])
                ->pluck('value', 'type');

            $view->with([
                'adminNotifs' => $adminNotifs,
                'bases' => $bases
            ]);
        });
    }
}
