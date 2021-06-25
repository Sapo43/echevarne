@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="row cabecera">
        <div class="col-md-8">
            <h4>
                Clientes
            </h4>    
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.clientes.create') }}" title="Nuevo Cliente" class="btn btn-success">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
                Nuevo Cliente
            </a>
        </div>        
    </div>
    <div class="panel-body">
        <div class="row">
            {!! Form::model(Request::all(), ['route' => ['admin.clientes.index'], 'method' => 'GET'])!!}
            <div class="col-md-2 col-wop-r form-group">
                {!! Form::label('nro_cliente', 'N° Cliente') !!}
                {!! Form::text('nro_cliente', null, array('class' => 'form-control')) !!}
            </div>
            <div class="col-md-2 col-wop-r form-group">
                {!! Form::label('apellido', 'Apellido') !!}        
                {!! Form::text('apellido', null, array('class' => 'form-control')) !!}
            </div>  
            <div class="col-md-2 col-wop-r form-group">
                {!! Form::label('dni', 'DNI') !!}        
                {!! Form::text('dni', null, array('class' => 'form-control dni')) !!}
            </div>
            <div class="col-md-2 col-wop-r form-group">
                {!! Form::label('cuit', 'CUIT') !!}
                {!! Form::text('cuit', null, array('class' => 'form-control cuit')) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-wop-r form-group">
                {!! Form::label('email', 'Email') !!}        
                {!! Form::text('email', null, array('class' => 'form-control')) !!}
            </div>
            <div class="col-md-2 col-wop-r form-group">
                {!! Form::label('estado', 'Estado') !!}
                {!! Form::select('estado', ['' => 'Todos', 'H' => 'Habilitados', 'I' => 'InHabilitados'], null, ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-2 col-wop-r form-group">
                {!! Form::label('', '') !!}
                <button type="submit" class="btn btn-success form-control">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;
                    Filtrar
                </button>
            </div>
            {!! Form::close() !!}
        </div>          
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <tr>
                            <th>Nro Cliente</th>
                            <th>Nombre</th>
                            <th>DNI / CUIT</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Operatoria</th>
                            <th>Alta / Baja</th>
                            <th>Habilitado</th>
                            <th>Acciones</th>
                        </tr>							
                        @foreach ($clientes as $cliente)
                        <tr data-id="{{$cliente->id}}">				
                            <td>
                                {{$cliente->nro_cliente}}
                            </td>                    
                            <td>
                                {{$cliente->apellido}}, {{$cliente->nombre}}
                            </td>               
                            <td nowrap align="center">
                                <span class="dni">{{$cliente->dni}}</span><br>
                                <span class="cuit">{{$cliente->cuit}}</span>
                            </td>
                            <td>
                                {{$cliente->telefono}}
                            </td> 
                            <td>
                                {{$cliente->email}}
                            </td>
                            <td>
                                {{$cliente->operatoria}}
                            </td>
                            <td>
                                {{$cliente->updated_at}}
                            </td>                            
                            <td>
                                @if($cliente->estado == 'H')
                                    Habilitado
                                @else
                                    InHabilitado
                                @endif
                            </td>                    
                            <td>
                                <a href="{{ route('admin.clientes.edit', $cliente->id) }}" title="Editar Cliente" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                @if($cliente->estado == "H")
                                <a href="{{ route('admin.clientes.inhabilitar', $cliente->id) }}" title="Inhabilitar Cliente" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </a>
                                @elseif($cliente->estado == "P" || $cliente->estado == "I")
                                <a href="{{ route('admin.clientes.habilitar', $cliente->id) }}" title="Habilitar Cliente" class="btn btn-success">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                </a>
                                @endif
                            </td>                                                
                        </tr>								
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {!! str_replace('/?', '?', $clientes->appends(Request::only(['estado', 'apellido', 'dni', 'email']))->render()) !!}  
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
    {!! HTML::script('js/jquery.mask.min.js') !!}
    <script>
        $(document).ready(function () {
            $('.dni').mask("00.000.000", {reverse: true});
            $('.cuit').mask("00-00.000.000-0");
        });
    </script>
@endsection