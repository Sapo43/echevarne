<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\AuditTrait;

class Equivalencias extends Model{


    protected $table = 'equivalencias';
    protected $fillable = ['codigo','equivalencia'];

}