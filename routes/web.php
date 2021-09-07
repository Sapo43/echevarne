<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\ProductosController as FrontProductosController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuth\AuthController;
use App\Http\Controllers\Admin\Importers\ImporterEquivalenciasController;
use App\Http\Controllers\Admin\Importers\ImporterMarcasController;
use App\Http\Controllers\Admin\Importers\ImporterProductosController;
use App\Http\Controllers\Admin\Importers\ImporterRubrosController;
use App\Http\Controllers\Admin\Importers\ImportersController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientesController;
use App\Http\Controllers\Admin\ContactosController;
use App\Http\Controllers\Admin\ProcesosController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\Admin\DescargasController;
use App\Http\Controllers\Admin\NovedadesController;
use App\Http\Controllers\Admin\PedidosController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PusherController;









Route::get('/', [FrontController::class,'home']);
Route::get('/home', [FrontController::class,'home'])->name('home');
Route::get('/shop/{novedad?}/{marca?}/{rubro?}/{codigo?}', [FrontController::class,'shop'])->name('shop');
Route::get('/producto/{slug}', [FrontProductosController::class,'show'])->name('front.productos.show');
Route::get('/shopRecentSearch',[FrontController::class,'shopRecentSearch']);
// Route::get('/shop/fetch_data', [FrontController::class,'shop'])->name('shop');
Route::get('/cart',[CartController::class,'cartForCheckout'])->name('cart');
Route::get('/logout',[LoginController::class,'logout']);
Route::get('/about',[FrontController::class,'about'])->name('about');
Route::get('/descargas',[FrontController::class,'descargas'])->name('descargas');
Route::get('/contacto',[FrontController::class,'contacto'])->name('contacto');
Route::get('file/{folder}/{filename}', [FileController::class,'getFile'])->where('filename', '^[^/]+$');
Route::get('/trash',[CartController::class,'trash'])->name('trash');





Route::bind('producto',function($slug){
    return App\Models\Producto::where ('slug', $slug)->first();
});



Route::get('/cart/add/{producto}/{cantidad?}',[CartController::class,'add'])->name('addToCart');
Route::get('cart/delete/{producto}',[CartController::class,'delete'])->name('cart-delete');
Route::post('cart/update',[CartController::class,'update'])->name('cart-update');




Auth::routes();




Route::get('/checkout', [CheckoutController::class,'index'])->middleware('auth');
Route::post('/checkout/confirmar', [CartController::class,'confirm'])->middleware('auth');
Route::get('/misDatos',[FrontController::class,'misDatos'])->middleware('auth');
Route::post('/misDatos',[FrontController::class,'misDatos'])->middleware('auth');
Route::post('/misDatos/{id}',[FrontController::class,'PostMisDatos'])->middleware('auth');
Route::post('/downloadPdf',[FrontProductosController::class,'downloadpdf']);




/* * ------ Administrador----------* */
Route::get('/admin', [HomeController::class,'index']);

Route::get('/admin/login', [AuthController::class,'adminLogin'])->name('auth.admin.login');
Route::post('/admin/login', [AuthController::class,'adminLoginPost'])->name('auth.admin.loginPost');
Route::get('/admin/logout', [AuthController::class,'adminLogout'])->name('auth.admin.logout');


Route::prefix('admin')->namespace('Admin')->group(static function() {

    Route::middleware(['auth:admin'])->name('admin.')->group(static function () {
        //...
        Route::resource('novedades', '\App\Http\Controllers\Admin\NovedadesController');
        Route::resource('usuarios', '\App\Http\Controllers\Admin\UserController');
        Route::resource('roles', '\App\Http\Controllers\Admin\RoleController');
        Route::resource('permisos', '\App\Http\Controllers\Admin\PermissionController');
        Route::resource('permisosRoles', '\App\Http\Controllers\Admin\RoleAndPermissionController');
        Route::resource('menus', '\App\Http\Controllers\Admin\MenuController');
        Route::resource('novedades', '\App\Http\Controllers\Admin\NovedadesController');
        Route::resource('descargas', '\App\Http\Controllers\Admin\DescargasController');
        
        Route::resource('rubros', '\App\Http\Controllers\Admin\RubrosController');
        Route::resource('marcas', '\App\Http\Controllers\Admin\MarcasController');
        Route::resource('contactos', '\App\Http\Controllers\Admin\ContactosController');
        Route::resource('clientes', '\App\Http\Controllers\Admin\ClientesController');
        Route::resource('conocenos', '\App\Http\Controllers\Admin\ConocenosController');
        Route::resource('pedidos','\App\Http\Controllers\Admin\PedidosController');

        Route::get('/pedidos/detalle/{id}',[PedidosController::class,'detalle'])->name('pedidos.detalle');

    });
    
});


Route::middleware('auth:admin')->group(static function () {
    
Route::get('/admin/productos/edit/{id}',[ProductController::class,'edit'])->name('admin.productos.edit');
Route::get('/admin/productos',[ProductController::class,'index'])->name('admin.productos.index');
Route::put('/admin/productos/{producto}',[ProductController::class,'index'])->name('admin.productos.update');
Route::delete('/admin/productos/{id}',[ProductController::class,'destroy'])->name('admin.productos.destroy');
Route::get('/admin/productos/create',[ProductController::class,'create'])->name('admin.productos.create');
Route::post('/admin/store',[ProductController::class,'store'])->name('admin.productos.store');
});

Route::get('/index-equivalencias', [ImporterEquivalenciasController::class,'index'])->name('admin.equivalencias.index');  
        Route::get('/index-imports', [ImportersController::class,'index'])->name('admin.importers.index');
        Route::post('/upload-equivalencias', [ImporterEquivalenciasController::class,'upload'])->name('admin.equivalencias.upload');  
        Route::post('/importar-equivalencias', [ImporterEquivalenciasController::class,'importar'])->name('admin.equivalencias.importar');    

  //Importer Rubros
  Route::get('/index-import-rubros', [ ImporterRubrosController::class,'index'])->name('admin.importers.rubros');
  Route::post('/validar-import-rubros', [ ImporterRubrosController::class,'validar'])->name('admin.importers.rubros.validar');
  Route::post('/importar-rubros', [ ImporterRubrosController::class,'importar'])->name('admin.importers.rubros.importar');    
  //Importer Marcas
  Route::get('/index-import-marcas', [ ImporterMarcasController::class,'index'])->name('admin.importers.marcas');
  Route::post('/validar-import-marcas', [ ImporterMarcasController::class,'validar'])->name('admin.importers.marcas.validar');
  Route::post('/importar-marcas', [ImporterMarcasController::class,'importar'])->name('admin.importers.marcas.importar');    
  //Importer Productos
  Route::get('/index-import-productos', [ImporterProductosController::class,'index'])->name('admin.importers.productos');
  Route::post('/validar-import-productos', [ImporterProductosController::class,'validar'])->name('admin.importers.productos.validar');
  Route::post('/importar-productos', [ImporterProductosController::class,'importar'])->name('admin.importers.productos.importar');   
  
    //Menus
    Route::get('/admin/menus/permisos/{menu_id}', [MenuController::class,'permisosEdit']);
    Route::put('/admin/menus/permisosUpdate/{menu_id}',  [MenuController::class,'permisosUpdate']);

    //Usuarios
    Route::get('usuarios/password/{id}', [ClientesController::class,'editContraseña'])->name('admin.clientes.editPass',);
    Route::put('usuarios/password/update/{id}', [ClientesController::class,'updateContraseña'])->name('admin.clientes.updatePass');

    //Proceso
    Route::get('/update-productos', [ProcesosController::class,'updateProductos'])->name('admin.update.productos');
    Route::get('/admin/clientes/habilitar/{id}', [ClientesController::class,'habilitar'])->name('admin.clientes.habilitar');
    
    Route::get('/admin/clientes/inhabilitar/{id}', [ClientesController::class,'inhabilitar'])->name('admin.clientes.inhabilitar');


Route::get('/admin/image-upload', [ImageUploadController::class,'imageUpload'])->name('image.upload');
Route::post('/admin/image-upload', [ImageUploadController::class,'imageUploadPost'])->name('image.upload.post');
Route::post('/admin/pedidos/status', [PedidosController::class,'atender']);
  
Route::get('novedad/{slug}', [FrontController::class,'showNovedad'])->name('front.novedad.show');

Route::get('/admin/downloadContactos', [ContactosController::class,'downloadFile'])->name('admin.contactos.downloadFile');
Route::get('/admin/downloadProductos', [ProductController::class,'downloadFile'])->name('admin.productos.downloadFile');

//Descargas
Route::post('/admin/descargas/reposition', [DescargasController::class,'reposition'])->name('admin.descargas.reposition');
//Novedades
Route::post('/admin/novedades/reposition', [NovedadesController::class,'reposition'])->name('admin.novedades.reposition');


Route::get('/productoDetail/{slug}',[FrontProductosController::class,'productDetailModal']);

Route::get('/getminicart',[FrontController::class,'getMiniCart']);
Route::post('confirmarCarrito',[CartController::class,'confirmarCarrito']);
Route::get('/clearCart',[CartController::class,'trash']);

