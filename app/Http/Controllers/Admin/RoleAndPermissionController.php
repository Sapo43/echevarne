<?php

namespace App\Http\Controllers\Admin;

use Log;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;

class RoleAndPermissionController extends Controller {
    /**
     * TODO:
     * 1- Marcar/Desmarcar Todos en Front
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $role = Role::findOrFail($id);
        $permisos = $this->getPermissionsByGroup(Permission::orderBy('grupo')->get());
        $permisosRol = $role->perms()->get(array('id'));

        return view('admin.permisosRoles.edit', compact('role', 'permisos', 'permisosRol'));
    }

    
    private function getPermissionsByGroup($permisosDB){
        
        $permisos = array();
        $permisosGroup = array();
        $tmpGroup = $permisosDB{0}['grupo'];
        
        foreach ($permisosDB as $permiso) {            
            if($permiso->grupo === $tmpGroup){
                array_push($permisosGroup, $permiso);
            }else{
                $permisos[$tmpGroup] = $permisosGroup;
                $permisosGroup = array();
                $tmpGroup = $permiso->grupo;
                array_push($permisosGroup, $permiso);
            }
        }
        $permisos[$tmpGroup] = $permisosGroup;

        return $permisos;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $data = \Request::all();

        unset($data['_token']);
        unset($data['_method']);

        $role = Role::findOrFail($id);
        $role->perms()->sync($data);

        return redirect()->route('admin.roles.index');
    }

}
