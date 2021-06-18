<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AuditTrait;

class Producto extends Model
{

    use AuditTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'productos';
    protected $fillable = ['codigo', 'nombre', 'cod_barra', 'precio', 'iva', 'rubro_id', 'marca_id', 'activo', 'univen', 'cod_origen', 'stock', 'stock_minimo', 'actualizado', 'imagen', 'descripcion', 'notas'];

    //TODO: Agregar busqueda por Equivalencias

    public static function filterAndPaginate($nombre, $id_rubro, $id_marca, $codigo, $activo)
    {
        return Producto::filterNombre($nombre)
            ->filterRubro($id_rubro)
            ->filterMarca($id_marca)
            ->filterCodigo($codigo)
            ->filterActivo($activo)
            ->orderBy("codigo");
           
    }
    public static function filterAndPaginate1($nombre, $id_rubro, $id_marca, $codigo, $activo)
    {
        return Producto::select('productos.*')
            ->filterNombre($nombre)
            ->filterRubro($id_rubro)
            ->filterMarca($id_marca)
            ->filterCodigoEquiv($codigo)
            ->filterActivo($activo)
            ->orderBy("productos.codigo");
            
     
            
        
    }
    public static function filterWithoutPaginate($nombre, $id_rubro, $id_marca, $codigo, $activo)
    {
        return Producto::
            filterNombre($nombre)
            ->filterRubro($id_rubro)
            ->filterMarca($id_marca)
            ->filterCodigo($codigo)
            ->filterActivo($activo)
            ->orderBy("codigo")->get();
          
    }

    public function scopeFilterNombre($query, $nombre)
    {
        if (trim($nombre) != '') {
            $query->where('nombre', 'like', '%' . $nombre . '%');
        }
    }

    public function scopeFilterRubro($query, $id_rubro)
    {
        if (trim($id_rubro) != '' && $id_rubro != 0) {
            $query->where('rubro_id', $id_rubro);
        }
    }

    public function scopeFilterMarca($query, $id_marca)
    {
        if (trim($id_marca) != '' && $id_marca != 0) {
            $query->where('marca_id', $id_marca);
        }
    }

    public function scopeFilterCodigo($query, $codigo)
    {
        if (trim($codigo) != '') {
            $query->where('codigo', 'like', '%' . str_replace('/', '', $codigo) . '%');
        }
    }
    public function scopeFilterCodigoEquiv($query, $codigo)
    {
        if (trim($codigo) != '') {
            $query->where('productos.codigo', 'like', '%' . str_replace('/', '', $codigo) . '%')
            ->orWhere('productos.equivalencia', 'like', '%' . str_replace('/', '', $codigo) . '%');
        }
    }
   

    public function scopeFilterActivo($query, $activo)
    {
        if (trim($activo) != "") {
            $query->where('activo', $activo);
        }
    }

    
    

    public function marca()
    {
        return $this->hasOne('App\Models\Marca', 'id', 'marca_id');
    }

    public function rubro()
    {
        return $this->hasOne('App\Models\Rubro', 'id', 'rubro_id');
    }

    public function getIVA()
    {
        if ($this->iva == 1) {
            return '10,5%';
        } else {
            return '21%';
        }
    }

    // public function getActualizadoAttribute($date)
    // {
    //     if ($date != '0000-00-00 00:00:00') {
    //         return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    //     } else {
    //         return '';
    //     }

    // }





}
