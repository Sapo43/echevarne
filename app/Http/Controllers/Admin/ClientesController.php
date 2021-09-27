<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\StrHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ClientesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $clientes = User::filterAndPaginate($request->get('estado'), $request->get('apellido'), $request->get('dni'), $request->get('email'), $request->get('nro_cliente'), $request->get('cuit'));
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (\Auth::guard('admin')->user()->can(['clientes-crear'])) {

            $operatorias = ['CONS FINAL' => 'CONS FINAL', 'MONOTRIBUTO' => 'MONOTRIBUTO', 'INSCRIPTO' => 'INSCRIPTO', 'OTRO' => 'OTRO'];
     		$vendedor= ['1'=>'SI','0'=>'NO'];
      
            return view('admin.clientes.create', compact('operatorias','vendedor',));
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (\Auth::guard('admin')->user()->can(['clientes-crear'])) {
            $data = \Request::all();

            $v = $this->validarCliente($data);

            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors())->withInput(\Request::All());
            }

            $data['dni'] = StrHelper::soloNumeros(trim($data['dni']));
            $data['cuit'] = StrHelper::soloNumeros(trim($data['cuit']));

            $cliente = new User($data);
            if (isset($data['cuit'])) {
                $cliente->username = $cliente->cuit;
                $cliente->estado = 'H';
                $cliente->password = \Hash::make($cliente->cuit);
            } else {
                $cliente->estado = 'I';
            }

            $cliente->setAudit('admin');
            $cliente->save();

            return redirect()->route('admin.clientes.index');
        } else {
            return view('errors.noTienePermisos');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $cliente = User::findOrFail($id);
        $operatorias = ['CONS FINAL' => 'CONS FINAL', 'MONOTRIBUTO' => 'MONOTRIBUTO', 'INSCRIPTO' => 'INSCRIPTO', 'OTRO' => 'OTRO'];
     	$vendedor= ['1'=>'SI','0'=>'NO'];
      
        return view('admin.clientes.edit', compact('cliente', 'operatorias','vendedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        $data = \Request::all();
        $cliente = User::findOrFail($id);

        //$v = $this->validarCliente($data);

        //if ($v->fails()) {
          //  return redirect()->back()->withErrors($v->errors())->withInput(\Request::All());
        //}

        $data['dni'] = StrHelper::soloNumeros(trim($data['dni']));
        $data['cuit'] = StrHelper::soloNumeros(trim($data['cuit']));

        $cliente->fill($data);
        if (isset($data['cuit'])) {
            $cliente->username = $cliente->cuit;
        }
        $cliente->setAudit('admin');
        $cliente->save();

        return redirect()->route('admin.clientes.index');
    }

    public function habilitar($clienteId)
    {
        $cliente = User::findOrFail($clienteId);
        $cliente->estado = User::getEstadoHabilitado();

        $cliente->setAudit('admin');
        $cliente->save();

        return redirect()->route('admin.clientes.index');
    }

    public function inhabilitar($clienteId)
    {
        $cliente = User::findOrFail($clienteId);
        $cliente->estado = User::getEstadoInhabilitado();

        $cliente->setAudit('admin');
        $cliente->save();

        return redirect()->route('admin.clientes.index');
    }

    public function show($userId)
    {
        $cliente = User::findOrFail($userId);
        return view('admin.cliente.show', compact('cliente'));
    }

    public function editContraseña($id)
    {
        $user = User::findOrFail($id);
        return view('admin.clientes.changePassword', compact('user'));
    }

    public function updateContraseña($id)
    {
        $data = \Request::all();
        $v = $this->validarContraseña($data);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput(\Request::All());
        }

        $user = User::findOrFail($id);
        $user->password = \Hash::make($data['contraseña']);
        $user->setAudit('admin');
        $user->save();
        return redirect()->route('admin.clientes.index');
    }

    private function validarCliente($data)
    {

        $data['dni'] = StrHelper::soloNumeros(trim($data['dni']));
        $data['cuit'] = StrHelper::soloNumeros(trim($data['cuit']));

        if (isset($data['clienteId'])) {
            $userId = ',' . $data['clienteId'];
        } else {
            $userId = '';
        }

        $messages = [];

        $rules = array(
            'nro_cliente' => 'required|unique:users,nro_cliente' . $userId,
            'apellido' => 'required',
            'nombre' => 'required',
            'email' => 'email',
            'dni' => 'required_with:cuit|string|min:7|max:8',
            'porcentaje_compra' =>'required',
            'porcentaje_venta' => 'required '
            
        );

        return Validator::make($data, $rules, $messages);
    }

    private function validarContraseña($data)
    {

        $messages = [
            'contraseña.min' => 'La Contraseña debe tener como minimo 8 caracteres',
            'contraseña.required' => 'El campo Nueva Contraseña es obligatorio',
            'contraseña_rep.same' => 'La Contraseñas ingresadas no coinciden',
            'contraseña_rep.required' => 'El campo Repetir Contraseña es obligatorio',
        ];

        $rules = array(
            'contraseña' => 'required|min:8',
            'contraseña_rep' => 'required|same:contraseña',
        );

        return Validator::make($data, $rules, $messages);
    }

}
