<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contacto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;

class ContactosController extends Controller {

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
        $contactos = Contacto::paginate(30);
        return view('admin.contactos.index', compact('contactos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

        $contacto = Contacto::findOrFail($id);
        return view('admin.contactos.edit', compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        $data = \Request::all();
        $contacto = Contacto::findOrFail($id);

        $v = $this->validarContacto($data);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput(Request::All());
        }

        $contacto->fill($data);
        $contacto->setAudit('admin');
        $contacto->save();

        return redirect()->route('admin.contactos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $contacto = Contacto::findOrFail($id);
        $contacto->delete();
        return response()->json('OK');
    }

    public function downloadFile() {
        $contactos = Contacto::select('nombre', 'email', 'telefono', 'localidad', 'created_at')->get()->toArray();
        $filename = "Contactos";
        array_unshift($contactos, ['Nombre', 'Email', 'Teléfono', 'Localidad', 'Fecha de Alta']);
        $this->descargarArchivo($contactos, $filename);
    }

    private function descargarArchivo($contactos, $filename) {

        \Excel::create($filename, function($excel) use($contactos, $filename) {

            $excel->setTitle($filename);
            $excel->sheet('Listado de Contactos', function($sheet) use($contactos) {
                $sheet->fromArray($contactos, null, 'A1', false, false);
                $sheet->setBorder('A1:E' . count($contactos), 'thin');
                $sheet->setBorder('A1:E1', 'medium');
                $sheet->row(1, function($row) {
                    $row->setBackground('#8DB4E2');
                });
                $sheet->setColumnFormat(array(
                    'D' => 'dd/mm/yy h:mm',
                ));
                $sheet->setAutoFilter();
            });
        })->download('xlsx');

        return $contactos;
    }

    private function validarContacto($data) {

        $messages = [];

        $rules = array(
            'email' => 'required|email',
        );

        return Validator::make($data, $rules, $messages);
    }

}
