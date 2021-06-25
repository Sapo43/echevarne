<?php namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole {
 
    protected $fillable = ['name', 'display_name', 'description'];
    
    public static function getRoles() {
        return \Cache::rememberForever('roles', function() {
            return Role::all();
        });
    }
    
}