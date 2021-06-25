<?php

namespace App\Http\Controllers\Admin;

use Log;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller {

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
    public function index(Request $request) {
        if (\Auth::guard('admin')->user()->can(['permisos-ver'])) {
            $grupos = Permission::selectRaw('DISTINCT(grupo)')->orderBy('grupo')->lists('grupo','grupo')->toArray();
            $permissions = Permission::filterAndPaginate($request->get('grupo'));
            return view('admin.permisos.index', compact('permissions', 'grupos'));
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
        if (\Auth::guard('admin')->user()->can(['permisos-crear'])) {
            return view('admin.permisos.create');
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
        if (\Auth::guard('admin')->user()->can(['permisos-crear'])) {
            $data = \Request::all();
            $permission = new Permission($data);
            $permission->save();

            return redirect()->route('admin.permisos.index');
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
        if (\Auth::guard('admin')->user()->can(['permisos-editar'])) {
            $permission = Permission::findOrFail($id);

            return view('admin.permisos.edit', compact('permission'));
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
        if (\Auth::guard('admin')->user()->can(['permisos-editar'])) {
            $data = \Request::all();
            $permission = Permission::findOrFail($id);
            //$permission->fill($data);
            //No uso fill para evitar que pueda cambiarse el nombre del permiso
            $permission->display_name = $data['display_name'];
            $permission->description = $data['description'];
            $permission->save();

            return redirect()->route('admin.permisos.index');
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
        if (\Auth::guard('admin')->user()->can(['permisos-eliminar'])) {
            // TODO: No Funciona!
            Permission::destroy($id);
            return redirect()->route('admin.permisos.index');
        } else {
            return view('errors.noTienePermisos');
        }
    }

}
