<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AuditTrait;

class Contacto extends Model {

    use AuditTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contactos';
    protected $fillable = ['nombre', 'email', 'consulta', 'telefono', 'localidad'];
    
}
