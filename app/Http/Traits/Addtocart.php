<?php

namespace App\Http\Traits;
use App\Models\Producto;
trait Addtocart {





    public function addtocart(Producto $producto,$cantidad) {
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
    }

}