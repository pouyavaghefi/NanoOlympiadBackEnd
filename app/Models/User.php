<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Storage;
use Auth;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'last_login',
        'email_verified_at',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function fullName()
    {
        return $this->fname . ' ' . $this->lname;
    }

    public function summary()
    {
        $first_letter_fname = $this->fname[0];
        $first_letter_lname = $this->lname[0];

        $firstLetters = $first_letter_fname . $first_letter_lname;

        return $firstLetters;
    }

    public function showStatus()
    {
        if($this->is_active == 1){
            return "<span class='badge badge-success'>active</span>";
        }else{
            return "<span class='badge badge-danger'>inactive</span>";
        }
    }

    public function showEmail()
    {
        if(!is_null($this->email_verified_at)){
            return "<span class='badge badge-success'>verified</span>";
        }else{
            return "<span class='badge badge-danger'>unverified</span>";
        }
    }

    public function member()
    {
        return DB::table('members')->where('user_id',$this->id)->first();
    }

    public function teacher()
    {
        return DB::table('course_teachers')->where('user_id',$this->id)->first();
    }

    public function uploadedFiles()
    {
        $directory = "private/members/{$this->id}";

        if (!Storage::disk('local')->exists($directory)) {
            return [];
        }

        return Storage::disk('local')->files($directory);
    }

    public function getDeletionSummary()
    {
        $userId = $this->id;

        return [
            'course_registrations' => DB::table('course_registrations')->where('user_id', $userId)->count(),
            'course_comments' => DB::table('course_comments')->where('user_id', $userId)->count(),
            'wallet' => null, // statically returning null
        ];
    }

    public function receivedMessages()
    {
        return $this->hasManyThrough(Message::class, MessageRecipient::class, 'user_id', 'id', 'id', 'message_id');
    }

    public function hasMessages(): bool
    {
        $adminId = Auth::id();

        return \App\Models\Message::where('sender_id', $adminId)
            ->whereHas('recipients', function ($query) {
                $query->where('user_id', $this->id);
            })
            ->exists();
    }
}
