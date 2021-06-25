<?php

namespace App\Http\Controllers\Admin\Importers;

use App\Helpers\CsvHelper;
use App\Helpers\ImportersHelper;
use App\Models\Marca;
use App\Models\Rubro;
use App\Http\Controllers\Controller;

class ImporterProductosController extends Controller {

    CONST DESTINATION_PATH_PRODUCTOS = "productos";
    CONST PREFIX_PRODUCTOS = "PRODUCTOS";
    CONST VALIDACION_OK = "OK";
    CONST VALIDACION_ERROR = "ERROR";
    CONST VALIDACION_ERROR_FATAL = "ERROR_FATAL";
    CONST VALIDACION_WARNING = "WARNING";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CsvHelper $csvHelper) {
        $this->csvHelper = $csvHelper;
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('admin.importers.productos.index');
    }

    /**
     * Valido el archivo de Productos que se quiere importar
     * @return type
     */
    public function validar() {
        $data = \Request::all();

        $file = $data['archivo'];
        $filename = ImportersHelper::generateFileName(self::PREFIX_PRODUCTOS, $file->getClientOriginalExtension());
        $csvFile = ImportersHelper::saveFile($file, $filename, self::DESTINATION_PATH_PRODUCTOS . '/');

        $rows = array();
        if ($file->getClientOriginalExtension() == 'csv') {
            $rows = $this->csvHelper->csv_to_array($csvFile);
        } else {
            $rows = \Excel::load($csvFile, function($reader) {
                        $reader->noHeading();
                    })->get()[0]->toArray();
        }

        $marcas = Marca::lists('nombre', 'id')->toArray();
        $rubros = Rubro::lists('nombre', 'id')->toArray();

        $rowsOk = array();
        $rowsError = array();
        $i = 1;

        foreach ($rows as $row) {

            $vRow = $this->validarProducto($row, $rowsError, $marcas, $rubros, $i);
            switch ($vRow) {
                case self::VALIDACION_OK:
                    array_push($rowsOk, $row[0]);
                    break;
                case self::VALIDACION_ERROR_FATAL:
                    break 2;
            }
            $i++;
        }

        return view('admin.importers.productos.validacionResult', compact('rowsOk', 'rowsError', 'filename'));
    }

    /**
     * Importo el archivo de Productos
     */
    public function importar() {
   
        $data = \Request::all();

        $filename = $data['archivo'];
        $csvFile = storage_path('csv/' . self::DESTINATION_PATH_PRODUCTOS . '/' . $filename);
        // $csvFile = storage_path('csv/' . self::DESTINATION_PATH_PRODUCTOS . '/productos.csv' );
      
        $rows = array();
        if (ImportersHelper::getExtensionFile($csvFile) == 'csv') {
            
           $rows= $this->csvHelper->csv_to_array($csvFile);
            
        } else {
            $rows = \Excel::load($csvFile, function($reader) {
                        $reader->noHeading();
                    }, false, true)->get()[0]->toArray();
        }

        $marcas = Marca::lists('nombre', 'id')->toArray();
        $rubros = Rubro::lists('nombre', 'id')->toArray();

        $rowsError = array();
        $i = 1;
        $table_keys = ['codigo', 'nombre', 'cod_barra', 'precio', 'iva', 'rubro_id', 'univen', 'cod_origen', 'marca_id', 'activo', 'actualizado', 'stock', 'stock_minimo'];

        $productosOk = array();
     
        foreach ($rows as $row) {
            
            $vRow = $this->validarProducto($row, $rowsError, $marcas, $rubros, $i);
         
            $values = array();
     
            switch ($vRow) {
                case self::VALIDACION_OK:
                    //Codigo
                    array_push($values, $row[0]);
                    //Nombre
                    array_push($values, $row[1]);
                    //Cod Barra
                    array_push($values, $row[2]);
                    //Precio
                    array_push($values, $row[3]);
                    //IVA
                    array_push($values, $row[4]);
                    //Rubro ID
                    array_push($values, $row[5]);
                    //Univ
                    array_push($values, $row[6]);
                    //Cod Origen
                    array_push($values, $row[7]);
                    //Marca ID
                    array_push($values, $row[8]);
                    //Activo
                    array_push($values, $row[9]);
                    //Actualizado
                    array_push($values, $row[12]);
                    //Stock
                    array_push($values, $row[13]);
                    //Stock Minimo                    
                    array_push($values, $row[14]);
                    $producto = array_combine($table_keys, array_values($values));
                    array_push($productosOk, $producto);
                    break;
                case self::VALIDACION_ERROR_FATAL:
                    break 2;
            }
            $i++;
        }

        if (count($productosOk) > 1000) {
            $m_rowsOk = array_chunk($productosOk, 1000, true);
            foreach ($m_rowsOk as $m_row) {
                
                \DB::table('productos')->insert($m_row);
            }
        } else {
            \DB::table('productos')->insert($productosOk);
        }

        return view('admin.importers.productos.importResult', compact('productosOk', 'rowsError', 'filename'));
    }

    /**
     * Valido los campos del Archivo
     * @param type $row
     * @param type $rowsError
     */
    private function validarProducto($row, &$rowsError, $marcas, $rubros, $i) {

        $v = self::VALIDACION_OK;
        $keys = ['codigo', 'nombre', 'cod_barra', 'precio', 'iva', 'rubro_id', 'univen', 'cod_origen', 'marca_id', 'activo', 'detmarca', 'detrubro', 'actualizado', 'stock', 'stock_minimo'];
        //Valido cantidad de Campos
        if (count($row) != count($keys)) {
            array_push($rowsError, 'La cantidad de campos en la fila numero: ' . $i . ' es diferente a la esperada. Corrija el archivo y vuelva a validarlo.');
            $v = self::VALIDACION_ERROR_FATAL;
        } else {
            //Valido el codigo del Producto
            if (strlen(trim($row[0])) == 0) {
            
                array_push($rowsError, 'El id de la fila número: ' . $i . ' no puede ser vacío.');
                $v = self::VALIDACION_ERROR;
            }
            //Valido el nombre del Producto
            if (strlen(trim($row[1])) == 0) {
             
                array_push($rowsError, 'El Nombre del Producto de la fila número: ' . $i . ' no puede ser vacío.');
                $v = self::VALIDACION_ERROR;
            }
            //Valido que el precio sea un valor numerico
            if (!is_numeric(trim($row[3]))) {
       
                array_push($rowsError, 'El Precio del Producto de la fila número: ' . $i . ' debe ser numerico.');
                $v = self::VALIDACION_ERROR;
            }
            //valido que el Rubro exista en la base
            if (trim($row[5]) != 0) {
                if (!array_key_exists($row[5], $rubros)) {

                    $this->insertarRubro($row[5], $row[11]);
                    $rubros[$row[5]] = $row[11];
                
                    array_push($rowsError, 'El codigo (' . $row[5] . ') de Rubro del Producto de la fila número: ' . $i . ' no existe en la base.');
                    $v = self::VALIDACION_ERROR;
                }
            }
            //valido que la Marca exista en la base
            if (!array_key_exists($row[8], $marcas)) {

                $this->insertarMarca($row[8], $row[10]);
                $marcas[$row[8]] = $row[10];
                array_push($rowsError, 'El codigo (' . $row[8] . ') de Marca del Producto de la fila número: ' . $i . ' no existe en la base.');
                $v = self::VALIDACION_ERROR;
            }
            //El resto de los campos no son Obligatorios
        }

        return $v;
    }


    private function insertarRubro($rubro_id, $rubro_nombre){
        $rubro = new Rubro();
        $rubro->id = $rubro_id;
        $rubro->nombre = $rubro_nombre;
        $rubro->setAudit('admin');
        $rubro->save();
    }

    private function insertarMarca($marca_id, $marca_nombre){
        $marca = new Marca();
        $marca->id = $marca_id;
        $marca->nombre = $marca_nombre;
        $marca->setAudit('admin');
        $marca->save();
    }
}
