<?php

namespace App\Models;

use App\Models\Role;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function avatar()
    {
        return 'http://www.gravatar.com/avatar/' . md5($this->email) . '?s=35&d=mm';
    }

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role','role_user');
    }
}
