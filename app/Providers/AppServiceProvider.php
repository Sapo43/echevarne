<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //Disponibilidad de variable flagPedidos en todas las vistas del administrador y no pasar por todos los controladores
        //y compactar en la vistas para que este disponible
        $data = DB::table('pedidos')->select('id')->where('status_id', '1')->get();       
\Illuminate\Support\Facades\View::share('flagPedidos', sizeof($data));
    }
}
