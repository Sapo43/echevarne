@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="row cabecera">
        <div class="col-md-8">
            <h4>
                Rubros ({{$rubros->total()}})
            </h4>    
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.rubros.create') }}" title="Crear Rubro" class="btn btn-success">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
                Nuevo Rubro
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            {!! Form::model(Request::all(), ['route' => ['admin.rubros.index'], 'method' => 'GET'])!!}
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
                @foreach ($rubros as $rubro)
                <tr data-id="{{$rubro->id}}">				
                    <td>
                        {{$rubro->id}}
                    </td>                    
                    <td>
                        {{$rubro->nombre}}
                    </td>                 
                    <td>
                        <a href="{{ route('admin.rubros.edit', $rubro->id) }}" title="Editar Rubro" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;
                            Editar
                        </a>
                        <a href="#" title="Eliminar Rubro" class="btn btn-danger" data-toggle="confirmationEliminar">
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
                {!! str_replace('/?', '?', $rubros->render()) !!}                
            </div>
        </div>        
    </div>
</div>

{!! Form::open(['action' => ['Admin\RubrosController@destroy', ':RUBRO_ID'], 'method' => 'DELETE', 'id' => 'delete-form'])!!}                
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
        var url = form.attr('action').replace(':RUBRO_ID', id);
        var data = form.serialize();
        $("#modalProcessing #mensaje").html('Se esta eliminando el Rubro. <br />Por favor aguarde.');
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
            $('#modalError #mensaje').html('Se produjo un error al intentar eliminar el Rubro');
            $('#modalError').modal();
        });

    }

</script>
@endsection