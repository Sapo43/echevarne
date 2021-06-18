<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menus';

    protected $fillable = ['nivel', 'padre', 'nombre', 'url', 'url_type'];
    
    public function scopePadre($query, $padre) {
        if (trim($padre) != "") {
            $query->where('padre', $padre);
        }
    }
    
}
