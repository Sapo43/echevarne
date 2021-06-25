<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rubro;
use App\Models\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RubrosController extends Controller {

    const DESTINATION_PATH = 'img/rubros';

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
        if (\Auth::guard('admin')->user()->can(['rubros-ver'])) {
            $rubros = Rubro::filterAndPaginate($request->get('nombre'));
            return view('admin.rubros.index', compact('rubros'));
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
        if (\Auth::guard('admin')->user()->can(['rubros-crear'])) {
            return view('admin.rubros.create');
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
        if (\Auth::guard('admin')->user()->can(['rubros-crear'])) {
            $data = \Request::all();

            $v = $this->validarRubro($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(Request::All());
            }

            $rubro = new Rubro($data);
            $rubro->setAudit('admin');
            $rubro->save();

            \Cache::forget('rubros');

            return redirect()->route('admin.rubros.index');
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
        if (\Auth::guard('admin')->user()->can(['rubros-editar'])) {
            $rubro = Rubro::findOrFail($id);
            return view('admin.rubros.edit', compact('rubro'));
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
        if (\Auth::guard('admin')->user()->can(['rubros-editar'])) {
            $data = \Request::all();
            $rubro = Rubro::findOrFail($id);

            $v = $this->validarRubro($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(Request::All());
            }

            $rubro->fill($data);
            $rubro->setAudit('admin');
            $rubro->save();

            \Cache::forget('rubros');

            return redirect()->route('admin.rubros.index');
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
        if (\Auth::guard('admin')->user()->can(['rubros-eliminar'])) {
            $productos = Producto::where('rubro_id', $id)->count();
            if ($productos == 0) {
                $marca = Rubro::findOrFail($id);
                $marca->delete();
                return response()->json('OK');
            } else {
                return response()->json(['result' => 'ERROR', 'message' => 'Este Rubro no puede eliminarse porque se encuentra asociado al menos a un Productos']);
            }
        } else {
            return view('errors.noTienePermisos');
        }
    }

    private function validarRubro($data) {

        $messages = [];

        $rules = array(
            'nombre' => 'required',
        );

        return Validator::make($data, $rules, $messages);
    }

}
