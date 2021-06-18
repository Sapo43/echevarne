<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;

class ImportersHelper {

    /**
     * Valida el archivo seleccionado por el Usuario
     * @param type $data
     * @return type
     */
    public static function validarFile($data) {
        $messages = [
            'archivo.required' => 'Debe seleccionar un archivo para poder continuar',
            'archivo.mimes' => 'El archivo debe tener extensión .csv, .xlsx o .xls',
        ];

        $rules = array(
            'archivo' => 'required|mimes:csv,txt,xlsx,xls',
        );

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Genera el nombre del Archivo
     * @param type $prefix
     * @param type $extension
     * @return type
     */
    public static function generateFileName($prefix, $extension) {
        $now = \Carbon\Carbon::now()->format('Y-m-d_hm');
        return $prefix . '_' . $now . '.' . $extension;
    }

    /**
     * Guarda el Archivo en el path indicado como parametro y devuelve la ruta final
     * @param type $file
     * @param type $fileName
     * @param type $destinationPath
     * @return type
     */
    public static function saveFile($file, $fileName, $destinationPath) {
        $finalPath = storage_path('csv/' . $destinationPath);
        $file->move($finalPath, $fileName);

        return $finalPath . '/' . $fileName;
    }

    /**
     * Obtiene la Extension del Archivo subido por el Usuario
     * @param type $file
     * @return type
     */
    public static function getExtensionFile($file) {
        return substr($file, strripos($file, '.') + 1);
    }

}
