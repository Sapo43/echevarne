<?php

//  I have placed my model in app\Models. Change the namespace to below if you want to keep it in default location.
//namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageModal extends Model
{
    //
    protected $table = 'image_modal';
    protected $fillable = [
        'name', 'url','desde','hasta'
    ];


}