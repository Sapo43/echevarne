<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;

class UserController extends Controller {

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
        if (\Auth::guard('admin')->user()->can(['usuarios-ver'])) {
            $users = Admin::paginate(30);
            return view('admin.usuarios.index', compact('users'));
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        if (\Auth::guard('admin')->user()->can(['usuarios-crear'])) {
            $roles = Role::getRoles()->lists('display_name', 'id')->toArray();
            return view('admin.usuarios.create', compact('roles'));
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
        if (\Auth::guard('admin')->user()->can(['usuarios-crear'])) {
            $data = \Request::all();

            $v = $this->validarUsuario($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(Request::All());
            }

            $v2 = $this->validarContraseña($data);

            if ($v2->fails()) {
                return redirect()->back()->withErrors($v2->errors())->withInput(Request::All());
            }

            $user = new Admin($data);
            $user->password = \Hash::make($data['contraseña']);
            $user->setAudit('admin');
            $user->save();

            if ($data['rol'] != 0) {
                $user->attachRole($data['rol']);
            }

            return redirect()->route('admin.usuarios.index');
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
        if (\Auth::guard('admin')->user()->can(['usuarios-editar'])) {
            $user = Admin::findOrFail($id);
            $userRol = $user->roles->first();
            $roles = Role::getRoles()->lists('display_name', 'id')->toArray();
            return view('admin.usuarios.edit', compact('user', 'roles', 'userRol', 'jur'));
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        if (\Auth::guard('admin')->user()->can(['usuarios-editar'])) {
            $data = \Request::all();
            $user = Admin::findOrFail($id);

            //Si le paso Rol = 0 lo ignoro y no cambio el Rol
            if ($data['rol'] != 0) {
                $actualRol = $user->roles()->first()['id'];
                //Si el Rol es igual al actual, no lo modifico
                if ($data['rol'] != $actualRol) {
                    //Si el Rol es distinto, eliminio el Rol Actual y agrego el nuevo
                    $user->detachRole($actualRol);
                    $user->attachRole($data['rol']);
                }
            }

            $user->fill($data);
            $user->setAudit('admin');
            $user->save();

            return redirect()->route('admin.usuarios.index');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        if (\Auth::guard('admin')->user()->can(['usuarios-eliminar'])) {
            $usersQ = Admin::count();
            if ($usersQ > 1) {
                $user = Admin::findOrFail($id);
                $result = $user->delete();
                if ($result) {
                    return response()->json('OK');
                } else {
                    return response()->json(['result' => 'ERROR', 'message' => 'Se produjo un error al intentar eliminar al Usuario']);
                }
            } else {
                return response()->json(['result' => 'ERROR', 'message' => 'No se puede eliminar al ultimo usuario del Sistema']);
            }
        } else {
            return view('errors.noTienePermisos');
        }
    }

    public function editContraseña($id) {
        if (\Auth::guard('admin')->user()->can(['usuarios-cambiarContraseña'])) {
            $user = Admin::findOrFail($id);
            return view('admin.usuarios.changePassword', compact('user'));
        } else {
            return view('errors.noTienePermisos');
        }
    }

    public function updateContraseña($id) {
        if (\Auth::guard('admin')->user()->can(['usuarios-cambiarContraseña'])) {
            $data = \Request::all();
            $v = $this->validarContraseña($data);
            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(Request::All());
            }

            $user = Admin::findOrFail($id);
            $user->password = \Hash::make($data['contraseña']);
            $user->setAudit('admin');
            $user->save();
            return redirect()->route('admin.usuarios.index');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    private function validarUsuario($data) {

        if (isset($data['userId'])) {
            $userId = ',' . $data['userId'];
        } else {
            $userId = '';
        }

        $messages = [
            'username.unique' => 'El nombre de Usuario ya existe en el Sistema',
        ];

        $rules = array(
            'username' => 'required|unique:users,username' . $userId,
        );

        return Validator::make($data, $rules, $messages);
    }

    private function validarContraseña($data) {

        $messages = [
            'contraseña.min' => 'La Contraseña debe tener como minimo 8 caracteres',
            'contraseña.required' => 'El campo Contraseña es obligatorio',
            'contraseña_rep.same' => 'La Contraseñas ingresadas no coinciden',
            'contraseña_rep.required' => 'El campo Repetir Contraseña es obligatorio',
        ];

        $rules = array(
            'contraseña' => 'required|min:8',
            'contraseña_rep' => 'required|same:contraseña',
        );

        return Validator::make($data, $rules, $messages);
    }

}
