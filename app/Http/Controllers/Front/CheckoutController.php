<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Rubro;
use App\Models\Marca;
use Illuminate\Http\Request;
use App;
use PDF;




class CheckoutController extends Controller {


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

    $cart= \Session::get('cart');
    return view ('pages.checkout.index',compact('cart','scripts','csss'));
}




}