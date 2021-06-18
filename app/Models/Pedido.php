<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AuditTrait;

class Pedido extends Model
{

    use AuditTrait;


     /**
     * The database table used by the model.
     *
     * @var string
     */
    // protected $hidden = ['detallePedido'];
    protected $table = 'pedidos';
protected $fillable = ['user_id', 'created_by', 'created_at', 'update_by', 'update_at', 'status_id','total_cantidad','total_monto','notas'];

     public function detallePedido()
    {
    	return $this->hasMany(DetallePedido::class);
     }


   

     }