<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AuditTrait;

class Descarga extends Model
{

    use AuditTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'descargas';
    protected $fillable = ['orden', 'nombre', 'tipo_archivo', 'peso', 'version', 'imagen', 'archivo', 'visible'];

}
