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
use App\Models\Pedido;
use App\Models\User;
use App\Http\Traits\PTrait;
use Illuminate\Support\Facades\Storage;
use App\Helpers\StrHelper;
use App\Http\Traits\AuditTrait;
use File;
use Illuminate\Support\Facades\Validator;
class FrontController extends Controller {

  use PTrait;
  
  use AuditTrait;


  public function __construct()
  {
      if(!\Session::has('busquedaArray')) \Session::put('busquedaArray',[]);
      if(!\Session::has('busquedaIndice')) \Session::put('busquedaIndice',-1);
      if(!\Session::has('cart')) \Session::put('cart',array());
      


     
  }

    public function home(){
    
        $cart= \Session::get('cart');
        $porcentaje_compra=$this->porcentaje_compra();
        $porcentaje_venta=$this->porcentaje_venta();   
         $scripts = array(    
            ('/assets/js/iziToast.min.js'),
            ('/assets/js/addToCart.js'),     
            ('/assets/js/deleteFromCart.js'),
            ('/assets/js/precioslistacompraventa.js'),
             ('/assets/js/loadDataToModal.js')
        );
        $csss=array(
            ('/assets/css/iziToast.css'),
            ('/assets/css/addtocartanimation.css'),
            ('/assets/css/carrusel.css')
    );
        $productos=Producto::orWhere('codigo','=','Gul tp x4')
                            ->orWhere('codigo','=','HUT 7 K 1515')
                            ->orWhere('codigo','=','NAR 48728')
                            ->orWhere('codigo','=','NOS RNI 1695')
                            ->orWhere('codigo','=','OR 621H15')
                            ->get();
                      
        $novedades = Novedad::where('visible', 1)->take(6)->orderBy('orden')->get();
        return view('pages.home.index', compact('porcentaje_compra','porcentaje_venta','productos','novedades','cart','scripts','csss'));
    }

    public function shop(Request $request,$novedad=null,$marca=null,$rubro=null,$codigo=null){
        $background="/assets/img/bg/page-header-bg.jpg";
        $cart= \Session::get('cart');
        $seccion="Shop";  
        $scripts = array(
            ('/assets/js/iziToast.min.js'),
            ('/assets/js/addToCart.js'),
            ('/assets/js/precioslistacompraventa.js'),
            ('/assets/js/downloadpdf.js'),
            ('/assets/js/paginatorshop.js'),
            ('/assets/js/searchInShop.js'),
            ('/assets/js/loadDataToModal.js'),
            ('/assets/js/carrusel.js'),
            ('/assets/js/deleteFromCart.js'),
            ('/assets/js/onkeyupsearch.js')
         );
        $csss=array(
                ('/assets/css/iziToast.css'),
                ('/assets/css/addtocartanimation.css'),
                ('/assets/css/carrusel.css')
        );
        $rubros = Rubro::getRubros()->pluck('nombre', 'id')->toArray();
        $marcas = Marca::getMarcas()->pluck('nombre', 'id')->toArray();
        $porcentaje_compra=$this->porcentaje_compra();
        $porcentaje_venta=$this->porcentaje_venta();        
        
  
        
        
        
        if($request->ajax()){
       


                    $data = Producto::filterAndPaginate1($request->get('nombre'), $request->get('rubro'), $request->get('marca'), $request->get('equivalencia'), "1");  
               
                              $count=sizeof($data->get());  
                            $busquedaArray= \Session::get('busquedaArray');
                            $busquedaIndice= \Session::get('busquedaIndice');                        
                            if(sizeof($busquedaArray)>4){                                
                                array_shift($busquedaArray);
                            }
                            if($busquedaIndice>3){
                                $busquedaIndice=2;
                            }
                            \Session::put('busquedaIndice',$busquedaIndice+1);
                            array_push($busquedaArray,$data->take(3)->get());
                            \Session::put('busquedaArray', $busquedaArray);        
         
                            $data=$data->paginate(12);
                    return view('includes.shopgrid', compact('count','background','cart','seccion','data','scripts','csss','porcentaje_compra','porcentaje_venta','rubros', 'marcas'))->render();
        }
        
       
        if($novedad){
            $rubrotxt='';
            if($rubro>0){
                $rubrotxt=Rubro::where('id','=',$rubro)->pluck('nombre')[0];
            }
            $marcatxt='';
            if ($marca>0){
                $marcatxt=Marca::where('id','=',$marca)->pluck('nombre')[0];
            }   
            
                        
           $data= Producto::filterAndPaginate1($request->get('nombre'), $rubro, $marca, $codigo, "1");
           
            $count=sizeof($data->get());
            $data=$data->paginate(12); 
     
        return view('pages.shop.index', compact('count','background','novedad','rubro','marca','rubrotxt','marcatxt','codigo','cart','seccion','data','scripts','csss','porcentaje_compra','porcentaje_venta','rubros', 'marcas'));
            
        }

        $data = Producto::filterAndPaginate1($request->get('nombre'), $rubro, $marca, $request->get('codigo'), "1");
  
          $count=sizeof($data->get());
        $data=$data->paginate(12); 

            $novedadid=null;
             $rubroid=null;
            $novedad=null;
            return view('pages.shop.index', compact('count','background','cart','seccion','data','scripts','csss','porcentaje_compra','porcentaje_venta','rubros', 'marcas'));
           
       
          


        
    }

    

  
   public function about(){
    $background="/assets/img/bg/page-header-bg.jpg";
    $scripts = array(
    ('/assets/js/deleteFromCart.js') 
    );
    $cart= \Session::get('cart');
    $seccion="About";
       return view('pages.about.index',compact('background','seccion','cart','scripts'));
   }
    



public function servicios() {
    $background="/assets/img/bg/page-header-bg.jpg";
    $title = 'Echevarne Hermanos - Servicios';
    $meta_description = '';
    $h_image = 'servicios.png';    
    return view('pages.servicios.index', compact('background','cart','title', 'meta_description', 'h_image'));
}

public function descargas() {
    $background="/assets/img/EH_BANNER05.jpg";
    $files = File::files(public_path()."/assets/iconDownloads/");
    $sizeofIconsFolder=sizeof($files);
    $cart = \Session::get('cart');
    $seccion="Catalogos";
    $title = 'Echevarne Hermanos - Catalogos';
    $meta_description = '';
    $h_image = 'descargas.png';
    $descargas = Descarga::where('visible', 1)->orderBy('orden')->get();
    
    return view('pages.descargas.index', compact('background','cart','seccion','title', 'meta_description', 'descargas', 'h_image','sizeofIconsFolder'));
}

public function showNovedad($slug){
    
    $novedad = Novedad::where('f_url',$slug)->firstOrFail();
    $title = 'Echevarne Hermanos - '.$novedad->titulo;
    $h_image = 'novedades.png';
    $meta_description = $novedad->texto;  
    
    return view('front.novedad', compact('cart','title', 'meta_description', 'novedad', 'h_image'));        
}


public function contacto(){
    $background="/assets/img/EH_BANNER02.jpg";
    $cart = \Session::get('cart');
    $seccion="Contacto";
    return view('pages.contacto.index',compact('background','seccion','cart'));
}


public function myPaginator($items, $page ){
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


public function misDatos(Request $request){
    $scripts = array(
        ('/assets/js/tablapedidos.js')
    );
    $background="/assets/img/EH_BANNER04.jpg";
    $cart = \Session::get('cart');
    $seccion="Administrador de cliente";

    $pedidos= Pedido::select('pedidos.id','status.estado','pedidos.created_at','pedidos.notas','pedidos.total_cantidad','pedidos.total_monto')

    -> join("status","pedidos.status_id","=","status.id")
     ->where("created_by","=",(\Auth::user()->id))->paginate(3);
     setlocale(LC_TIME, 'Argentina');

     if($request->ajax()){
         return view('pages.misDatos.tablaPedidos',compact('pedidos'));
     }

     
        $cliente = User::findOrFail(\Auth::user()->id);

    return view('pages.misDatos.index',compact('cliente','background','seccion','cart','scripts','pedidos'));
}

public function PostMisDatos(Request $request,$id){
    try {
        $data = \Request::all();       
        $cliente = User::findOrFail($id);
        $data['dni'] = StrHelper::soloNumeros(trim($data['dni']));
        $data['cuit'] = StrHelper::soloNumeros(trim($data['cuit']));
                $cliente->fill($data);    
        $cliente->setAudit('web');
        $cliente->save();
    } catch (\Throwable $th) {
        //throw $th;
    }
 


    $background="/assets/img/EH_BANNER04.jpg";
    $cart = \Session::get('cart');
    $seccion="Mis Datos";
    return redirect()->route('shop');
}


public function updatePassword($userId)
{
    if (\Auth::user()->id == $userId) {
        $data = \Request::all();
        $v = $this->validarContraseña($data);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput(\Request::All());
        }

        $user = User::findOrFail($userId);
        //Si la Contraseña Actual ingresada es Correcta
        if (\Hash::check($data['contraseña_actual'], $user->password)) {
            $user->password = \Hash::make($data['contraseña']);
            $user->setAudit('web');
            //Por si viene del cambio de Contraseña
            if (!isset(\Auth::user()->last_login)) {
                $user->last_login = \Carbon\Carbon::now();
            }
            $user->save();
        } else {
            return redirect()->back()->withErrors(['La contraseña ingresada no coincide con su contraseña actual']);
        }

        return redirect()->route('home');

    } else {
        return view('errors.503');
    }
}





public function shopRecentSearch(Request $request){
   
 
           
    $busquedaArray = \Session::get('busquedaArray');
    $busquedaIndice=\Session::get('busquedaIndice');
   
    if($busquedaIndice>=1 && sizeof($busquedaArray)>=1){

        $products=$busquedaArray[$busquedaIndice-1];
    }else{
        $products=[];
    }

   


    return view('pages.product.recent.recentProduct',compact('products'));
}





private function validarContraseña($data)
{

    $messages = [
        'contraseña_actual.required' => 'El Campo Contraseña Actual es Obligatorio',
        'contraseña.min' => 'La Contraseña debe tener como minimo 8 caracteres',
        'contraseña.required' => 'El campo Nueva Contraseña es obligatorio',
        'contraseña.regex' => 'La Nueva Contraseña debe contener letras y numeros',
        'contraseña.different' => 'La Nueva Contraseña debe ser diferente a la Actual',
        'contraseña_rep.same' => 'La Contraseñas ingresadas no coinciden',
        'contraseña_rep.required' => 'El campo Repetir Contraseña es obligatorio',
    ];

    $rules = array(
        'contraseña_actual' => 'required',
        'contraseña' => 'required|min:8|regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/|different:contraseña_actual',
        'contraseña_rep' => 'required|same:contraseña',
    );

    return Validator::make($data, $rules, $messages);
}
    

    
}
