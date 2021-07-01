<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FrontController extends Controller {

  

    public function home(){

        return view('pages.home.index');
    }

    public function shop(Request $request){

        $scripts = array(
            ('/assets/js/iziToast.min.js'),
            ('/assets/js/addToCart.js'),
            ('/assets/js/precioslistacompraventa.js')

         
        );
        
        $csss=array(
                ('/assets/css/iziToast.css'),
                ('/assets/css/addtocartanimation.css')
        );
        if(\Auth::user()){
            $porcentaje_compra=\Auth::user()->porcentaje_compra;
            $porcentaje_venta=\Auth::user()->porcentaje_venta;
        }else{$porcentaje_compra=0;
                $porcentaje_venta=0;
        };
        if($request->ajax())
        {
         $data = DB::table('productos')->paginate(5);
         return view('includes.shopgrid', compact('data','scripts','porcentaje_compra','porcentaje_venta'))->render();
        }
      
            $data = DB::table('productos')->paginate(5);
            return view('pages.shop.index', compact('data','scripts','porcentaje_compra','porcentaje_venta'));
           
       
          


        
    }

    

  
   
    


    
}
