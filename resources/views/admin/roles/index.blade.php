@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="row cabecera">
        <div class="col-md-8">
            <h4>
                Listado de Roles
            </h4>  
        </div>    
        <div class="col-md-4">
            <a href="{{ route('admin.roles.create') }}" title="Crear Rol" class="btn btn-success">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
                Crear Nuevo
            </a>
        </div>    
    </div>    
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-condensed table-striped">
                <tr>
                    <th>Nombre</th>
                    <th>Nombre Administrativo</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>							
                @foreach ($roles as $rol)
                <tr>
                    <td>
                        {{$rol->name}}
                    </td>
                    <td>
                        {{$rol->display_name}}
                    </td>
                    <td>
                        {{$rol->description}}
                    </td>
                    <td>                                            
                        <a href="{{ route('admin.roles.edit', $rol->id) }}" title="Editar Rol" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;
                            Editar
                        </a>
                        <a href="{{ route('admin.roles.destroy', $rol->id) }}" title="Eliminar Rol" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;
                            Eliminar
                        </a>
                    </td>                                                
                </tr>								
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection