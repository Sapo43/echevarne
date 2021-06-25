<?php

namespace App\Http\Controllers\Admin\Importers;

use App\Helpers\CsvHelper;
use App\Helpers\ImportersHelper;
use App\Models\Rubro;
use App\Http\Controllers\Controller;

class ImporterRubrosController extends Controller {

    CONST DESTINATION_PATH_RUBROS = "rubros";
    CONST PREFIX_RUBROS = "RUBROS";
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
        return view('admin.importers.rubros.index');
    }

    /**
     * Valido el archivo de Rubros que se quiere importar
     * @return type
     */
    public function validar() {
        $data = \Request::all();

        $file = $data['archivo'];
        $filename = ImportersHelper::generateFileName(self::PREFIX_RUBROS, $file->getClientOriginalExtension());
        $csvFile = ImportersHelper::saveFile($file, $filename, self::DESTINATION_PATH_RUBROS . '/');

        $rows = array();
        if ($file->getClientOriginalExtension() == 'csv') {
            $rows = $this->csvHelper->csv_to_array($csvFile);
        } else {
            $rows = \Excel::load($csvFile, function($reader) {
                        $reader->noHeading();
                    })->get()[0]->toArray();
        }

        $rubros = Rubro::lists('nombre', 'id')->toArray();

        $rowsOk = array();
        $rowsError = array();
        $i = 1;

        foreach ($rows as $row) {

            $vRow = $this->validarRubro($row, $rowsError, $rubros, $i);
            switch ($vRow) {
                case self::VALIDACION_OK:
                    array_push($rowsOk, $row[0]);
                    break;
                case self::VALIDACION_ERROR_FATAL:
                    break 2;
            }
            $i++;
        }

        return view('admin.importers.rubros.validacionResult', compact('rowsOk', 'rowsError', 'filename'));
    }

    /**
     * Importo el archivo de Rubros
     */
    public function importar() {

        $data = \Request::all();

        $filename = $data['archivo'];
        $csvFile = storage_path('csv/' . self::DESTINATION_PATH_RUBROS . '/' . $filename);

        $rows = array();
        if (ImportersHelper::getExtensionFile($csvFile) == 'csv') {
            $rows = $this->csvHelper->csv_to_array($csvFile);
        } else {
            $rows = \Excel::load($csvFile, function($reader) {
                        $reader->noHeading();
                    }, false, true)->get()[0]->toArray();
        }

        $rubros = Rubro::lists('nombre', 'id')->toArray();

        $rowsError = array();
        $i = 1;
        $table_keys = ['id', 'nombre'];
        $rubrosOk = array();
        
        foreach ($rows as $row) {
            $vRow = $this->validarRubro($row, $rowsError, $rubros, $i);
            $values = array();
            
            switch ($vRow) {
                case self::VALIDACION_OK:
                    array_push($values, $row[0]);
                    array_push($values, $row[1]);
                    $rubro = array_combine($table_keys, array_values($values));
                    array_push($rubrosOk, $rubro);
                    break;
                case self::VALIDACION_ERROR_FATAL:
                    break 2;
            }
            $i++;
        }
              
        if (count($rubrosOk) > 1000) {
            $m_rowsOk = array_chunk($rubrosOk, 1000, true);
            foreach ($m_rowsOk as $m_row) {
                \DB::table('rubros')->insert($m_row);
            }
        } else {
            \DB::table('rubros')->insert($rubrosOk);
        }

        return view('admin.importers.rubros.importResult', compact('rubrosOk', 'rowsError', 'filename'));
    }

    /**
     * Valido los campos del Archivo
     * @param type $row
     * @param type $rowsError
     */
    private function validarRubro($row, &$rowsError, $rubros, $i) {

        $v = self::VALIDACION_OK;
        $keys = ['id', 'nombre'];

        //Valido cantidad de Campos
        if (count($row) != count($keys)) {
            array_push($rowsError, 'La cantidad de campos en la fila numero: ' . $i . ' es diferente a la esperada. Corrija el archivo y vuelva a validarlo.');
            $v = self::VALIDACION_ERROR_FATAL;
        } else {
            //Valido el ID del Rubro
            if (strlen(trim($row[0])) > 0) {
                //Verifico que el ID del rubro no exista en la base
                if (array_key_exists($row[0], $rubros)) {
                    array_push($rowsError, 'El ID (' . $row[0] . ') de la fila numero: ' . $i . ' ya existe dentro de la base.');
                    $v = self::VALIDACION_ERROR;
                }
            } else {
                array_push($rowsError, 'El id de la fila número: ' . $i . ' no puede ser vacío.');
                $v = self::VALIDACION_ERROR;
            }
            //Valido el nombre del Rubro
            if (strlen(trim($row[1])) > 0) {
                //Verifico que el Nombre del rubro no exista en la base
                if (in_array($row[1], $rubros)) {
                    array_push($rowsError, 'Fila Número: ' . $i . '. Ya existe un Rubro con el nombre: ' . $row[1]);
                    $v = self::VALIDACION_ERROR;
                }
            } else {
                array_push($rowsError, 'El Nombre del Rubro de la fila número: ' . $i . ' no puede ser vacío.');
                $v = self::VALIDACION_ERROR;
            }
            //El resto de los campos no son Obligatorios
        }

        return $v;
    }

}
