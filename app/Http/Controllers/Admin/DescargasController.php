<?php

namespace App\Http\Controllers\Admin;

use App\Models\Descarga;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;

class DescargasController extends Controller
{

    const DESTINATION_PATH_IMG = 'img/descargas';
    const DESTINATION_PATH_FILE = 'downloads';

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
    public function index()
    {
        if (\Auth::guard('admin')->user()->can(['descargas-ver'])) {
            $descargas = Descarga::orderBy('orden')->paginate(30);
            return view('admin.descargas.index', compact('descargas'));
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
        if (\Auth::guard('admin')->user()->can(['descargas-crear'])) {
            return view('admin.descargas.create');
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
        if (\Auth::guard('admin')->user()->can(['descargas-crear'])) {
            $data = \Request::all();

            $v = $this->validarDescarga($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(Request::All());
            }

            $descarga = new Descarga($data);
            $descarga->imagen = $this->saveFile(Request::file('imagen'), Request::input('nombre'), self::DESTINATION_PATH_IMG);
            $descarga->archivo = $this->saveFile(Request::file('archivo'), Request::input('nombre'), self::DESTINATION_PATH_FILE);
            if (!Request::has('visible')) {
                $descarga->visible = 0;
            }
            $descarga->setAudit('admin');

            $descarga->save();

            $descargas = Descarga::orderBy('orden')->lists('id')->toArray();
            array_unshift($descargas, $descarga->id);

            $this->repositionAll($descargas);

            return redirect()->route('admin.descargas.index');
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
        if (\Auth::guard('admin')->user()->can(['descargas-editar'])) {
            $descarga = Descarga::findOrFail($id);
            return view('admin.descargas.edit', compact('descarga'));
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
        if (\Auth::guard('admin')->user()->can(['descargas-editar'])) {
            $data = \Request::all();
            $descarga = Descarga::findOrFail($id);

            if (\Request::file('imagen') == null) {
                $data['imagen'] = $descarga->imagen;
            } else {
                $pathImagen = $this->saveFile(Request::file('imagen'), Request::input('nombre'), self::DESTINATION_PATH_IMG);
                $data['imagen'] = $pathImagen;
            }
            if (\Request::file('archivo') == null) {
                $data['archivo'] = $descarga->archivo;
            } else {
                $pathImagen = $this->saveFile(Request::file('archivo'), Request::input('nombre'), self::DESTINATION_PATH_FILE);
                $data['archivo'] = $pathImagen;
            }

            $v = $this->validarDescarga($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(Request::All());
            }

            $descarga->fill($data);
            if (!Request::has('visible')) {
                $descarga->visible = 0;
            }
            $descarga->setAudit('admin');
            $descarga->save();

            return redirect()->route('admin.descargas.index');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    public function reposition()
    {

        if (Request::get('order')) {
            $i = 0;
            foreach (Request::get('order') as $id) {
                $i++;
                $item = Descarga::find($id);
                $item->orden = $i;
                $item->save();
            }
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('success' => false));
        }
    }

    private function repositionAll($descargas){
        $i = 0;
        foreach ($descargas as $des) {
            $i++;
            $descarga = Descarga::findOrFail($des);
            $descarga->orden = $i;
            $descarga->save();
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
        if (\Auth::guard('admin')->user()->can(['descargas-eliminar'])) {
            $descarga = Descarga::findOrFail($id);
            $descarga->delete();
            return response()->json('OK');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    private function generateFileName($titulo, $extension)
    {
        return str_slug($titulo, '-') . '.' . $extension;
    }

    private function saveFile($image, $imageTitle, $destinationPath)
    {

        $extension = $image->getClientOriginalExtension();
        $fileName = $this->generateFileName($imageTitle, $extension);
        $image->move($destinationPath, $fileName);

        return $destinationPath . '/' . $fileName;
    }

    private function validarDescarga($data)
    {

        $messages = [];

        $rules = array(
            'nombre' => 'required',
        );

        return Validator::make($data, $rules, $messages);
    }

}
