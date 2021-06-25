@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>
            Resultado de la Importación de Equivalencias
        </h4>    
    </div>
    <div class="panel-body">
        @if($rowsError > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;&nbsp;
                    Se encontraron <strong>{{$rowsError}}</strong> errores en el archivo de Equivalencias
                </div>                    
            </div>
        </div>        
        @endif
        @if($equivalenciasOk > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;&nbsp;
                    Se Importaron <strong>{{$equivalenciasOk}}</strong> Equivalencias con exito.
                </div>                    
            </div>
        </div>        
        @endif        
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('admin.importers.index')}}" title="Volver" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>&nbsp;
                    Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection