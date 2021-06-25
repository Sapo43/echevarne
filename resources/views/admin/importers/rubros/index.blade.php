@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>
            Importador de Rubros
        </h4>    
    </div>
    <div class="panel-body">
        <div class="row">                      
            <div class="col-md-12">
                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <span>&nbsp;{{$error}}</span>
                </div>              
                @endforeach
                @endif
            </div>
        </div>          
        <br />
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['action' => 'Admin\Importers\ImporterRubrosController@validar', 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}  
                <div class="col-md-3 form-group">
                    {!! Form::label('archivo', 'Archivo') !!}        
                    {!! Form::file('archivo', array('class' => 'form-control')) !!}
                </div>       
            </div>
            <div class="col-md-12 text-right">
                <a href="{{ route('admin.importers.index') }}" title="Volver" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>&nbsp;
                    Volver
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>&nbsp;
                    Validar Archivo
                </button>
            </div>
            {!! Form::close() !!}
        </div>      
    </div>
</div>
@endsection