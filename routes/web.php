<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\ProductosController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuth\AuthController;


// Route::get(
//     '/user/profile',
//     [UserProfileController::class, 'show']
// )->name('profile');



Route::get('/', [FrontController::class,'home'])->name('home');
Route::get('/shop', [FrontController::class,'shop'])->name('shop');
Route::get('/producto/{slug}', [ProductosController::class,'show'])->name('show');
Route::get('/shop/fetch_data', [FrontController::class,'shop'])->name('shop');
Route::get('/cart',[CartController::class,'cartForCheckout'])->name('cart');
Route::get('/logout',[LoginController::class,'logout']);


Route::bind('producto',function($slug){
    return App\Models\Producto::where ('slug', $slug)->first();
});



Route::get('/cart/add/{producto}',[CartController::class,'add'])->name('addToCart');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/checkout', [CheckoutController::class,'index'])->middleware('auth');
Route::post('/checkout/confirmar', [CartController::class,'confirm'])->middleware('auth');




/* * ------ Administrador----------* */
Route::get('/admin', [HomeController::class,'index']);

Route::get('/admin/login', [AuthController::class,'adminLogin'])->name('auth.admin.login');
Route::post('/admin/login', [AuthController::class,'adminLoginPost'])->name('auth.admin.login');
Route::get('/admin/logout', [AuthController::class,'adminLogout'])->name('auth.admin.logout');


Route::prefix('admin')->namespace('Admin')->group(static function() {

    Route::middleware('auth:admin')->name('admin.')->group(static function () {
        //...
        Route::resource('novedades', '\App\Http\Controllers\Admin\NovedadesController');
        Route::resource('usuarios', '\App\Http\Controllers\Admin\UserController');
        Route::resource('roles', '\App\Http\Controllers\Admin\RoleController');
        Route::resource('permisos', '\App\Http\Controllers\Admin\PermissionController');
        Route::resource('permisosRoles', '\App\Http\Controllers\Admin\RoleAndPermissionController');
        Route::resource('menus', '\App\Http\Controllers\Admin\MenuController');
        Route::resource('novedades', '\App\Http\Controllers\Admin\NovedadesController');
        Route::resource('descargas', '\App\Http\Controllers\Admin\DescargasController');
        Route::resource('productos', '\App\Http\Controllers\Admin\ProductosController');
        Route::resource('rubros', '\App\Http\Controllers\Admin\RubrosController');
        Route::resource('marcas', '\App\Http\Controllers\Admin\MarcasController');
        Route::resource('contactos', '\App\Http\Controllers\Admin\ContactosController');
        Route::resource('clientes', '\App\Http\Controllers\Admin\ClientesController');
        Route::resource('conocenos', '\App\Http\Controllers\Admin\ConocenosController');
        Route::resource('pedidos','\App\Http\Controllers\Admin\PedidosController');
    });
});


Route::get('/index-equivalencias', [ImporterEquivalenciasController::class,'index'])->name('admin.equivalencias.index');  
Route::get('/index-imports', [ImportersController::class,'index'])->name('admin.importers.index');


Route::get('/admin/image-upload', [ImageUploadController::class,'imageUpload'])->name('image.upload');
Route::post('/admin/image-upload', [ImageUploadController::class,'imageUploadPost'])->name('image.upload.post');