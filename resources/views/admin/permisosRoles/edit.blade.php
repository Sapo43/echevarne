@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="row cabecera">
        <div class="col-md-8">
            <h4>
                Editar Permisos para el Rol <strong>{{$role->display_name}}</strong>
            </h4>  
        </div>      
    </div>       
    <div class="panel-body">
        <div class="container-fluid editPermisosRoles">
            <div class="row">                      
                <div class="col-md-12">
                    @if($errors->any())
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <span style="text-transform: capitalize;">&nbsp;{{$error}}</span>
                    </div>              
                    @endforeach
                    @endif
                </div>
            </div>                
            {!! Form::model($role, ['route' => ['admin.permisosRoles.update', $role->id], 'method' => 'PUT', 'class' => 'form-inline'])!!}                
            @include('admin.permisosRoles.partials.fields')  
            <div class="row">
                <div class="col-md-12" style="  text-align: right;">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;
                        Cancelar
                    </a>    
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>&nbsp;
                        Guardar</button>
                </div>
            </div>                    
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

    $.each({!!$permisosRol!!}, function(index, value) {
    $("input:checkbox[name='perm_" + value.id + "']").prop('checked', true);
    });
            });
</script>
@endsection