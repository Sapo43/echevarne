<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AuditTrait;

class Carrito extends Model
{

    use AuditTrait;


     /**
     * The database table used by the model.
     *
     * @var string
     */
    // protected $hidden = ['detallePedido'];
    protected $table = 'carrito';
protected $fillable = ['user_id', 'producto_id', 'slug','cantidad'];

     public function detallePedido()
    {
    	return $this->hasMany(DetallePedido::class);
     }


   

     }