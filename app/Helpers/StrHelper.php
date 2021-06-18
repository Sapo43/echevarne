<?php

namespace App\Helpers;

class StrHelper {

    /**
     * 
     * @param type $string
     * @return type
     */
    public static function clean($string) {
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    public static function quitar_acentos($string) {
        
        $string = str_replace('á', 'a', $string);
        $string = str_replace('Á', 'A', $string);
        
        $string = str_replace('é', 'e', $string);
        $string = str_replace('É', 'E', $string);        
        
        $string = str_replace('Í', 'I', $string);
        $string = str_replace('í', 'i', $string);
        
        $string = str_replace('ó', 'o', $string);
        $string = str_replace('Ó', 'O', $string);
        
        $string = str_replace('ú', 'u', $string);
        $string = str_replace('Ú', 'U', $string);
        
        $string = str_replace('ç ', 'c ', $string);
        $string = str_replace('Ç ', 'C ', $string);
        $string = str_replace('ñ ', 'n ', $string);
        $string = str_replace('Ñ ', 'N ', $string);
        
        return $string;
    }

    public static function soloNumeros($string){
        return preg_replace('/[^0-9]/', '', $string);
    }
}
