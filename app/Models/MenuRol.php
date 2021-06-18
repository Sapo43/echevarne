<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuRol extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menus_roles';

    protected $fillable = ['rol_id', 'menu_id'];
    
    public function scopeMenu($query, $menuId) {
        if (trim($menuId) != "") {
            $query->where('menu_id', $menuId);
        }
    }
    
}
