<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Admin;
use App\Models\Role;
use App\Models\MenuUsuario;
use App\Models\MenuRol;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        if (\Auth::guard('admin')->user()->can(['menus-ver'])) {

            $menuItems = \DB::select(\DB::raw("select * from menus order by nivel, padre"));
            $menu = array();
            $subMenu = array();

            foreach ($menuItems as $item) {
                if ($item->nivel === 1) {
                    $menu[$item->id] = [$item, $subMenu];
                } else {
                    array_push($menu[$item->padre][1], $item);
                }
            }
            return view('admin.menu.index', compact('menu'));
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     * @return Response
     */
    public function create() {
        if (\Auth::guard('admin')->user()->can('menus-crear')) {
            $menus = Menu::padre(0)->lists('nombre', 'id')->toArray();
            return view('admin.menu.create', compact('menus'));
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        if (\Auth::guard('admin')->user()->can('menus-crear')) {
            $data = \Request::all();

            $v = $this->validarMenu($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(\Request::All());
            }

            $menu = new Menu();
            $menu->fill($data);
            $menu->nivel = $this->getNivel($data['padre']);

            $menu->save();

            return redirect()->route('admin.menus.index');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        if (\Auth::guard('admin')->user()->can('menus-editar')) {
            $menu = Menu::findOrFail($id);
            $menus = Menu::padre(0)->lists('nombre', 'id')->toArray();
            return view('admin.menu.edit', compact('menu', 'menus'));
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Update the User
     * @param type $id
     */
    public function update($id) {
        if (\Auth::guard('admin')->user()->can('menus-editar')) {
            $data = \Request::all();

            $v = $this->validarMenu($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(\Request::All());
            }

            $menu = Menu::findOrFail($id);
            $menu->fill($data);

            $menu->save();

            return redirect()->route('admin.menus.index');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    public function permisosEdit($id) {
        if (\Auth::guard('admin')->user()->can('menus-permisos')) {
            $menu = Menu::findOrFail($id);
            $roles = Role::getRoles()->lists('name', 'id')->toArray();
            $rolesM = MenuRol::menu($id)->lists('rol_id')->toArray();
            $users = Admin::all();
            $usersM = MenuUsuario::menu($id)->lists('user_id')->toArray();
            return view('admin.menu.permisosEdit', compact('menu', 'roles', 'rolesM', 'users', 'usersM'));
        } else {
            return view('errors.noTienePermisos');
        }
    }

    public function permisosUpdate($id) {

        if (\Auth::guard('admin')->user()->can('menus-permisos')) {
            $data = \Request::all();

            MenuRol::menu($id)->delete();
            if (isset($data['rolesM'])) {
                foreach ($data['rolesM'] as $mrol) {
                    $menuRol = new MenuRol();
                    $menuRol->rol_id = $mrol;
                    $menuRol->menu_id = $id;
                    $menuRol->save();
                }
            }

            MenuUsuario::menu($id)->delete();
            if (isset($data['usersM'])) {
                foreach ($data['usersM'] as $urol) {
                    $menuUser = new MenuUsuario();
                    $menuUser->user_id = $urol;
                    $menuUser->menu_id = $id;
                    $menuUser->save();
                }
            }

            return redirect()->back();
        } else {
            return view('errors.noTienePermisos');
        }
    }

    private function getNivel($padre) {
        if (intval($padre) === 0) {
            return 1;
        } else {
            return 2;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        if (\Auth::guard('admin')->user()->can('menus-eliminar')) {
            $menu = Menu::findOrFail($id);
            //Si es un menú padre
            if ($menu->padre === 0) {
                //chequeo que no tenga hijos
                $hijos = Menu::padre($id)->count();
                if ($hijos > 0) {
                    return response()->json(['result' => 'ERROR', 'mensaje' => 'No se puede eliminar un Menú que posee Menús asociados']);
                } else {
                    $this->eliminar($menu);
                }
            } else {
                $this->eliminar($menu);
            }
            return response()->json(['result' => 'OK']);
        } else {
            return response()->json(['result' => 'ERROR', 'mensaje' => 'No tiene Permisos para realizar esta operación. Por favor contacte al Administrador']);
        }
    }

    private function eliminar($menu) {
        $menu->delete();
    }

    private function validarMenu($data) {

        $messages = [
        ];

        $rules = array(
            'nombre' => 'required',
        );

        return Validator::make($data, $rules, $messages);
    }

}
