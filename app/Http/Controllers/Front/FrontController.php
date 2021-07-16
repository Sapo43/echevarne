<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Descarga;
use App\Models\Novedad;
use App\Models\Marca;
use App\Models\Rubro;
use App\Models\Producto;

class FrontController extends Controller {

  

    public function home(){

        return view('pages.home.index');
    }

    public function shop(Request $request){

        
        
        
        $scripts = array(
            ('/assets/js/iziToast.min.js'),
            ('/assets/js/addToCart.js'),
            ('/assets/js/precioslistacompraventa.js'),
            ('/assets/js/downloadpdf.js'),
            ('/assets/js/paginatorshop.js'),
            ('/assets/js/searchInShop.js'),
            ('/assets/js/loadDataToModal.js'),
            ('/assets/js/carouselProducto.js')        
        );
        
        $csss=array(
                ('/assets/css/iziToast.css'),
                ('/assets/css/addtocartanimation.css'),
                ('/assets/css/carouselProducto.css')
        );
       
        $rubros = Rubro::getRubros()->pluck('nombre', 'id')->toArray();
        $marcas = Marca::getMarcas()->pluck('nombre', 'id')->toArray();
       
        if(\Auth::user()){
            $porcentaje_compra=\Auth::user()->porcentaje_compra;
            $porcentaje_venta=\Auth::user()->porcentaje_venta;
        }else{$porcentaje_compra=0;
                $porcentaje_venta=0;
        };
    // PARA PODER VOLVER A LA PAGINA ANTERIOR EN LA Q
    
       
      
                 if($request->ajax()){
                   
                    $data = Producto::filterAndPaginate1($request->get('nombre'), $request->get('rubro'), $request->get('marca'), $request->get('equivalencia'), "1");  
                    \Session::put('productos', $data->get());
                            $data=$data->paginate(5);                           
                   
                    return view('includes.shopgrid', compact('data','scripts','csss','porcentaje_compra','porcentaje_venta','rubros', 'marcas'))->render();
        }
      
        $data = Producto::filterAndPaginate1($request->get('nombre'), $request->get('rubro'), $request->get('marca'), $request->get('codigo'), "1");
        \Session::put('productos', $data->get());
        $data=$data->paginate(5); 
            return view('pages.shop.index', compact('data','scripts','csss','porcentaje_compra','porcentaje_venta','rubros', 'marcas'));
           
       
          


        
    }

    

  
   public function about(){
       return view('pages.about.index');
   }
    



public function servicios() {
    $title = 'Echevarne Hermanos - Servicios';
    $meta_description = '';
    $h_image = 'servicios.png';
    
    return view('pages.servicios.index', compact('title', 'meta_description', 'h_image'));
}

public function descargas() {
    $title = 'Echevarne Hermanos - Descargas';
    $meta_description = '';
    $h_image = 'descargas.png';
    $descargas = Descarga::where('visible', 1)->orderBy('orden')->get();
    
    return view('pages.descargas.index', compact('title', 'meta_description', 'descargas', 'h_image'));
}

public function showNovedad($slug){
    
    $novedad = Novedad::where('f_url',$slug)->firstOrFail();
    $title = 'Echevarne Hermanos - '.$novedad->titulo;
    $h_image = 'novedades.png';
    $meta_description = $novedad->texto;  
    
    return view('front.novedad', compact('title', 'meta_description', 'novedad', 'h_image'));        
}


public function contacto(){
    return view('pages.contacto.index');
}


public function myPaginator($items, $page )
{

    $perPage = 24;
    $options = [];
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);
    return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
}


public function getMiniCart(){
    $cart= \Session::get('cart');
    return view('includes.minicart',compact('cart'));
}   
    
}
