<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuUsuario extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menus_disable_by_users';

    protected $fillable = ['user_id', 'menu_id'];
    
    public function scopeMenu($query, $menuId) {
        if (trim($menuId) != "") {
            $query->where('menu_id', $menuId);
        }
    }
    
}
