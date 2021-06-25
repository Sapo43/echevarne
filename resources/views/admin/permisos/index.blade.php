@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="row cabecera">
        <div class="col-md-8">
            <h4>
                Listado de Permisos
            </h4>   
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.permisos.create') }}" title="Crear Permiso" class="btn btn-success">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
                Crear Nuevo
            </a>      
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                {!! Form::model(Request::all(), ['route' => ['admin.permisos.index'], 'method' => 'GET'])!!}
                <div class="col-md-2 form-group">
                    {!! Form::label('grupo', 'Grupo') !!}        
                    {!! Form::select('grupo', ['0' => 'Todos'] + $grupos , null, ['class' => 'form-control']) !!}
                </div>  
                <div class="col-md-2 form-group">
                    {!! Form::label('', '') !!}
                    <button type="submit" class="btn btn-success form-control btnFiltro tlp" title="Filtrar Listado">
                        <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>&nbsp;
                        Filtrar
                    </button>
                </div>
                {!! Form::close() !!}                
            </div>
        </div>        
        <div class="table-responsive">
            <table class="table table-condensed table-striped">
                <tr>
                    <th>Grupo</th>
                    <th>Nombre</th>
                    <th>Nombre Administrativo</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>							
                @foreach ($permissions as $permission)
                <tr>
                    <td>
                        {{$permission->grupo}}
                    </td>                        
                    <td>
                        {{$permission->name}}
                    </td>
                    <td>
                        {{$permission->display_name}}
                    </td>
                    <td>
                        {{$permission->description}}
                    </td>
                    <td>                                            
                        <a href="{{ route('admin.permisos.edit', $permission->id) }}" title="Editar Permiso" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;
                            Editar
                        </a>
                        <a href="{{ route('admin.permisos.destroy', $permission->id) }}" title="Eliminar Permiso" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;
                            Eliminar
                        </a>
                    </td>                                                
                </tr>								
                @endforeach
            </table>
        </div>
        <div class="row">
            <div class="col-md-12">

            </div>            
        </div>
    </div>
</div>
@endsection