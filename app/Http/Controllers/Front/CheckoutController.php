<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Rubro;
use App\Models\Marca;
use App\Models\User;
use Illuminate\Http\Request;
use App;
use PDF;
use App\Http\Traits\PTrait;



class CheckoutController extends Controller {

    use PTrait;

public function index(){
  
    $scripts = array(
        ('/assets/js/iziToast.min.js'),
        ('/assets/js/precioslistacompraventa.js'),
        ('/assets/js/confirmarCarrito.js'),
        

    );         


$csss=array(
        ('/assets/css/iziToast.css'),
        ('/assets/css/addtocartanimation.css')
);

$clientes=User::all();
$porcentaje_compra=$this->porcentaje_compra();
$porcentaje_venta=$this->porcentaje_venta();
$isAuthZero=$this->ifAuthZero();

$porcentaje_compra=$this->porcentaje_compra();
$porcentaje_venta=$this->porcentaje_venta();
$isAuthZero=$this->ifAuthZero();

    $cart= \Session::get('cart');
    if (sizeof($cart)==0){
        return redirect()->route('shop'); 
    }

    $cantidadCarrito=sizeof($cart);      

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

    $cart= \Session::get('cart');
    return view ('pages.checkout.index',compact('clientes','isAuthZero','porcentaje_compra','porcentaje_venta','cart','totalsi','totalid','totaliv','totalci','scripts','csss'));
}




}