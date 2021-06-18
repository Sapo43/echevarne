<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AuditTrait;

class Novedad extends Model {

    use AuditTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'novedades';
    protected $fillable = ['titulo', 'subtitulo', 'imagen', 'link', 'visible', 'texto', 'es_producto'];

}
