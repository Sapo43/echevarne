<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'departamentos';

    public static function getDepartamentosJurisdiccion($cod_jur) {
        return \Cache::rememberForever('departamentos_' . $cod_jur, function() use($cod_jur) {
                    return Departamento::jurisdiccion($cod_jur)->orderBy('nombre')->get();
                });
    }

    public function scopeJurisdiccion($query, $cod_jur) {
        if (trim($cod_jur) != '' && $cod_jur != 0) {
            $query->where('cod_jurisdiccion', $cod_jur);
        }
    }

    public function scopeNombre($query, $nombre) {
        if (trim($nombre) != '') {
            $query->where('nombre', $nombre);
        }
    }

}
