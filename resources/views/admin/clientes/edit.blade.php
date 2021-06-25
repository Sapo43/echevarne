@extends('layouts.app')

@section('content')
    <div class="panel panel-default cliente">
        <div class="row cabecera">
            <div class="col-md-8">
                <h4>
                    Editar Cliente
                </h4>
            </div>
        </div>
        <div class="panel-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error:</span>
                                    <span style="text-transform: capitalize;">&nbsp;{{$error}}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                {!! Form::model($cliente, ['route' => ['admin.clientes.update', $cliente->id], 'method' => 'PUT'])!!}
                @include('admin.clientes.partials.fields')
                <div class="row">
                    <div class="col-md-12" style="  text-align: right;">
                        <a href="{{ route('admin.clientes.index') }}" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>&nbsp;
                            Guardar
                        </button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('admin.clientes.editPass', $cliente->id) }}" class="btn btn-info">
                            <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>&nbsp;
                            Cambiar Contraseña
                        </a>&nbsp;&nbsp;
                    </div>
                </div>
                {!! Form::hidden('clienteId', $cliente->id, array('id'=>'clienteId')) !!}
                {!! Form::close() !!}
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