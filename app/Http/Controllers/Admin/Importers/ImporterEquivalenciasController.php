<?php

namespace App\Http\Controllers\Admin\Importers;

use App\Helpers\CsvHelper;
use App\Helpers\ImportersHelper;
use App\Models\Equivalencias;
use App\Models\Producto;
use App\Http\Controllers\Controller;
use DB;
use Log;

class ImporterEquivalenciasController extends Controller {

    CONST DESTINATION_PATH_EQUIVALENCIA = "equivalencias";
    CONST PREFIX_EQUIVALENCIA = "EQUIVALENCIAS";
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
        return view('admin.importers.equivalencias.index');
    }

    /**
     * Valido el archivo de equivalencias que se quiere importar
     * @return type
     */
    public function upload() {
        $data = \Request::all();

        $file = $data['archivo'];
        $filename = ImportersHelper::generateFileName(self::PREFIX_EQUIVALENCIA, $file->getClientOriginalExtension());
        $csvFile = ImportersHelper::saveFile($file, $filename, self::DESTINATION_PATH_EQUIVALENCIA . '/');

        $rows = array();
        if (ImportersHelper::getExtensionFile($csvFile) == 'csv' || ImportersHelper::getExtensionFile($csvFile) == 'CSV') {
            $rows = $this->csvHelper->csv_to_array($csvFile);
           // dd("Entro",$this->csvHelper->csv_to_array($csvFile));
        } else {
            $rows = \Excel::load($csvFile, function($reader) {
                        $reader->noHeading();
                    }, false, true)->get()[0]->toArray();
                
        }

        // $equivalencias = Equivalencia::lists('codigo', 'equivalenc')->toArray();

        // $rowsOk = array();
        // $rowsError = array();
        // $i = 1;

        // foreach ($rows as $row) {

        //     $vRow = $this->validarEquivalencia($row, $rowsError, $equivalencias, $i);
        //     switch ($vRow) {
        //         case self::VALIDACION_OK:
        //             array_push($rowsOk, $row[0]);
        //             break;
        //         case self::VALIDACION_ERROR_FATAL:
        //             break 2;
        //     }
        //     $i++;

      
        $rowsError=[];
       
        $rowsOk=$rows;

        return view('admin.importers.equivalencias.validacionResult',compact('rowsOk', 'rowsError', 'filename'));
    }

    /**
     * Importo el archivo de equivalencias
     */
    public function importar() {

    
        Log::info("Eliminando tabla de equivalencias ");
        Log::info( \DB::statement(\DB::raw("delete from equivalencias")));
       // \DB::statement(\DB::raw("INSERT equivalencias_rollback SELECT * FROM equivalencias"));
       Log::info("Elimino tabla");


     $data = \Request::all();
        
         $filename = $data['archivo'];
    
        $csvFile = storage_path('csv/equivalencias/' . $filename);

        $rows = array();
        if (ImportersHelper::getExtensionFile($csvFile) == 'csv' || ImportersHelper::getExtensionFile($csvFile) == 'CSV') {
            $rows = $this->csvHelper->csv_to_array($csvFile);
           // dd("Entro",$this->csvHelper->csv_to_array($csvFile));
        } else {
            $rows = \Excel::load($csvFile, function($reader) {
                        $reader->noHeading();
                    }, false, true)->get()[0]->toArray();
                
        }
        $equivalenciasOk=0;
        $rowsError=0;
        foreach ($rows as $row) {
            
            $equiv = strstr($row[0], ',');
        
            $codigo = strstr($row[0], ',',true);
            $equiva=preg_replace('/,/', ' ', $equiv, 1);
            $equiva1=str_replace("\"", "", $equiva);
            $equivalen=str_replace(" ", " ", $equiva1);       
            DB::beginTransaction();
            try{
                $equivalencia = new Equivalencias();
                $equivalencia->codigo=$codigo;
                $equivalencia->equivalencia=$equivalen;
                $equivalencia->save();
                $producto= Producto::where('codigo','=',$codigo)->get();
                $producto[0]->equivalencia=$equivalen;
                $producto[0]->save();
                DB::commit();
                $equivalenciasOk++;

        }   catch (\Exception $e) {
            $rowsError++;
            DB::rollback();
        } 

     }
        // $equivalencias = Equivalencias::lists('codigo', 'equivalenc')->toArray();

        // $rowsError = array();
        // $i = 1;
        // $table_keys = ['codigo', 'equivalenc'];
        // $equivalenciasOk = array();
        
        // foreach ($rows as $row) {
          
        //     //$vRow = $this->validarEquivalencia($row, $rowsError, $equivalencias, $i);
        //     $vRow="OK";
        //     $values = array();
            
        //     switch ($vRow) {
        //         case self::VALIDACION_OK:
        //             array_push($values, $row[0]);
        //             array_push($values, $row[1]);
        //             $equivalencia = array_combine($table_keys, array_values($values));
        //             array_push($equivalenciasOk, $equivalencia);
        //             break;
        //         case self::VALIDACION_ERROR_FATAL:
        //             break 2;
        //     }
        //     $i++;
        // }
              
        // if (count($equivalenciasOk) > 1000) {
        //     $m_rowsOk = array_chunk($equivalenciasOk, 1000, true);
        //     foreach ($m_rowsOk as $m_row) {
        //         \DB::table('equivalencias')->insert($m_row);
        //     }
        // } else {
        //     \DB::table('equivalencias')->insert($equivalenciasOk);
        // }

        return view('admin.importers.equivalencias.importResult', compact('equivalenciasOk', 'rowsError', 'filename'));
    }

   




    /**
     * Valido los campos del Archivo
     * @param type $row
     * @param type $rowsError
     */
    // private function validarEquivalencia($row, &$rowsError, $equivalencias, $i) {

    //     $v = self::VALIDACION_OK;
    //     $keys = ['codigo', 'equivalenc'];

    //     //Valido cantidad de Campos
    //     if (count($row) != count($keys)) {
    //         dd( $row,$keys);
    //         array_push($rowsError, 'La cantidad de campos en la fila numero: ' . $i . ' es diferente a la esperada. Corrija el archivo y vuelva a validarlo.');
    //         $v = self::VALIDACION_ERROR_FATAL;
    //     } else {
    //         //Valido el ID del Equivalencia
    //         if (strlen(trim($row[0])) > 0) {
    //             //Verifico que el ID del Equivalencia no exista en la base
    //             if (array_key_exists($row[0], $equivalencias)) {
    //                 array_push($rowsError, 'El ID (' . $row[0] . ') de la fila numero: ' . $i . ' ya existe dentro de la base.');
    //                 $v = self::VALIDACION_ERROR;
    //             }
    //         } else {
    //             array_push($rowsError, 'El id de la fila número: ' . $i . ' no puede ser vacío.');
    //             $v = self::VALIDACION_ERROR;
    //         }
    //         //Valido el nombre del Equivalencia
    //         if (strlen(trim($row[1])) > 0) {
    //             //Verifico que el Nombre del Equivalencia no exista en la base
    //             if (in_array($row[1], $equivalencias)) {
    //                 array_push($rowsError, 'Fila Número: ' . $i . '. Ya existe un Equivalencia con el nombre: ' . $row[1]);
    //                 $v = self::VALIDACION_ERROR;
    //             }
    //         } else {
    //             array_push($rowsError, 'El Nombre del Equivalencia de la fila número: ' . $i . ' no puede ser vacío.');
    //             $v = self::VALIDACION_ERROR;
    //         }
    //         //El resto de los campos no son Obligatorios
    //     }

    //     return $v;
    // }

}

