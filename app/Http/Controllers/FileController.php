<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class FileController extends Controller {

    public function getFile($folder, $filename) {
        return response()->download(public_path($folder . '/' . $filename), null, [], null);
    }

}
