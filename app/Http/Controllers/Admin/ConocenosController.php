<?php

namespace App\Http\Controllers\Admin;

use App\Models\Conocenos;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class ConocenosController extends Controller {

    const DESTINATION_PATH = 'img/empresa';

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
        if (\Auth::guard('admin')->user()->can(['conocenos-editar'])) {
            return redirect()->route('admin.conocenos.edit', 1);
        } else {
            return view('errors.noTienePermisos');
        }
    }    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        if (\Auth::guard('admin')->user()->can(['conocenos-editar'])) {
            $conocenos = Conocenos::findOrFail($id);
            return view('admin.conocenos.edit', compact('conocenos'));
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        if (\Auth::guard('admin')->user()->can(['conocenos-editar'])) {
            $data = \Request::all();
            $conocenos = Conocenos::findOrFail($id);

            if (\Request::file('imagen') == null) {
                $data['imagen'] = $conocenos->imagen;
            } else {
                $pathImagen = $this->saveImage(Request::file('imagen'), 'conocenos_sq', self::DESTINATION_PATH);
                $data['imagen'] = $pathImagen;
            }
            
            $conocenos->fill($data);
            $conocenos->setAudit('admin');
            $conocenos->save();

            return redirect()->route('admin.conocenos.edit', 1);
        } else {
            return view('errors.noTienePermisos');
        }
    }

    private function generateFileName($titulo, $extension) {
        return str_slug($titulo, '-') . '.' . $extension;
    }

    private function saveImage($image, $imageTitle, $destinationPath) {

        $extension = $image->getClientOriginalExtension();
        $fileName = $this->generateFileName($imageTitle, $extension);
        $image->move($destinationPath, $fileName);

        return $destinationPath . '/' . $fileName;
    }

}
