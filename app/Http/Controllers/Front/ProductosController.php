<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Rubro;
use App\Models\Marca;
use Illuminate\Http\Request;
use App;
use PDF;




class ProductosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        $scripts = array(
            ('/assets/js/precioslistacompraventa.js') 
        );

        
        $title = "Listado de Productos";
        $meta_description = "";
        $h_image = 'productos.png';
        $rubros = Rubro::getRubros()->lists('nombre', 'id')->toArray();
        $marcas = Marca::getMarcas()->lists('nombre', 'id')->toArray();
        $productos = Producto::filterAndPaginate($request->get('nombre'), $request->get('rubro'), $request->get('marca'), $request->get('codigo'), "1");
        $total=sizeof($productos->get());
        $productos=$productos->paginate(24);
        $links = $productos->links();        
        $links = str_replace("<a", "<a class='page-link' ", $links);
   
        return view('front.producto.productos', compact('productos', 'rubros', 'marcas', 'title', 'meta_description', 'h_image','total','scripts'));
    }

    // public function show($slug,Request $request) {
    
    //     $p_id = substr($slug, 0, strpos($slug, '-'));
    //     $producto = Producto::find($p_id);
    //     $h_image = 'ficha_producto.png';

    //     if (isset($producto)) {
    //         $seo_title = 'Echevarne Hermanos - ' . ucwords(strtolower($producto->nombre)) . ' Marca ' . ucfirst(strtolower($producto->marca->nombre));
    //         if (trim($producto->descripcion) != '') {
    //             $meta_description = $producto->descripcion;
    //         } else {
    //             if(isset($producto->rubro)) {
    //                 $meta_description = $producto->rubro->nombre . ' | ' . $producto->nombre . ' Marca: ' . $producto->marca->nombre;
    //             }else{
    //                 $meta_description = $producto->nombre . ' Marca: ' . $producto->marca->nombre;
    //             }
    //         }

    //         return view('front.producto.show', compact('seo_title', 'meta_description', 'producto', 'h_image'));
    //     } else {
    //         return redirect()->route('home');
    //     }
    // }
    
    public function show($slug,Request $request) {
    
        $scripts = array(
            ('/assets/js/iziToast.min.js'),
            ('/assets/js/addToCart.js'),         
        );
        
        $csss=array(
                ('/assets/css/iziToast.css'),
                ('/assets/css/addtocartanimation.css')
        );
        

         $p_id = substr($slug, 0, strpos($slug, '-'));
         $producto = Producto::find($p_id);
         $h_image = 'ficha_producto.png';

         if (isset($producto)) {
             $seo_title = 'Echevarne Hermanos - ' . ucwords(strtolower($producto->nombre)) . ' Marca ' . ucfirst(strtolower($producto->marca->nombre));
             if (trim($producto->descripcion) != '') {
                 $meta_description = $producto->descripcion;
             } else {
                 if(isset($producto->rubro)) {
                     $meta_description = $producto->rubro->nombre . ' | ' . $producto->nombre . ' Marca: ' . $producto->marca->nombre;
                 }else{
                     $meta_description = $producto->nombre . ' Marca: ' . $producto->marca->nombre;
                 }
             }

             if(str_contains($producto->codigo, '/')){
   
            $codProd = str_replace('/', '_', $producto->codigo);
             }  
         else{
     
              $codProd = $producto->codigo;
            }
        
             return view ('pages.product.index',compact('producto','codProd','scripts','csss'));
    }
}





    public function slug() {
        $productos = Producto::all();
        foreach ($productos as $producto) {
            $producto->slug = str_slug($producto->id . ' ' . $producto->nombre);
            $producto->save();
        }
    }



    public function downloadPdf(Request $request) {

    
        if(\Session::get('busqueda')){
       
            $productos=\Session::get('productos');
            

        }else{
        $productos = Producto::filterWithoutPaginate($request->get('nombre'), $request->get('rubro'), $request->get('marca'), $request->get('codigo'), "1");      
    }
        
        $data = [
            'title' => 'Lista de Precios',
            'heading' => 'Lista de Precios',
            'productos'=>$productos,
            'pie1'=>'Primera Junta 104 - CP 6.000  |  Junín - Buenos Aires  |  T: 0236 – 4434583  4423989',
            'pie2'=>'0236 – 4411224  info@echevarnehnos.com | www.echevarnehnos.com'
        
        

        ];
        $pdf = App::make('dompdf.wrapper');
      
        $pdf->loadview('pdf.productosfiltro',$data);
        return $pdf->download();
        
       // return view('front.producto.productos', compact('productos', 'rubros', 'marcas', 'title', 'meta_description', 'h_image'));
    }

}
