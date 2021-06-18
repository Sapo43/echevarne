<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\ProductosController;
use App\Http\Controllers\Front\CartController;


// Route::get(
//     '/user/profile',
//     [UserProfileController::class, 'show']
// )->name('profile');



Route::get('/', [FrontController::class,'home'])->name('home');
Route::get('/shop', [FrontController::class,'shop'])->name('shop');
Route::get('/producto/{slug}', [ProductosController::class,'show'])->name('show');
Route::get('/shop/fetch_data', [FrontController::class,'shop'])->name('shop');
Route::get('/cart',[CartController::class,'cartForCheckout'])->name('cart');



Route::bind('producto',function($slug){
    return App\Models\Producto::where ('slug', $slug)->first();
});



Route::get('/cart/add/{producto}',[CartController::class,'add'])->name('addToCart');




