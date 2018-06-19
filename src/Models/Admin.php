<?php

namespace RuLong\Panel\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'username',
        'password',
        'nickname',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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
