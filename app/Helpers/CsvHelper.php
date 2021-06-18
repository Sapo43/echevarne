<?php

namespace App\Helpers;

use Carbon\Carbon;

class CsvHelper {

    public function csv_to_array($filename = '', $delimiter = ';') {

        if (!file_exists($filename) || !is_readable($filename)) {
            return FALSE;
        }

        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 500, $delimiter)) !== FALSE) {
                $data[] = $this->utf8_converter($row);
            }
            fclose($handle);
        }
        return $data;
    }

    public function renameFile($path, $filename){
        
        $f_date = Carbon::now()->format('dmY');

        try{
            rename($path . $filename, $path . "/" . $f_date . "_" . $filename);
        } catch (Exception $ex) {
            throw $ex;
        }

    }

    private function utf8_converter($array) {
        array_walk_recursive($array, function(&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });

        return $array;
    }

}
