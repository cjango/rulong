<?php

namespace RuLong\Panel\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'username',
        'password',
        'nickname',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin()
    {
        return $this->id == 1;
    }

    protected function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    protected function setNicknameAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['nickname'] = ucfirst($this->username);
        } else {
            $this->attributes['nickname'] = $value;
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_role_user')->withTimestamps();
    }

    public function operationLogs()
    {
        return $this->hasMany(AdminOperationLog::class);
    }

    public function logins()
    {
        return $this->hasMany(AdminLogin::class);
    }

    public function lastLogin()
    {
        return $this->hasOne(AdminLogin::class)->latest()->withDefault();
    }
}
