<?php

namespace App\Http\Controllers\Admin;

use App\Models\Producto;
use App\Models\Rubro;
use App\Models\Marca;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductosController extends Controller {

    const DESTINATION_PATH = '/productos';

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
        if (\Auth::guard('admin')->user()->can(['productos-ver'])) {
            $rubros = Rubro::getRubros()->lists('nombre', 'id')->toArray();
            $marcas = Marca::getMarcas()->lists('nombre', 'id')->toArray();
            $productos = Producto::filterAndPaginate($request->get('nombre'), $request->get('rubro'), $request->get('marca'), $request->get('codigo'), $request->get('activo'));
            $productos=$productos->paginate(24);
            return view('admin.productos.index', compact('productos', 'rubros', 'marcas'));
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
        if (\Auth::guard('admin')->user()->can(['productos-crear'])) {
            $rubros = Rubro::getRubros()->lists('nombre', 'id')->toArray();
            $marcas = Marca::getMarcas()->lists('nombre', 'id')->toArray();
            return view('admin.productos.create', compact('rubros', 'marcas'));
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
        if (\Auth::guard('admin')->user()->can(['productos-crear'])) {
            $data = \Request::all();

            $v = $this->validarProducto($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors());
            }

            $producto = new Producto($data);

            if (isset($data['imagen']) || $data['imagen'] != '') {
                $producto->imagen = $this->saveImage($data['imagen'], $data['codigo'], self::DESTINATION_PATH);
            }else{
                $producto->imagen = '';
            }

            $producto->setAudit('admin');

            $producto->activo = $this->checkCheckboxValue('activo');
            $producto->save();
            $producto->slug = $producto->id . '-' . str_slug($producto->nombre);
            $producto->save();

            return redirect()->route('admin.productos.index');
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
        if (\Auth::guard('admin')->user()->can(['productos-editar'])) {
            $producto = Producto::findOrFail($id);
            $rubros = Rubro::getRubros()->lists('nombre', 'id')->toArray();
            $marcas = Marca::getMarcas()->lists('nombre', 'id')->toArray();
            return view('admin.productos.edit', compact('producto', 'rubros', 'marcas'));
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
        if (\Auth::guard('admin')->user()->can(['productos-editar'])) {
            $data = \Illuminate\Support\Facades\Request::all();

            $producto = Producto::findOrFail($id);

            if (!isset($data['imagen']) || is_null($data['imagen']) || $data['imagen'] == '') {
                $pathImagen = $producto->imagen;
            } else {
                $pathImagen = $this->saveImage($data['imagen'], $data['codigo'], self::DESTINATION_PATH);
            }

            $v = $this->validarProducto($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(\Illuminate\Support\Facades\Request::All());
            }

            $producto->fill($data);
            $producto->imagen = $pathImagen;

            $producto->activo = $this->checkCheckboxValue('activo');
            $producto->slug = $producto->id . '-' . str_slug($producto->codigo);

            $producto->setAudit('admin');
            $producto->save();

            return redirect()->route('admin.productos.index');
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
        if (\Auth::guard('admin')->user()->can(['productos-eliminar'])) {
            $producto = Producto::findOrFail($id);
            $producto->delete();
            return response()->json('OK');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    public function downloadFile() {
        $filename = "Listado de Productos";
        $this->descargarArchivo($filename);
    }

    private function descargarArchivo($filename) {

        \Excel::create($filename, function($excel) use($filename) {
            $productos = Producto::select('codigo', 'nombre', 'rubro_id', 'marca_id', 'precio', 'iva', 'stock', 'actualizado')->get();
            $registros = $this->createRegistros($productos);

            $excel->setTitle($filename);
            $excel->sheet('Listado de Productos', function($sheet) use($registros) {
                $sheet->fromArray($registros, null, 'A1', false, false);
                $sheet->setBorder('A1:H' . count($registros), 'thin');
                $sheet->setBorder('A1:H1', 'medium');
                $sheet->row(1, function($row) {
                    $row->setBackground('#8DB4E2');
                });
                $sheet->setColumnFormat(array(
                    'H' => 'dd/mm/yy h:mm',
                ));
                $sheet->setAutoFilter();
            });
        })->download('xlsx');
    }

    private function createRegistros($productos) {

        $rubros = Rubro::getRubros()->lists('nombre', 'id')->toArray();
        $marcas = Marca::getMarcas()->lists('nombre', 'id')->toArray();
        $encabezado = ['Codigo', 'Nombre', 'Rubro', 'Marca', 'Precio', 'I.V.A.', 'Stock', 'Actualizado'];
        $registros = [];

        foreach ($productos as $producto) {
            array_push($registros, $this->createRow($producto, $rubros, $marcas));
        }
        array_unshift($registros, $encabezado);

        return $registros;
    }

    private function createRow($producto, $rubros, $marcas) {
        $row = [];

        if (array_key_exists($producto->rubro_id, $rubros)) {
            $rubro = $rubros[$producto->rubro_id];
        } else {
            $rubro = '';
        }

        if (array_key_exists($producto->marca_id, $marcas)) {
            $marca = $marcas[$producto->marca_id];
        } else {
            $marca = '';
        }

        array_push($row, $producto->codigo, $producto->nombre, $rubro, $marca, $producto->precio, $producto->iva, $producto->stock, $producto->actualizado);
        return $row;
    }

    private function saveImage($image, $imageTitle, $destinationPath) {

        $extension = $image->getClientOriginalExtension();
        $fileName = $this->generateFileName($imageTitle, $extension);
        $image->move('img' . $destinationPath, $fileName);

        return $fileName;
    }

    private function generateFileName($codigo, $extension) {
        return str_slug($codigo) . '.' . $extension;
    }

    private function validarProducto($data) {

        if (isset($data['id'])) {
            $productoId = ',' . $data['id'];
        } else {
            $productoId = '';
        }

        $messages = [
            'codigo.unique' => 'El Codigo del Producto ya existe en la Base de Datos',
            'codigo.regex' => 'El Codigo del Producto no es valido. Utilice un formato correcto: XXXX/XXXX o XXXXXXXX',
            'id_categoria.not_in' => 'La Categoria seleccionada no es valida',
        ];

        $rules = array(
            'codigo' => 'required|unique:productos,codigo' . $productoId,
            'nombre' => 'required',
            'rubro_id' => 'required|not_in:0',
            'marca_id' => 'required|not_in:0',
        );

        return Validator::make($data, $rules, $messages);
    }

    private function checkCheckboxValue($field) {
        if (\Request::has($field)) {
            return 1;
        } else {
            return 0;
        }
    }

}
