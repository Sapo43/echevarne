<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AuditTrait;

class Rubro extends Model {

    use AuditTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rubros';
    protected $fillable = ['nombre', 'descripcion', 'imagen', 'meta_description'];

    public static function filterAndPaginate($nombre) {
        return Rubro::nombre($nombre)
                        ->orderBy('nombre', 'asc')
                        ->paginate(20);
    }

    public function scopeNombre($query, $nombre) {
        if (trim($nombre) != "") {
            $query->where('nombre', 'like', $nombre.'%');
        }
    }      
    
    public static function getRubros() {
        return \Cache::rememberForever('rubros', function() {
            return Rubro::orderBy('nombre')->get();
        });
    }    
    
}
