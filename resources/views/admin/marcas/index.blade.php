@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="row cabecera">
        <div class="col-md-8">
            <h4>
                Marcas ({{$marcas->total()}})
            </h4>    
        </div>    
        <div class="col-md-4">
            <a href="{{ route('admin.marcas.create') }}" title="Crear Marca" class="btn btn-success">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
                Crear Nueva Marca
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            {!! Form::model(Request::all(), ['route' => ['admin.marcas.index'], 'method' => 'GET'])!!}
            <div class="col-md-2 form-group">
                {!! Form::label('id', 'ID') !!}
                {!! Form::text('id', null, array('class' => 'form-control')) !!}
            </div>
            <div class="col-md-2 form-group">
                {!! Form::label('nombre', 'Nombre') !!}        
                {!! Form::text('nombre', null, array('class' => 'form-control')) !!}
            </div>       
            <div class="col-md-2 form-group">
                {!! Form::label('', '') !!}
                <button type="submit" class="btn btn-success form-control">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;
                    Filtrar
                </button>
            </div>
            {!! Form::close() !!}
        </div>          
        <div class="table-responsive">
            <table class="table table-condensed table-striped">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>							
                @foreach ($marcas as $marca)
                <tr data-id="{{$marca->id}}">		
                    <td>
                        {{$marca->id}}
                    </td>
                    <td>
                        {{$marca->nombre}}
                    </td>
                    <td>
                        <a href="{{ route('admin.marcas.edit', $marca->id) }}" title="Editar Marca" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;
                            Editar                        
                        </a>      
                        <a href="#" title="Eliminar Marca" class="btn btn-danger" data-toggle="confirmationEliminar">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;
                            Eliminar
                        </a>                            
                    </td>                                                
                </tr>								
                @endforeach
            </table>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {!! str_replace('/?', '?', $marcas->render()) !!}
            </div>            
        </div>        
    </div>
</div>

{!! Form::open(['action' => ['Admin\MarcasController@destroy', ':MARCA_ID'], 'method' => 'DELETE', 'id' => 'delete-form'])!!}                
{!! Form::close() !!}

@include('commons.modalProcessing');

@endsection
@section('scripts')
<script type="text/javascript">

    $(document).ready(function () {

        $('[data-toggle="confirmationEliminar"]').confirmation({
            btnOkLabel: 'Eliminar',
            btnCancelLabel: 'Cancelar',
            placement: 'left',
            onConfirm: function (event, element) {
                event.preventDefault();
                eliminar(element);
            }
        });
    });

    function eliminar(element) {

        var row = element.parents('tr');
        var id = row.data('id');
        var form = $("#delete-form");
        var url = form.attr('action').replace(':MARCA_ID', id);
        var data = form.serialize();
        $("#modalProcessing #mensaje").html('Se esta eliminando la Marca. <br />Por favor aguarde.');
        $('#modalProcessing').modal();

        $.post(url, data, function (data) {

            if (data.result !== "ERROR") {
                row.fadeOut();
                $('#modalProcessing').modal('hide');
            } else {
                $('#modalProcessing').modal('hide');
                $('#modalError #mensaje').html(data.message);
                $('#modalError').modal();
            }
        }).fail(function () {
            $('#modalProcessing').modal('hide');
            $('#modalError #mensaje').html('Se produjo un error al intentar eliminar la Marca');
            $('#modalError').modal();
        });

    }

</script>
@endsection