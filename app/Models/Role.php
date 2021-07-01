<?php namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {
 
    protected $fillable = ['name', 'display_name', 'description'];
    
    public static function getRoles() {
        return \Cache::rememberForever('roles', function() {
            return Role::all();
        });
    }
    
}