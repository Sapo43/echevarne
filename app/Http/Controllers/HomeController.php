<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\User;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$qPedidosPendientes = Pedido::getCantidadPedidosEsperando();
        //$qUsersPendientes = User::getCantidadUsuariosEsperando();
        //$message = \DB::table('message')->where('id', 1)->pluck('message'); 
        $result = \DB::table('message')->select('message')->where('id', 1)->first();
        return view('admin.home', compact("result"));
    }

}