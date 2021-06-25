<?php

namespace App\Http\Controllers\Admin;

use App\Models\Marca;
use App\Models\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MarcasController extends Controller
{

    const DESTINATION_PATH = 'img/marcas';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (\Auth::guard('admin')->user()->can(['marcas-ver'])) {
            $marcas = Marca::filterAndPaginate($request->get('nombre'), $request->get('id'));
            return view('admin.marcas.index', compact('marcas'));
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (\Auth::guard('admin')->user()->can(['marcas-crear'])) {
            return view('admin.marcas.create');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (\Auth::guard('admin')->user()->can(['marcas-crear'])) {
            $data = \Request::all();

            $v = $this->validarMarca($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(Request::All());
            }

            $marca = new Marca($data);
            $marca->setAudit('admin');
            $marca->save();

            \Cache::forget('marcas');

            return redirect()->route('admin.marcas.index');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        if (\Auth::guard('admin')->user()->can(['marcas-editar'])) {
            $marca = Marca::findOrFail($id);
            return view('admin.marcas.edit', compact('marca'));
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        if (\Auth::guard('admin')->user()->can(['marcas-editar'])) {
            $data = \Request::all();
            $marca = Marca::findOrFail($id);

            $v = $this->validarMarca($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(Request::All());
            }

            $marca->fill($data);
            $marca->setAudit('admin');
            $marca->save();

            \Cache::forget('marcas');

            return redirect()->route('admin.marcas.index');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (\Auth::guard('admin')->user()->can(['marcas-eliminar'])) {
            $productos = Producto::where('marca_id', $id)->count();
            if ($productos == 0) {
                $marca = Marca::findOrFail($id);
                $marca->delete();
                return response()->json('OK');
            } else {
                return response()->json(['result' => 'ERROR', 'message' => 'Esta Marca no puede eliminarse porque se encuentra asociada al menos a un Productos']);
            }
        } else {
            return view('errors.noTienePermisos');
        }
    }

    private function validarMarca($data)
    {

        $messages = [];

        $rules = array(
            'nombre' => 'required',
        );

        return Validator::make($data, $rules, $messages);
    }

}
