@extends('layouts.app')

@section('content')
<div class="panel panel-default usuarios">
    <div class="row cabecera">
        <div class="col-md-8">
            <h4>
                Listado de Usuarios
            </h4>  
        </div>    
        <div class="col-md-4">
            <a href="{{ route('admin.usuarios.create') }}" title="Crear Usuario" class="btn btn-success">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
                Crear Nuevo
            </a>
        </div>    
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-condensed table-striped">
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>							
                @foreach ($users as $user)
                <tr data-id="{{$user->id}}">				
                    <td>
                        {{$user->username}}
                    </td>
                    <td>
                        {{$user->apellido}} {{$user->nombre}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        <a href="{{route('admin.usuarios.edit', $user->id)}}" title="Editar Usuario" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;
                            Editar
                        </a> 
                        <a href="{{ action('App\Http\Controllers\Admin\UserController@editContraseña', $user->id) }}" title="Cambiar Contraseña" class="btn btn-info">
                             <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>&nbsp;
                            Cambiar Contraseña
                        </a>
                        <a href="#" title="Eliminar Usuario" class="btn btn-danger" data-toggle="confirmationEliminar">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;
                            Eliminar
                        </a>                              
                    </td>                                                
                </tr>								
                @endforeach
            </table>
        </div>
        {!! str_replace('/?', '?', $users->render()) !!}
    </div>
</div>

{!! Form::open(['action' => ['App\Http\Controllers\Admin\UserController@destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'delete-form'])!!}                
{!! Form::close() !!}

@include('commons.modalProcessing')

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
        var url = form.attr('action').replace(':USER_ID', id);
        var data = form.serialize();
      
        $("#modalProcessing #mensaje").html('Se esta eliminando el Usuario. <br />Por favor aguarde.');
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
            $('#modalError #mensaje').html('Se produjo un error al intentar eliminar al usuario');
            $('#modalError').modal();
        });

    }


</script>
@endsection