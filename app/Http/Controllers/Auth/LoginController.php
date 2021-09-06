<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Traits\Addtocart;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use Addtocart;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
               $carrito=Carrito::where('user_id','=',\Auth::user()->id)->get();        
                 foreach($carrito as $key) {
                    $this->addtocart(Producto::where('id','=',$key->producto_id)->first(),$key->cantidad);             
                }    
            

            return redirect()->intended();
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function logout(){
       try {
        $cart= \Session::get('cart');
       
        foreach($cart as $key){
        
            $carrito= new Carrito();
            $carrito->user_id=\Auth::user()->id;
            $carrito->producto_id=$key->id;
            $carrito->slug=$key->slug;
            $carrito->cantidad=$key->cantidad;
            $carrito->save();

        }

        \Session::forget('cart');
        Auth::logout();
        return redirect('/');

       } catch (\Throwable $th) {
           //throw $th;
       }
       

     
    }

    
}
