<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Http\Traits\AuditTrait;

class Admin extends Authenticatable {

    use LaratrustUserTrait, AuditTrait;

    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'nombre', 'apellido', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rol() {
        return $this->hasOne('App\Models\UserRol', 'role_id', 'user_id');
    }
    
    public function roles() {
        return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id','role_id');
    }    
}