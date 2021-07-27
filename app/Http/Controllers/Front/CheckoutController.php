<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Rubro;
use App\Models\Marca;
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
        ('/assets/js/confirmarCarrito.js')       

    );         


$csss=array(
        ('/assets/css/iziToast.css'),
        ('/assets/css/addtocartanimation.css')
);
$porcentaje_compra=$this->porcentaje_compra();
$porcentaje_venta=$this->porcentaje_venta();
$isAuthZero=$this->ifAuthZero();
    $cart= \Session::get('cart');
    return view ('pages.checkout.index',compact('isAuthZero','porcentaje_compra','porcentaje_venta','cart','scripts','csss'));
}




}