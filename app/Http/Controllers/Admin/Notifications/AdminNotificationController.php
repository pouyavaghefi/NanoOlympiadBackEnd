<?php

namespace App\Http\Controllers\Admin\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification\AdminNotif;
use App\Models\Notification\AdminNotifView;
class AdminNotificationController extends Controller
{
    public function view($id)
    {
        $notif = AdminNotif::find($id);
        $isRead = $notif->is_read;
        $isRead = $isRead + 1;
        $notif->is_read = $isRead;
        $notif->save();

        $adminId = auth()->id();
        $notif->addViewer($adminId);

        return view('notifications.view', compact('notif'));
    }
}
