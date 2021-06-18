<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurisdiccion extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jurisdicciones';

    public static function getJurisdicciones() {
        return \Cache::rememberForever('jurisdicciones', function() {
                    return Jurisdiccion::all();
                });
    }

}
