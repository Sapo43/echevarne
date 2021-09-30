<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Rubro;
use App\Models\Marca;
use App\Models\ImageModal;
use App\Models\User;
use App\Http\Requests;
use Carbon\Carbon;
use Validator;
use Auth;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mail;
use App\Events\StatusLiked;
use App\Http\Traits\PTrait;
class CartController extends Controller {

    use PTrait;

    public function __construct()
    {
        if(!\Session::has('cart')) \Session::put('cart',array());
        
        

       
    }

public function cartForCheckout(Request $request){

  
    $scripts = array(
        ('/assets/js/sweetalert2.min.js'),
        ('/assets/js/postConfirmCart.js'),
        ('/assets/js/incdeccart.js'),
        ('/assets/js/deleteFromCart.js'),
        ('/assets/js/loadDataToModal.js'),  

        
     
    );
    $csss=array(
        ('/assets/css/sweetalert2.min.css'),
        
);

    $porcentaje_compra=$this->porcentaje_compra();
    $porcentaje_venta=$this->porcentaje_venta();
    $isAuthZero=$this->ifAuthZero();
   
        $cart= \Session::get('cart');
        if (sizeof($cart)==0){
            return redirect()->route('shop'); 
        }
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
            return view('pages.cart.index',compact('isAuthZero','porcentaje_compra','porcentaje_venta','cantidadCarrito','cart','title','meta_description','h_image','totalsi','totalid','totaliv','totalci','scripts','csss'));
        }



    //Add item
    
    public function add(Producto $producto,$cantidad){

        
        $cart = \Session::get('cart');         
   

        if(array_key_exists($producto->slug,$cart)){
        
            $cart[$producto ->slug]->cantidad=$cart[$producto ->slug]->cantidad+$cantidad;
            
            \Session::put('cart',$cart); 
        }
        
        else{
            
             $producto->cantidad=$cantidad;
            $cart[$producto ->slug] = $producto;
            \Session::put('cart',$cart); 
       
      
      
        
    }  
    return response()->json(['msg'=>'Agregamos '.$producto->nombre.' a tu pedido',
    'cantidad'=>$cantidad  ]);
      
    }
    //Delete item

    public function delete(Producto $producto){
        $cart = \Session::get('cart');
                unset($cart[$producto->slug]);
        \Session::put('cart',$cart); 
        
  

        return response()->json(['msg'=>'ok ']);
    }

    //Update item

    public function update(Request $request){
  
        try {
            
            $cart = \Session::get('cart');          
            $productoBuscado= Producto::where('id','=', $request->id)->first();      
            \Log::debug('Test antes de actualizar' . $cart[$productoBuscado->slug]->cantidad . 'request cantidad'. $request->cantidad);      
            $cart[$productoBuscado->slug]->cantidad=$request->cantidad;
            \Session::put('cart',$cart); 
            \Log::debug('Test despues de actualizar' . $cart[$productoBuscado->slug]->cantidad . 'request cantidad'. $request->cantidad);
            return response()->json(['result'=>true]);        
        } catch (\Throwable $th) {

            return response()->json(['result'=>false]);
        }
      
    }

    //Trash cart
    public function trash(){

        if($user=Auth::user()){            
            $carrito=Carrito::where('user_id','=',\Auth::user()->id)->get();          
            foreach ($carrito as $key){
                $key->delete();
            }            
        }
       \Session::forget('cart');     
        return redirect()->route('shop');
    }


    public function confirmarCarrito(Request $request){


   
       
        
      $arrayPedidos=[];
            $totalsi=0;
            $totalid=0;
            $totaliv=0;
            $totalci=0;
            if($request->enNombre==null){
                $user=User::findOrFail(\Auth::user()->id);
            if (\Auth::user()->telefono!=$request->telefono){
                    $user->telefono=$request->telefono;   
            }
            if (\Auth::user()->codigo_postal!=$request->codigo_postal){
                $user->codigo_postal=$request->codigo_postal;
            }
            if (\Auth::user()->email!=$request->email){
                $user->email=$request->email;
            }
            if(\Auth::user()->direccion!=$request->direccion){
                $user->direccion=$request->direccion;
            }
            if(\Auth::user()->ciudad!=$request->ciudad){
                $user->ciudad=$request->ciudad;
            }
            if(\Auth::user()->nombre!=$request->nombre){
                $user->nombre=$request->nombre;
            }
            if(\Auth::user()->apellido!=$request->apellido){
                $user->apellido=$request->apellido;
            }
            if(\Auth::user()->cuit!=$request->cuit){
                $user->cuit=$request->cuit;
            }
            $user->save();
            }
            

            $cart = \Session::get('cart');
            $totalCant=0;
            $montoTotal=0;
            $pedido=new Pedido();
            $date=\Carbon\Carbon::now('America/Argentina/Buenos_Aires');
            $pedido->created_at=$date;
            if($request->enNombre_id==null){
            $pedido->created_by=\Auth::user()->id;
            $pedido->referido_por=\Auth::user()->id;
            }else{
                $pedido->created_by=$request->enNombre_id;
                $pedido->referido_por=\Auth::user()->id;
            }
           
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
      
       try {
          
         Mail::send('mails.mailPedido', ['detalles' => $detalles,'pedido'=>$pedido,'usuario'=>$usuario], function ($m) use ($arrayPedidos,$pedido,$usuario) {
             $m->from('info@echevarnehnos.com', 'Pedido desde la web');  
             $m->to(\Auth::user()->email);          
             $m->bcc('micaela@echevarnehnos.com')
             ->subject('Pedido nuevo'.\Auth::user()->nombre.' '.\Auth::user()->apellido);
         });
       } catch (\Throwable $th) {
           dd($th);
       }
      
      
   
        event(new StatusLiked('Someone'));
        if($user=Auth::user()){            
            $carrito=Carrito::where('user_id','=',\Auth::user()->id)->get();          
            foreach ($carrito as $key){
                $key->delete();
            }            
        }
        \Session::forget('cart');

			return response()->json(['success'=>'Tu pedido ha sido enviado.']);
        }


}
