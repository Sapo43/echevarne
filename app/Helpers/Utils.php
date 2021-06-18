<?php

namespace App\Helpers;

class Utils {

    public static function verificarCUIT($cuit) {
        if (strlen($cuit) == 11) {
            $cadena = str_split($cuit);
            $result = $cadena[0] * 5;
            $result += $cadena[1] * 4;
            $result += $cadena[2] * 3;
            $result += $cadena[3] * 2;
            $result += $cadena[4] * 7;
            $result += $cadena[5] * 6;
            $result += $cadena[6] * 5;
            $result += $cadena[7] * 4;
            $result += $cadena[8] * 3;
            $result += $cadena[9] * 2;

            $div = intval($result / 11);
            $resto = $result - ($div * 11);

            //Si el resto es 0, el codigo verificador tiene que ser 0
            if ($resto == 0) {
                if ($resto == $cadena[10]) {
                    return true;
                } else {
                    return false;
                }
                //Si el resto es 1    
            } elseif ($resto == 1) {
                //El codigo verificador tiene que ser igual a 9
                if ($cadena[10] == 9 AND $cadena[0] == 2 AND $cadena[1] == 3) {
                    return true;
                } elseif ($cadena[10] == 4 AND $cadena[0] == 2 AND $cadena[1] == 3) {
                    return true;
                }
                //Si es distinto de 0 y de 1, el codigo verificador es 11 - el resto    
            } elseif ($cadena[10] == (11 - $resto)) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

}
