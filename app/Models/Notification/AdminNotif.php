<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminNotif extends Model
{
    protected $table = 'admin_notifications';
    protected $guarded = [];

    public function showAdminUserName()
    {
        if(!is_null($this->admin_id)){
            return DB::table('users')->where('id', $this->admin_id)->first()->uname ?? '';
        }
    }

    public function addViewer($adminId)
    {
        $exists = AdminNotifViewer::where('notification_id', $this->id)
            ->where('admin_id', $adminId)
            ->exists();

        if (!$exists) {
            AdminNotifViewer::create([
                'notification_id' => $this->id,
                'admin_id' => $adminId,
                'viewed_at' => now(),
            ]);
        }
    }}
