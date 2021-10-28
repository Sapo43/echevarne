<?php

namespace App\Http\Controllers\AdminAuth;

use App\Admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesUsers,
    ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    protected $redirectAfterLogout = '/admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'username' => 'required',
                    'nombre' => 'required|max:255',
                    'apellido' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:admins',
                    'password' => 'required|min:8|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
       
        return Admin::create([
                    'username' => $data['username'],
                    'nombre' => $data['nombre'],
                    'apellido' => $data['apellido'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);
    }

    public function adminLogin() {
        return view('admin.auth.loginAdm');
    }

    public function adminLoginPost(Request $request) {
        
 
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);


        if (auth()->guard('admin')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            $this->saveMenusSession();
            return redirect('admin');
        } else {
            return back()->with('error', 'your username and password are wrong.');
        }
    }

    public function adminLogout() {
        auth()->guard('admin')->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Guardo en la session del Usuario logueado el listado de 
     * Menus disponibles para el uso
     */
    protected function saveMenusSession() {

        \Session::put('menu', $this->getMenusByUserRol());
    }

    /**
     * Obtengo la lista de Menus relacionados al Rol del Usuario logueado
     * @return type
     */
    protected function getMenusByUserRol() {

        //Obtengo el Rol del Usuario Logueado
        $rol_id = \Auth::guard('admin')->user()->roles->first()->id;
        $user_id = \Auth::guard('admin')->user()->id;
        // TODO: Mejorar Query
        //Obtengo los Menus asociados al Rol del Usuario Logeado
        $menuItems = \DB::select(\DB::raw("select * from menus where id in (SELECT menu_id FROM menus_roles WHERE rol_id = " . $rol_id . ") and id not in( SELECT menu_id FROM `menus_disable_by_users` where user_id = " . $user_id . ") order by nivel, padre"));
        
        $menu = array();
        $subMenu = array();

        foreach ($menuItems as $item) {
       
            if ($item->nivel === 1) {
               
                $menu[$item->id] = [$item, $subMenu];
            } else {
                
                array_push($menu[$item->padre][1], $item);
            }
        }
           
        return $menu;
    }

}
