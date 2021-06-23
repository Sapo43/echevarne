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

        $scripts=[];
        $script='<script src="/assets/js/iziToast.min.js" type="text/javascript"></script> ';
        array_push($scripts,$script);

        if($request->ajax())
        {
         $data = DB::table('productos')->paginate(5);
         return view('includes.shopgrid', compact('data','scripts'))->render();
        }
        
            $data = DB::table('productos')->paginate(5);
            return view('pages.shop.index', compact('data','scripts'));
           
       
          


        
    }

    

  
   
    


    
}
