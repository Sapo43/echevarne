<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/pusher','PusherController@pusher');
Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "Event has been sent!";
});

Route::get('/importarlo', 'Admin\Importers\ImporterProductosController@importar');

Route::get('/', ['as' => 'home', 'uses' => 'Front\FrontController@home']);
Route::get('empresa', ['as' => 'empresa', 'uses' => 'Front\FrontController@empresa']);
Route::get('servicios', ['as' => 'servicios', 'uses' => 'Front\FrontController@servicios']);
Route::get('novedad/{slug}', ['as' => 'front.novedad.show', 'uses' => 'Front\FrontController@showNovedad']);
Route::get('descargas', ['as' => 'descargas', 'uses' => 'Front\FrontController@descargas']);
Route::get('contacto', ['as' => 'contacto', 'uses' => 'Front\ContactoController@index']);
Route::post('enviar', ['as' => 'enviar', 'uses' => 'Front\ContactoController@enviar']);
Route::get('producto/{slug}', ['as' => 'front.productos.show', 'uses' => 'Front\ProductosController@show']);
Route::get('productos', ['as' => 'front.productos.index', 'uses' => 'Front\ProductosController@index']);
Route::get('productos_slug', ['as' => 'front.productos.slug', 'uses' => 'Front\ProductosController@slug']);

Route::resource('miCuenta', 'Front\MiCuentaController');
Route::get('/mi-cuenta/cambiar-password/{userId}', ['as' => 'miCuenta.edit.password', 'uses' => 'Front\MiCuentaController@changePassword']);
Route::put('/mi-cuenta/update-password/{userId}', ['as' => 'miCuenta.update.password', 'uses' => 'Front\MiCuentaController@updatePassword']);
Route::get('/mi-cuenta/cambiar-pass/{userId}', ['as' => 'miCuenta.edit.pass', 'uses' => 'Front\MiCuentaController@changePassword2']);
Route::put('/mi-cuenta/update-pass/{userId}', ['as' => 'miCuenta.update.pass', 'uses' => 'Front\MiCuentaController@updatePassword2']);
Route::get('miCuenta/{id}/edited', ['as' => 'miCuenta.editdos', 'uses' => 'Front\MiCuentaController@editdos']);

Route::get('file/{folder}/{filename}', 'FileController@getFile')->where('filename', '^[^/]+$');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@webLogin']);
Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@webLoginPost']);
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'CartController@logoff']);

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
});
//Clear Session
Route::get('/clear-session', 'Admin\ClearSessionController@index');

/* * ------ Administrador----------* */
Route::get('admin', 'HomeController@index');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth:admin'], function() {
    Route::resource('usuarios', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permisos', 'PermissionController');
    Route::resource('permisosRoles', 'RoleAndPermissionController');
    Route::resource('menus', 'MenuController');
    Route::resource('novedades', 'NovedadesController');
    Route::resource('descargas', 'DescargasController');
    Route::resource('productos', 'ProductosController');
    Route::resource('rubros', 'RubrosController');
    Route::resource('marcas', 'MarcasController');
    Route::resource('contactos', 'ContactosController');
    Route::resource('clientes', 'ClientesController');
    Route::resource('conocenos', 'ConocenosController');
    Route::resource('pedidos','PedidosController');

    //Importers
    Route::get('/index-imports', ['as' => 'admin.importers.index', 'uses' => 'Importers\ImportersController@index']);  
    Route::get('/index-equivalencias', ['as' => 'admin.equivalencias.index', 'uses' => 'Importers\ImporterEquivalenciasController@index']);  
    Route::post('/upload-equivalencias', ['as' => 'admin.equivalencias.upload', 'uses' => 'Importers\ImporterEquivalenciasController@upload']);  
    
    Route::post('/importar-equivalencias', ['as' => 'admin.equivalencias.importar', 'uses' => 'Importers\ImporterEquivalenciasController@importar']);    
    //Importer Rubros
    Route::get('/index-import-rubros', ['as' => 'admin.importers.rubros', 'uses' => 'Importers\ImporterRubrosController@index']);
    Route::post('/validar-import-rubros', ['as' => 'admin.importers.rubros.validar', 'uses' => 'Importers\ImporterRubrosController@validar']);
    Route::post('/importar-rubros', ['as' => 'admin.importers.rubros.importar', 'uses' => 'Importers\ImporterRubrosController@importar']);    
    //Importer Marcas
    Route::get('/index-import-marcas', ['as' => 'admin.importers.marcas', 'uses' => 'Importers\ImporterMarcasController@index']);
    Route::post('/validar-import-marcas', ['as' => 'admin.importers.marcas.validar', 'uses' => 'Importers\ImporterMarcasController@validar']);
    Route::post('/importar-marcas', ['as' => 'admin.importers.marcas.importar', 'uses' => 'Importers\ImporterMarcasController@importar']);    
    //Importer Productos
    Route::get('/index-import-productos', ['as' => 'admin.importers.productos', 'uses' => 'Importers\ImporterProductosController@index']);
    Route::post('/validar-import-productos', ['as' => 'admin.importers.productos.validar', 'uses' => 'Importers\ImporterProductosController@validar']);
    Route::post('/importar-productos', ['as' => 'admin.importers.productos.importar', 'uses' => 'Importers\ImporterProductosController@importar']);   
    
    

    //Menus
    Route::get('/admin/menus/permisos/{menu_id}', 'MenuController@permisosEdit');
    Route::put('/admin/menus/permisosUpdate/{menu_id}', 'MenuController@permisosUpdate');
    
    Route::get('/admin/downloadContactos', ['as' => 'admin.contactos.downloadFile', 'uses' => 'ContactosController@downloadFile']);
    Route::get('/admin/downloadProductos', ['as' => 'admin.productos.downloadFile', 'uses' => 'ProductosController@downloadFile']);

    //Descargas
    Route::post('/admin/descargas/reposition', ['as' => 'admin.descargas.reposition', 'uses' => 'DescargasController@reposition']);
    //Novedades
    Route::post('/admin/novedades/reposition', ['as' => 'admin.novedades.reposition', 'uses' => 'NovedadesController@reposition']);

    //Usuarios
    Route::get('usuarios/password/{id}', ['as' => 'admin.clientes.editPass', 'uses' => 'ClientesController@editContraseña']);
    Route::put('usuarios/password/update/{id}', ['as' => 'admin.clientes.updatePass', 'uses' => 'ClientesController@updateContraseña']);

    //Proceso
    Route::get('/update-productos', ['as' => 'admin.update.productos', 'uses' => 'ProcesosController@updateProductos']);
    //Pedidos
    Route::get('/pedidos/detalle/{id}',
                ['as'=>'admin.pedidos.detalle',
                'uses'=>'PedidosController@detalle']  
                
                            
);
Route::post('/pedidos/status', 'PedidosController@atender');
});

Route::get('/admin/image-upload', 'Admin\ImageUploadController@imageUpload')->name('image.upload');
Route::post('/admin/image-upload', 'Admin\ImageUploadController@imageUploadPost')->name('image.upload.post');

//Usuarios
Route::get('usuarios/password/{id}', 'Admin\UserController@editContraseña');
Route::put('usuarios/password/update/{id}', 'Admin\UserController@updateContraseña');

Route::get('/admin/login', ['as' => 'auth.admin.login', 'uses' => 'AdminAuth\AuthController@adminLogin']);
Route::post('/admin/login', ['as' => 'auth.admin.login', 'uses' => 'AdminAuth\AuthController@adminLoginPost']);
Route::get('/admin/logout', ['as' => 'auth.admin.logout', 'uses' => 'AdminAuth\AuthController@adminLogout']);

//Files
Route::get('file/{folder}/{filename}', 'FileController@getFile')->where('filename', '^[^/]+$');
Route::get('descargarBase/{filename}', 'FileController@getBase')->where('filename', '^[^/]+$');

Route::get('/admin/clientes/habilitar/{id}', ['as' => 'admin.clientes.habilitar', 'uses' => 'Admin\ClientesController@habilitar']);
Route::get('/admin/clientes/inhabilitar/{id}', ['as' => 'admin.clientes.inhabilitar', 'uses' => 'Admin\ClientesController@inhabilitar']);


//Cart
Route::bind('producto',function($slug){
    return App\Models\Producto::where ('slug', $slug)->first();
});

Route::get('cart/show',[
    'as'=> 'cart-show',
    'uses'=>'CartController@show'
]);

Route::get('cart/add/{producto}',[
    'as'=> 'cart-add',
    'uses'=>'CartController@add'
]);

Route::get('cart/delete/{producto}',[
    'as'=> 'cart-delete',
    'uses'=>'CartController@delete'
]);

Route::get('cart/trash/',[
    'as'=> 'cart-trash',
    'uses'=>'CartController@trash'
]);

Route::post('cart/confirm/',[
    'as'=> 'cart-confirm',
    'uses'=>'CartController@confirm'
]);

Route::get('cart/update/{producto}/{cantidad?}',[
    'as'=> 'cart-update',
    'uses'=>'CartController@update'
]);

Route::get('/clear',[
    'as'=> 'clear',
    'uses'=>'CartController@clear'
]);  

Route::resource('misCarritos', 'Front\MiCarritoController');
Route::get('/miCarrito/detalle/{id}',
['as'=>'front.miCarrito.detalle',
'uses'=>'Front\MiCarritoController@detalle']                
);

Route::get('productoDetalle/{slug}', ['as' => 'front.cart.showproduct', 'uses' => 'CartController@showDetalle']);

Route::get('/clientes',['as'=>'front.accesoCLientes','uses'=>'CartController@accesoClientes'])->middleware('auth');
Route::post('/downloadPdf',['as' => 'front.accesoCLientes.downloadpdf', 'uses' => 'Front\ProductosController@downloadpdf'])->middleware('auth');
