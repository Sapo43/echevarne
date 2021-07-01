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
        @if(count($rowsError) > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;&nbsp;
                    Se encontraron <strong>{{count($rowsError)}}</strong> errores en el archivo de Rubros
                    <a href="javascript:detalle('erroresContainer')">Ver Detalle</a>
                </div>                    
                <div id="erroresContainer" style="display:none;">
                    @foreach ($rowsError as $row)
                    <div class="col-md-12 pre">
                        {{trim($row)}}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif    
        @if(count($rowsOk) > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;&nbsp;
                    Se van a importar <strong>{{count($rowsOk)}}</strong> Rubros.
                </div>                    
            </div>
        </div>        
        @endif           
        <div class="row">
            <div class="col-md-12 text-right">
                {!! Form::open(['action' => 'App\Http\Controllers\Admin\Importers\ImporterRubrosController@importar', 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                {!! Form::hidden('archivo', $filename, array('id'=>'archivo')) !!}
                <a href="{{route('admin.importers.rubros')}}" title="Volver" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>&nbsp;
                    Volver
                </a>
                @if(count($rowsError) == 0)
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-import" aria-hidden="true"></span>&nbsp;
                    Importar Archivo
                </button>
                @endif
                {!! Form::close() !!}    
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function detalle(id) {
        $("#" + id).toggle();
    }
</script>
@endsection