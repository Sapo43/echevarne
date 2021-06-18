<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'localidades';

    public static function getLocalidadesJurisdiccion($cod_jur){
        return \Cache::rememberForever('localidades_' . $cod_jur, function() use($cod_jur) {
                    return Localidad::jurisdiccion($cod_jur)->orderBy('nombre')->get();
                });        
    }
    
    public static function getLocalidadesDepartamento($cod_dep){
         $localidades = Localidad::departamento($cod_dep)->orderBy('nombre')->get();
         return $localidades;
    }    
    
    public function scopeJurisdiccion($query, $cod_jur){
        if(trim($cod_jur) != '' && $cod_jur != 0){
            $query->where('cod_jurisdiccion',$cod_jur);
        }
    }
    
    public function scopeDepartamento($query, $cod_dep){
        if(trim($cod_dep) != '' && $cod_dep != 0){
            $query->where('cod_departamento',$cod_dep);
        }
    }    
    
    public function scopeNombre($query, $nombre){
        if(trim($nombre) != ''){
            $query->where('nombre',$nombre);
        }
    }        
}
