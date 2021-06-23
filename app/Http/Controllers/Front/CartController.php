<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Producto;
use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Rubro;
use App\Models\Marca;
use App\Models\ImageModal;
use App\Http\Requests;
use Carbon\Carbon;
use Validator;
use Auth;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mail;

class CartController extends Controller {



    public function __construct()
    {
        if(!\Session::has('cart')) \Session::put('cart',array());
       
    }

public function cartForCheckout(){


    $scripts = array(
        ('/assets/js/postConfirmCart.js'),
      
     
    );

        $cart= \Session::get('cart');
        $title = "Pedido";
        $cantidadCarrito=sizeof($cart);      
        $meta_description = "";
        $h_image = 'ficha_producto.png';
        $totalsi=0;
        $totalid=0;
        $totaliv=0;
        $totalci=0;
        // if (empty($cart)){
        //     return view('front.carrito.vacio',compact('cantidadCarrito','title','meta_description','h_image')); 
        // }else{
            foreach ($cart as $key){  
            
                $totalsi=$totalsi+($key->precio*$key->cantidad);

                if($key->iva==21){
                    $totaliv=$totaliv+((($key->precio*$key->cantidad)*$key->iva)/100);
                }
                
                if($key->iva==10.5){
                    $totalid=$totalid+((($key->precio*$key->cantidad)*$key->iva)/100);
         
                }
                
            }
            $totalci=$totalsi+$totalid+$totaliv;

    
          //  return view('front.carrito.carrito',compact('cantidadCarrito','cart','title','meta_description','h_image','totalsi','totalid','totaliv','totalci'));
            return view('pages.cart.index',compact('cantidadCarrito','cart','title','meta_description','h_image','totalsi','totalid','totaliv','totalci','scripts'));
        }



    //Add item
    
    public function add(Producto $producto){

        
        $cart = \Session::get('cart');   
    

        

        $producto->cantidad=1;

        if(in_array($producto,$cart)){
            return response()->json(['msg'=>'Ya existe el producto '.$producto->nombre.' en tu pedido',
            'cantidad'=>0
]);   
        }else{
        $cart[$producto ->slug] = $producto;
        \Session::put('cart',$cart); 
        return response()->json(['msg'=>'Agregamos '.$producto->nombre.' a tu pedido',
                                 'cantidad'=>1   
        ]);
    }    
        
        
        
      
    }
    //Delete item

    public function delete(Producto $producto){
        $cart = \Session::get('cart');
        unset($cart[$producto ->slug]);
        \Session::put('cart',$cart); 
        return redirect()->route('cart-show')    ;
    }

    //Update item

    public function update(Producto $producto,$cantidad){
 
        $cart = \Session::get('cart');

        $cart[$producto ->slug]->cantidad=$cantidad;
        \Session::put('cart',$cart); 
        return redirect()->route('cart-show')    ;
    }

    //Trash cart
    public function trash(){
       \Session::forget('cart');
     
        return redirect()->route('cart-show')    ;
    }


    public function confirm(Request $request){


       
        // $validator = Validator::make($request->all(), [
        //     'notas' => 'required',
            
        // ]);


        // if ($validator->passes()) {
      $arrayPedidos=[];
            $totalsi=0;
            $totalid=0;
            $totaliv=0;
            $totalci=0;


            $cart = \Session::get('cart');
            $totalCant=0;
            $montoTotal=0;
         $pedido=new Pedido();
         $date=\Carbon\Carbon::now('America/Argentina/Buenos_Aires');
         $pedido->created_at=$date;
         $pedido->created_by=\Auth::user()->id;
         foreach ($cart as $key){  
               
            $totalCant=$totalCant+$key->cantidad; 
            $montoTotal=$montoTotal+($key->precio*$key->cantidad);
   

            if($key->iva==21){
                $totaliv=$totaliv+((($key->precio*$key->cantidad)*$key->iva)/100);
            }
            
            if($key->iva==10.5){
                $totalid=$totalid+((($key->precio*$key->cantidad)*$key->iva)/100);
     
            }    


        }
            
            $pedido->total_monto=$montoTotal;
            $pedido->total_cantidad=$totalCant;
            $pedido->ivad=$totalid;
            $pedido->ivav=$totaliv;
            $pedido->status_id=1;
            $pedido->notas=$request->notas;
         $pedido->save();

     foreach ($cart as $key)
     {   
  

        $detallePedido=new DetallePedido();
        $detallePedido->cantidad=$key->cantidad;
        $detallePedido->precio=$key->precio;
        //$detallePedido->iva=$key->iva;
        $detallePedido->slug=$key->slug;
   
        $detallePedido->created_at=$date;
        $detallePedido->pedido_id=$pedido->id;
        //guardar en producto_id de detalle de pedido el id de producto q esta en el cart
        $detallePedido->producto_id=$key->id;
        $detallePedido->save();
        array_push($arrayPedidos,$detallePedido);
     }
     $detalles = DetallePedido::select('productos.codigo','productos.nombre','marcas.nombre as marca','rubros.nombre as rubro','detail_pedidos.*')
     ->join('productos','productos.id','=','detail_pedidos.producto_id')
     ->join('rubros','rubros.id','=','productos.rubro_id')
     ->join('marcas','marcas.id','=','productos.marca_id')
     ->where("pedido_id","=",$pedido->id)->get();   
     
            
            $usuario=\Auth::user()->nombre.' '.\Auth::user()->apellido;
      
    //   try {
          
    //     Mail::send('mails.mailPedido', ['detalles' => $detalles,'pedido'=>$pedido,'usuario'=>$usuario], function ($m) use ($arrayPedidos,$pedido,$usuario) {
    //         $m->from('echevarnehermanos@gmail.com', 'Pedido desde la web');
            
    //         $m->bcc('sm.blanco@hotmail.com')
    //         ->subject('Pedido nuevo'.\Auth::user()->nombre.' '.\Auth::user()->apellido);
    //     });
    //   } catch (\Throwable $th) {
    //       dd($th);
    //   }
      
      



     \Session::forget('cart');
			return response()->json(['success'=>'Tu pedido ha sido enviado.']);
        }


}
