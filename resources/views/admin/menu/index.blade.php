@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="row cabecera">
        <div class="col-md-8">
            <h4>
                Menu
            </h4>  
        </div>    
        <div class="col-md-4">
            <a href="{{ route('admin.menus.create') }}" title="Crear Menu" class="btn btn-success">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
                Crear Nuevo
            </a>
        </div>    
    </div>
    <div class="panel-body menusView">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-hover">
                        <tr style="background-color:#8CCDFF">
                            <th colspan="2">Nombre</th>
                            <th>tipo</th>
                            <th>url</th>
                            <th>Acciones</th>
                        </tr>                    
                        @foreach ($menu as $m => $menuItem)                           
                        <tr data-id="{{$menuItem[0]->id}}">	
                            <td colspan="2">
                                <strong>{{$menuItem[0]->nombre}}</strong>
                            </td>
                            <td>
                                {{$menuItem[0]->url_type}}
                            </td>
                            <td>
                                {{$menuItem[0]->url}}
                            </td>  
                            <td>
                                <a href="{{route('admin.menus.edit', $menuItem[0]->id)}}" title="Editar menu {{$menuItem[0]->nombre}}" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;
                                    Editar
                                </a>
                                <a href="{{action('Admin\MenuController@permisosEdit', $menuItem[0]->id)}}" title="Permisos para el menu {{$menuItem[0]->nombre}}" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;
                                    Permisos
                                </a>   
                                @if(count($menuItem[1]) === 0)  
                                    <a href="#" title="Eliminar Menú" class="btn btn-danger" data-toggle="confirmationEliminar">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;
                                        Eliminar
                                    </a>                          
                                @endif
                            </td>
                        </tr>    
                        @if(count($menuItem[1]) > 0)                             
                        @foreach ($menuItem[1] as $subMenuItem)  
                         <tr data-id="{{$subMenuItem->id}}">	
                            <td></td>
                            <td>
                                {{$subMenuItem->nombre}}
                            </td> 
                            <td>
                                {{$subMenuItem->url_type}}
                            </td> 
                            <td>
                                {{$subMenuItem->url}}
                            </td> 
                            <td>
                                <a href="{{route('admin.menus.edit', $subMenuItem->id)}}" title="Editar menu {{$subMenuItem->nombre}}" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;
                                    Editar
                                </a>
                                <a href="{{action('Admin\MenuController@permisosEdit', $subMenuItem->id)}}" title="Permisos para el menu {{$subMenuItem->nombre}}" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;
                                    Permisos
                                </a>         
                                <a href="#" title="Eliminar Menú" class="btn btn-danger" data-toggle="confirmationEliminar">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;
                                    Eliminar
                                </a>                                
                            </td>
                        </tr>
                        @endforeach
                        @endif       
                        </tr>                             
                        @endforeach       
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

{!! Form::open(['action' => ['Admin\MenuController@destroy', ':MENU_ID'], 'method' => 'DELETE', 'id' => 'delete-form'])!!}                
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
        var url = form.attr('action').replace(':MENU_ID', id);
        var data = form.serialize();
        $("#modalProcessing #mensaje").html('Se esta eliminando el Menú. <br />Por favor aguarde.');
        $('#modalProcessing').modal();

        $.post(url, data, function (data) {

            if (data.result === "OK") {
                row.fadeOut();
                $('#modalProcessing').modal('hide');
            } else if (data.result === "ERROR") {
                $('#modalProcessing').modal('hide');
                $('#modalError #mensaje').html(data.mensaje);
                $('#modalError').modal();
            } else {
                $('#modalProcessing').modal('hide');
                $('#modalError #mensaje').html('Se produjo un error al intentar eliminar al Menú. Por favor contacte al Administrador');
                $('#modalError').modal();
            }
        }).fail(function () {
            $('#modalProcessing').modal('hide');
            $('#modalError #mensaje').html('Se produjo un error al intentar eliminar al Menú. Por favor contacte al Administrador');
            $('#modalError').modal();
        });

    }

</script>
@endsection