<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller {
    /**
     * TODO : 
     * 1- Permisos para acciones
     * 
     */

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
        if (\Auth::guard('admin')->user()->can(['roles-ver'])) {
            $roles = Role::all();
            return view('admin.roles.index', compact('roles'));
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
        if (\Auth::guard('admin')->user()->can(['roles-crear'])) {
            return view('admin.roles.create');
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
        if (\Auth::guard('admin')->user()->can(['roles-crear'])) {
            $data = \Request::all();
            $role = new Role($data);
            $role->save();
            $this->clearCache();

            return redirect()->route('admin.roles.index');
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
        if (\Auth::guard('admin')->user()->can(['roles-editar'])) {
            $role = Role::findOrFail($id);

            return view('admin.roles.edit', compact('role'));
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
        if (\Auth::guard('admin')->user()->can(['roles-editar'])) {
            $data = \Request::all();
            $role = Role::findOrFail($id);
            //$role->fill($data);
            //No uso fill para evitar que pueda cambiarse el nombre del Rol
            $role->display_name = $data['display_name'];
            $role->description = $data['description'];
            $role->save();

            $this->clearCache();

            return redirect()->route('admin.roles.index');
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
        if (\Auth::guard('admin')->user()->can(['roles-eliminar'])) {
            Role::destroy($id);
            $this->clearCache();

            return redirect()->route('admin.roles.index');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    public function clearCache() {
        \Cache::forget('roles');
    }

}
