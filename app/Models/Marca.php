<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AuditTrait;

class Marca extends Model
{

    use AuditTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marcas';
    protected $fillable = ['nombre', 'descripcion', 'imagen', 'meta_description'];

    public static function filterAndPaginate($nombre, $id)
    {
        return Marca::nombre($nombre)
            ->filterId($id)
            ->orderBy('nombre', 'asc')
            ->paginate(20);
    }

    public function scopeNombre($query, $nombre)
    {
        if (trim($nombre) != "") {
            $query->where('nombre', 'like', $nombre . '%');
        }
    }

    public function scopeFilterId($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }

    public static function getMarcas()
    {
        return \Cache::rememberForever('marcas', function () {
            return Marca::orderBy('nombre')->get();
        });
    }

}
