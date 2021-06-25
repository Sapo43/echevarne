<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CsvHelper;
use Log;
use App\Models\Marca;
use App\Models\Rubro;
use App\Models\Producto;
use App\Http\Controllers\Controller;

class ProcesosController extends Controller
{

    CONST DESTINATION_PATH_FILE = "repo";
    CONST VALIDACION_OK = "OK";
    CONST VALIDACION_ERROR = "ERROR";
    CONST VALIDACION_ERROR_FATAL = "ERROR_FATAL";
    CONST VALIDACION_WARNING = "WARNING";
    CONST TOTAL_COLS = 15;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CsvHelper $csvHelper)
    {
        $this->csvHelper = $csvHelper;
    }

    //TODO eliminar los redirects para cuando esto corra con un Cron

    public function updateProductos()
    {
        $start = \Carbon\Carbon::now();

        Log::info("###################################################################");
        Log::info("Comienza Proceso de actualización de Productos.");

        //Busco el archivo en la ruta.
        $filename = "productos.csv";
        $csvFile = storage_path('csv/' . self::DESTINATION_PATH_FILE . '/' . $filename);

        if (!file_exists($csvFile) || !is_readable($csvFile)) {

            Log::info("Finaliza Proceso de actualización de Productos");
            Log::info("     - No se encontro el archivo necesario (productos.csv) para la actualización de Productos en el directorio /storage/csv/repo");
            Log::info("###################################################################" . "\n");

        } else {


            $rows = $this->csvHelper->csv_to_array($csvFile);

            try {
                $this->csvHelper->renameFile(storage_path('csv/' . self::DESTINATION_PATH_FILE . '/'), $filename);
            } catch (Exception $ex) {
                Log::info("Finaliza Proceso de actualización de Productos");
                Log::info("     - Se produjo un Error al Intentar renombrar el Archivo.");
                Log::info($ex);
                Log::info("###################################################################" . "\n");
            }

            Log::info("     - Se genera la tabla de RollBack de Productos");
            $this->createRollBackTable();

            $qRegistros = count($rows);
            Log::info("     - El Archivo a procesar posee " . $qRegistros . " registros.");

            $marcas = Marca::lists('nombre', 'id')->toArray();
            $rubros = Rubro::lists('nombre', 'id')->toArray();

            $i = 1;
            $table_keys = ['codigo', 'nombre', 'precio', 'iva', 'rubro_id', 'marca_id', 'activo', 'actualizado', 'stock', 'created_by', 'created_at'];

            $productosOk = array();
            $qActualizados = 0;
            $errores = array();

            if ($rows) {
                foreach ($rows as $row) {

                    if(count($row) != self::TOTAL_COLS ){

                        Log::info("Finaliza Proceso de actualización de Productos");
                        Log::info("     - La fila Nro: ".$i." del archivo no posee todas las columnas necesarias para el Proceso");
                        Log::info("###################################################################" . "\n");

                        return null;

                    }

                    $producto = Producto::where('codigo', trim($row[0]))->first();
                    if (is_null($producto)) {
                        //Si no encuentro el codigo es porque es un producto nuevo
                        $vRow = $this->validarProducto($row, $marcas, $rubros, $i, $errores);
                        $values = array();

                        switch ($vRow) {
                            case self::VALIDACION_OK:
                                try {

                                    //Codigo
                                    array_push($values, trim($row[0]));
                                    //Nombre
                                    array_push($values, trim($row[1]));
                                    //Precio
                                    array_push($values, $this->getPrecio(trim($row[3])));
                                    //IVA
                                    array_push($values, $this->getIva($row[4]));
                                    //Rubro Id
                                    array_push($values, trim($row[5]));
                                    //Marca Id
                                    array_push($values, trim($row[8]));
                                    //Activo
                                    array_push($values, $this->isProductoActivo(trim($row[9])));
                                    //Actualizado
                                    array_push($values, $this->getFechaActualizacion($row[12]));
                                    //Stock
                                    array_push($values, trim($row[13]));
                                    //Created by
                                    array_push($values, 99);
                                    //Created At
                                    array_push($values, \Carbon\Carbon::now());

                                    $productoNew = array_combine($table_keys, array_values($values));
                                    array_push($productosOk, $productoNew);

                                } catch (Exception $ex) {

                                    Log::info("Finaliza Proceso de actualización de Productos");
                                    Log::info("     - Se produjo un Error al Intentar agregar un nuevo Producto.");
                                    Log::info($ex);

                                }
                                break;
                            case self::VALIDACION_ERROR_FATAL:
                                break 2;
                        }

                    } else {

                        try {

                            $producto->nombre = trim($row[1]);
                            $producto->precio = $this->getPrecio(trim($row[3]));
                            $producto->iva = $this->getIva($row[4]);
                            $producto->rubro_id = trim($row[5]);
                            $producto->marca_id = trim($row[8]);
                            $producto->activo = $this->isProductoActivo(trim($row[9]));
                            $producto->actualizado = $this->getFechaActualizacion($row[12]);
                            $producto->stock = trim($row[13]);
                            $producto->updated_by = 99;
                            $producto->updated_at = \Carbon\Carbon::now();
                            $producto->slug = $producto->id . '-' . str_slug($producto->nombre);
                            $producto->save();
                            $qActualizados++;

                        } catch (Exception $ex) {

                            Log::info("Finaliza Proceso de actualización de Productos");
                            Log::info("     - Se produjo un Error al Intentar modificar un Producto.");
                            Log::info($ex);

                        }

                    }
                    $i++;
                    if($i%1000==0){
                        Log::info("     - Se procesaron: ".$i." registros");
                    }
                }

                if (count($productosOk) > 1000) {
                    $m_rowsOk = array_chunk($productosOk, 1000, true);
                    foreach ($m_rowsOk as $m_row) {
                        \DB::table('productos')->insert($m_row);
                    }
                } else {
                    \DB::table('productos')->insert($productosOk);
                }
                $end = \Carbon\Carbon::now();

                $nuevos = count($productosOk);
                $demoro = $start->diffInSeconds($end);
                $proceso = 'OK';

                $this->updateSlugProducts();

                Log::info("Finaliza Proceso de actualización de Productos");
                Log::info("     - Se actualizaron: " . $qActualizados . " Productos.");
                Log::info("     - Se agregaron: " . $nuevos . " Productos.");
                Log::info("El Proceso demoro: " . $demoro . " Segundos");
                Log::info("###################################################################" . "\n");

                return view('admin.procesos.productos.result', compact('qRegistros', 'qActualizados', 'nuevos', 'demoro', 'proceso', 'errores'));

            } else {

                Log::info("Finaliza Proceso de actualización de Productos");
                Log::info("     - No se encontro el archivo necesario (productos.csv) para la actualización de Productos en el directorio /storage/csv/repo");
                Log::info("###################################################################" . "\n");

                $proceso = 'ERROR';

                return view('admin.procesos.productos.result', compact('proceso'));
            }
        }

    }

    private function getIva($iva)
    {
        if ($iva == 2) {
            return "10.5";
        } else {
            return "21";
        }
    }

    private function getPrecio($precio)
    {
        return str_replace(',', '.', $precio);
    }

    private function getFechaActualizacion($actualizado)
    {
        try{

            $act = '';
            if ($actualizado != '' && strlen($actualizado) == 10) {
                $act = \Carbon\Carbon::createFromFormat('d/m/Y', trim($actualizado), 'UTC')->toDateTimeString();
            }
            return $act;

        } catch (Exception $ex) {

            throw $ex;

        }

    }

    private function isProductoActivo($activo)
    {
        if ($activo == 'T' || $activo == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Valido los campos del Archivo
     * @param type $row
     * @param type $rowsError
     */
    private function validarProducto($registro, &$marcas, &$rubros, $i, &$errores)
    {

        $v = self::VALIDACION_OK;
        $keys = ['codigo', 'nombre', 'cod_barra', 'precio', 'iva', 'rubro_id', 'univen', 'cod_origen', 'marca_id', 'activo', 'detmarca', 'detrubro', 'actualizado', 'stock', 'stock_minimo'];
        //Valido cantidad de Campos
        if (count($registro) != count($keys)) {
            Log::error('La cantidad de campos en la fila numero: ' . $i . ' es diferente a la esperada.');
            $v = self::VALIDACION_ERROR_FATAL;
        } else {
            $row = array_combine($keys, $registro);
            //Valido el codigo del Producto
            if (strlen(trim($row['codigo'])) == 0) {
                Log::error('El Codigo de la fila número: ' . $i . ' no puede ser vacío.');
                array_push($errores, 'El Codigo de la fila número: ' . $i . ' no puede ser vacío.');
                $v = self::VALIDACION_ERROR;
            }
            //Valido el nombre del Producto
            if (strlen(trim($row['nombre'])) == 0) {
                Log::error('El Nombre del Producto con codigo [' . $row['codigo'] . '] de la fila número: ' . $i . ' no puede ser vacío.');
                array_push($errores, 'El Nombre del Producto con codigo [' . $row['codigo'] . '] de la fila número: ' . $i . ' no puede ser vacío.');
                $v = self::VALIDACION_ERROR;
            }
            //valido que el Rubro exista en la base
            if (trim($row['rubro_id']) != 0) {
                if (!array_key_exists(trim($row['rubro_id']), $rubros)) {

                    Log::info('El Rubro (' . $row['detrubro'] . ') - Nro: [' . $row['rubro_id'] . '] del Producto [' . $row['codigo'] . '] de la fila número: ' . $i . ' no existia en la base y fue agregado');
                    //array_push($errores, 'El Rubro (' . $row['detrubro'] . ') - Nro: [' . $row['rubro_id'] . '] del Producto [' . $row['codigo'] . '] de la fila número: ' . $i . ' no existia en la base y fue agregado.');
                    //$v = self::VALIDACION_ERROR;

                    $this->insertarRubro($row['rubro_id'], $row['detrubro']);
                    $rubros[$row['rubro_id']] = $row['detrubro'];
                }
            }
            //valido que la Marca exista en la base
            if (!array_key_exists(trim($row['marca_id']), $marcas)) {


                Log::info('La Marca (' . $row['detmarca'] . ') - ID: [' . $row['marca_id'] . '] del Producto [' . $row['codigo'] . '] de la fila número: ' . $i . ' no existia en la base y fue agregada.');
                //array_push($errores, 'La Marca (' . $row['detmarca'] . ') - ID: [' . $row['marca_id'] . '] del Producto [' . $row['codigo'] . '] de la fila número: ' . $i . ' no existia en la base y fue agregada.');
                //$v = self::VALIDACION_ERROR;

                $this->insertarMarca($row['marca_id'], $row['detmarca']);
                $marcas[$row['marca_id']] = $row['detmarca'];
            }
        }

        return $v;
    }

    private function insertarRubro($rubro_id, $rubro_nombre)
    {
        $rubro = new Rubro();
        $rubro->id = $rubro_id;
        $rubro->nombre = $rubro_nombre;
        //$rubro->setAudit('admin');
        $rubro->save();
    }

    private function insertarMarca($marca_id, $marca_nombre)
    {
        $marca = new Marca();
        $marca->id = $marca_id;
        $marca->nombre = $marca_nombre;
        //$marca->setAudit('admin');
        $marca->save();
    }

    private function updateSlugProducts()
    {
        $productos = Producto::where('slug', '')->get();
        foreach ($productos as $producto) {
            $producto->slug = $producto->id . '-' . str_slug($producto->nombre);
            $producto->save();
        }
    }

    private function createRollBackTable(){

        //PRODUCTOS
        \Schema::dropIfExists('productos_rollback');
        \DB::statement(\DB::raw("CREATE TABLE productos_rollback LIKE productos"));
        \DB::statement(\DB::raw("INSERT productos_rollback SELECT * FROM productos"));

        //MARCAS
        \Schema::dropIfExists('marcas_rollback');
        \DB::statement(\DB::raw("CREATE TABLE marcas_rollback LIKE marcas"));
        \DB::statement(\DB::raw("INSERT marcas_rollback SELECT * FROM marcas"));

        //RUBROS
        \Schema::dropIfExists('rubros_rollback');
        \DB::statement(\DB::raw("CREATE TABLE rubros_rollback LIKE rubros"));
        \DB::statement(\DB::raw("INSERT rubros_rollback SELECT * FROM rubros"));

    }

}
