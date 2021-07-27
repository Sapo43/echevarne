<?php

namespace App\Http\Traits;


trait PTrait {
    
    public function porcentaje_venta() {
        // Fetch all the students from the 'student' table.
        $porcentaje_venta=0;
        if(\Auth::user()){
         
            $porcentaje_venta=\Auth::user()->porcentaje_venta;
        }
        return $porcentaje_venta;
    }


    public function porcentaje_compra() {
        // Fetch all the students from the 'student' table.
        $porcentaje_compra=0;
        if(\Auth::user()){
         
            $porcentaje_compra=\Auth::user()->porcentaje_compra;
        }
        return $porcentaje_compra;
    }

    public function ifAuthZero() { 
        if( !\Auth::user()){
            return false;
        }
        
        return \Auth::user()->porcentaje_compra==0;
            
        
        
    }
}