@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="row cabecera">
        <div class="col-md-12">
            <h4>
                Contactos
            </h4>    
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-condensed table-striped">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Fecha Alta</th>
                    <th>Acciones</th>
                </tr>							
                @foreach ($contactos as $contacto)
                <tr data-id="{{$contacto->id}}">				
                    <td>
                        {{$contacto->nombre}} {{$contacto->apellido}}
                    </td>               
                    <td>
                        {{$contacto->email}}
                    </td>   
                    <td>
                        {{$contacto->telefono}}
                    </td>                    
                    <td>
                        {{ date('d/m/Y', strtotime($contacto->created_at))}}
                    </td>                       
                    <td>
                        <a href="{{ route('admin.contactos.edit', $contacto->id) }}" title="Editar Contacto" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;
                            Editar
                        </a>
                        <a href="#" title="Eliminar Contacto" class="btn btn-danger" data-toggle="confirmationEliminar">
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
                {!! str_replace('/?', '?', $contactos->render()) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{route('admin.contactos.downloadFile')}}" class="btn btn-info">Descargar Listado</a>
            </div>
        </div>        
    </div>
</div>

{!! Form::open(['action' => ['Admin\ContactosController@destroy', ':CONTACTO_ID'], 'method' => 'DELETE', 'id' => 'delete-form'])!!}                
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
        var url = form.attr('action').replace(':CONTACTO_ID', id);
        var data = form.serialize();
        $("#modalProcessing #mensaje").html('Se esta eliminando el Contacto. <br />Por favor aguarde.');
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
            $('#modalError #mensaje').html('Se produjo un error al intentar eliminar al contacto');
            $('#modalError').modal();
        });

    }

</script>
@endsection