<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\DetallePedido;
use App\Models\Rubro;
use App\Models\Marca;
use App\Models\Status;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;


class PedidosController extends Controller {

    const DESTINATION_PATH = '/pedidos';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        if (\Auth::guard('admin')->user()->can(['pedidos-ver'])) {
          
            
            
            $pedidos = Pedido::
            select('pedidos.id','pedidos.notas','pedidos.created_at','users.apellido','pedidos.total_monto', 'status.estado','pedidos.total_cantidad')
                        ->join('users', 'users.id', '=', 'pedidos.created_by')
                        // ->join('orders', 'users.id', '=', 'orders.user_id')
                        ->join('status','status.id','=','pedidos.status_id')
                        
                        ->orderBy('pedidos.status_id')
                        ->paginate(20);

        
            return view('admin.pedidos.index', compact('pedidos'));
        } else {
            return view('errors.noTienePermisos');
        }
    }

    public function detalle($id){
        
        if (\Auth::guard('admin')->user()->can(['pedidos-ver'])) {

            $status = Status::all();
            $detalles = DetallePedido::select('productos.codigo','productos.nombre','marcas.nombre as marca','rubros.nombre as rubro','detail_pedidos.*')
            ->join('productos','productos.id','=','detail_pedidos.producto_id')
            ->join('rubros','rubros.id','=','productos.rubro_id')
            ->join('marcas','marcas.id','=','productos.marca_id')
            ->where("pedido_id","=",$id)->get();   
                //dd($detalles);
            $pedido = User::select("status.estado",'users.apellido','pedidos.*')
            ->join("pedidos","pedidos.created_by","=","users.id")
            ->join('status','status.id','=','pedidos.status_id')
       
    ->where('pedidos.id','=',$id)
    ->first();


           
            return view('admin.pedidos.detalle', compact('detalles','pedido','status'));
    }else {return view('errors.noTienePermisos');}

}

public function atender(Request $request){
   
     
       


          $pedido = Pedido::where("id","=",$request->idPedido)->get();
   
          $pedido[0]->status_id=$request->idStatus;
       $pedido[0]->save();
        
        // $pedidos = DB::table('pedidos')
        // ->join('users', 'users.id', '=', 'pedidos.created_by')
        // // ->join('orders', 'users.id', '=', 'orders.user_id')
        // ->join('status','status.id','=','pedidos.status_id')
        // ->select('pedidos.id','pedidos.created_at','users.apellido','pedidos.total_monto', 'status.estado','pedidos.total_cantidad')
        // ->orderBy('pedidos.created_at')
        // ->paginate(10);
      
        return response()->json(['redirect'=>'/admin/pedidos']);
}

}


