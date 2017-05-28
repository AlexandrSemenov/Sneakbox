<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function isAdmin()
    {
        $roles = User::find(Auth::user()->id)->roles()->first();
        if($roles->name == 'Admin')
        return true;
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }

    public function conversations()
    {
        return $this->belongsToMany('App\Models\Conversation', 'conversations_users');
    }

    public function notification()
    {
        return $this->hasOne('App\Models\Notification');
    }

    public function can_receive_message_notification()
    {
        return $this->notification->message_notification;
    }
}
