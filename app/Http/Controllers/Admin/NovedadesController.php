<?php

namespace App\Http\Controllers\Admin;

use App\Models\Novedad;
use App\Models\Producto;
use App\Models\Rubro;
use App\Models\Marca;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;

class NovedadesController extends Controller {

    const DESTINATION_PATH = 'img/novedades';

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

       
        if (\Auth::guard('admin')->user()->can(['novedades-ver'])) {
            $novedades = Novedad::orderBy('orden')->paginate(30);
            return view('admin.novedades.index', compact('novedades'));
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
        if (\Auth::guard('admin')->user()->can(['novedades-crear'])) {

            $scripts = array(
                ('/assets/js/jquery.nice-select.min.js'),
                ('/assets/js/jquery.nice-select-with-search-multiple.js'),
              
             );
            $csss=array(
                    ('/assets/css/nice-search-multiple.css'),
                    ('/assets/css/nice-select.min.css')
              
            );



            $codigos=Producto::where('activo','=','1')->pluck('codigo', 'id')->toArray();
            $rubros = Rubro::getRubros()->pluck('nombre', 'id')->toArray();
            $marcas = Marca::getMarcas()->pluck('nombre', 'id')->toArray();
            return view('admin.novedades.create',compact('codigos','rubros','marcas','scripts','csss'));
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
        if (\Auth::guard('admin')->user()->can(['novedades-crear'])) {
            $data = \Request::all();

            $v = $this->validarNovedad($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(Request::All());
            }

            $novedad = new Novedad($data);
            if (Request::file('imagen') != '') {
                $novedad->imagen = $this->saveImage(Request::file('imagen'), Request::input('titulo'), self::DESTINATION_PATH);
            }
            if (Request::has('es_producto')) {
                $novedad->es_producto = 1;
                $novedad->f_url = Request::input('url');
            } else {
                $novedad->es_producto = 0;
                $novedad->f_url = str_slug(Request::input('titulo'), '-');
            }
            if (!Request::has('visible')) {
                $novedad->visible = 0;
            }
            $novedad->setAudit('admin');

            $novedad->save();

            return redirect()->route('admin.novedades.index');
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
        if (\Auth::guard('admin')->user()->can(['novedades-editar'])) {
            $novedad = Novedad::findOrFail($id);
            return view('admin.novedades.edit', compact('novedad'));
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
        if (\Auth::guard('admin')->user()->can(['novedades-editar'])) {
            $data = \Request::all();
            $novedad = Novedad::findOrFail($id);

            if (\Request::file('imagen') == null) {
                $data['imagen'] = $novedad->imagen;
            } else {
                $pathImagen = $this->saveImage(Request::file('imagen'), Request::input('titulo'), self::DESTINATION_PATH);
                $data['imagen'] = $pathImagen;
            }

            $v = $this->validarNovedad($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(Request::All());
            }

            if (Request::has('es_producto')) {
                $novedad->es_producto = 1;
                $novedad->f_url = Request::input('url');
            } else {
                $novedad->es_producto = 0;
                $novedad->f_url = str_slug(Request::input('titulo'), '-');
            }
            $novedad->fill($data);
            if (!Request::has('visible')) {
                $novedad->visible = 0;
            }
            $novedad->setAudit('admin');
            $novedad->save();

            return redirect()->route('admin.novedades.index');
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
                $item = Novedad::findOrFail($id);
                $item->orden = $i;
                $item->save();
            }
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('success' => false));
        }
    }

    private function repositionAll($novedades){
        $i = 0;
        foreach ($novedades as $nov) {
            $i++;
            $novedad = Novedad::findOrFail($nov);
            $novedad->orden = $i;
            $novedad->save();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        if (\Auth::guard('admin')->user()->can(['novedades-eliminar'])) {
            $novedad = Novedad::findOrFail($id);
            $novedad->delete();
            return response()->json('OK');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    private function generateFileName($titulo, $extension) {
        return str_slug($titulo, '-') . '.' . $extension;
    }

    private function saveImage($image, $imageTitle, $destinationPath) {

        $extension = $image->getClientOriginalExtension();
        $fileName = $this->generateFileName($imageTitle, $extension);
        $image->move($destinationPath, $fileName);

        return $destinationPath . '/' . $fileName;
    }

    private function validarNovedad($data) {

        $messages = [];

        $rules = array(
            'titulo' => 'required',
            'url' => 'required_with:es_producto',
        );

        return Validator::make($data, $rules, $messages);
    }

}
