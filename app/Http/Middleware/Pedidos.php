<?php

namespace App\Http\Middleware;
use Closure;

use Illuminate\Support\Facades\DB;

class Pedidos{

    public function handle($request, Closure $next)
{    

$data = DB::table('pedidos')->select('id')->where('status_id', '1')->get();

\Illuminate\Support\Facades\View::share('flagPedidos', sizeof($data));

return $next($request);

}
}