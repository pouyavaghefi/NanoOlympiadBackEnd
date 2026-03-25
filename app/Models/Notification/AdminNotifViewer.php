<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminNotifViewer extends Model
{
    protected $table = 'admin_notifications_viewers';
    protected $guarded = [];
    public $timestamps = false;


    public function notif()
    {
        return DB::table('admin_notifications')->where('id', $this->notification_id)->first();
    }

    public function admin()
    {
        return DB::table('users')->where('id', $this->admin_id)->first()->uname ?? '';
    }
}
