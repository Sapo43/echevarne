@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row cabecera">
            <div class="col-md-12">
                <h4>Cambiar Contraseña para el usuario <strong>{{$user->username}}</strong></h4>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="container-fluid editAlumno">
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
            {!! Form::model($user, ['route' => ['admin.clientes.updatePass', $user->id], 'method' => 'PUT'])!!}
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('contraseña', 'Nueva Contraseña') !!}
                    {!! Form::password('contraseña', array('class' => 'form-control')) !!}
                </div>   
                <div class="col-md-3 form-group">
                    {!! Form::label('contraseña_rep', 'Repetir Contraseña') !!}
                    {!! Form::password('contraseña_rep', array('class' => 'form-control')) !!}
                </div>
            </div>      
            <div class="row">
                <div class="col-md-12" style="  text-align: right;">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;
                        Cancelar
                    </a>    
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>&nbsp;
                        Guardar
                    </button>
                </div>
            </div>                    
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection