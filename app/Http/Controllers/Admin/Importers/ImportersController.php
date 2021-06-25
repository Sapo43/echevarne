<?php

namespace App\Http\Controllers\Admin\Importers;

use App\Http\Controllers\Controller;

class ImportersController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('admin.importers.index');
    }
    
}
