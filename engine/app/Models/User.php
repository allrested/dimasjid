<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','role','username','is_superuser','is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->hasOne('\App\Models\Role','id','role');
    }

    public function berita()
    {
        return $this->hasMany('App\Models\Berita', 'id_user', 'id');
    }

    public function agenda()
    {
        return $this->hasMany('App\Models\Agenda', 'id_user', 'id');
    }

    public function masjid()
    {
        return $this->hasOne('App\Models\Masjid','id','is_superuser');
    }

    public function isUser($user){
        if ($this->role == $user) {
            return true;
        }
        return false;
    }

    public function isAdmin(){
        if ($this->role == 1) {
            return true;
        }
        return false;
    }

    public function isSekretariat(){
        if ($this->role == 2) {
            return true;
        }
        return false;
    }
}
