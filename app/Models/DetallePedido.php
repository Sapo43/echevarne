<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AuditTrait;

class DetallePedido extends Model
{
    // protected $hidden = ['pedido'];
    use AuditTrait;


     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detail_pedidos';

 public function pedido()
    {
    return $this->belongsTo(Pedido::class);
    }
    public function producto()
    {
    return $this->belongsTo(Producto::class);
    }
}