@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="row cabecera">
        <div class="col-md-8">
            <h4>
                Permisos para ver el Menu: {{$menu->nombre}}
            </h4>  
        </div>      
    </div>         
    <div class="panel-body">
        <div class="container-fluid">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert" style="text-align:center;">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;&nbsp;
                        Estos permisos solo hacen referencia a la visualización de los Menus!
                        Los permisos para acceder a las funcionalidades por Roles deben editarse desde 
                        <strong><a href="{{route('admin.roles.index')}}">aquí</a></strong>
                    </div>
                    <div class="alert alert-info" role="alert" style="text-align:center;">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;&nbsp;
                        Para ver los cambios reflejados es necesario <strong>volver a iniciar la sesión</strong>.    
                    </div>                    
                </div>
            </div>
            {!! Form::model($rolesM, ['action' => ['Admin\MenuController@permisosUpdate', $menu->id], 'method' => 'PUT'])!!}                                
            <div class="row">
                <div class="col-md-6">
                    <h4>Roles <span style="font-size:12px;font-style:italic;">[que pueden ver el Menu]</span></h4>                    
                </div>
                <div class="col-md-6">
                    <h4>Usuarios <span style="font-size:12px;font-style:italic;">[que <strong>no</strong> puede ver el Menu]</span></h4>                    
                </div>                
            </div>
            <div class="row">
                <div class="col-md-6">
                    @foreach ($roles as $key => $rol)
                    <div class="row">
                        <div class="col-md-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    {!! Form::checkbox('rolesM[]', $key, in_array($key,$rolesM)) !!}                                            
                                </div>
                                <div class="form-control">
                                    {!! Form::label($key, $rol) !!}
                                </div>
                            </div>                
                        </div>
                    </div>
                    @endforeach                    
                </div>
                <div class="col-md-6">
                    @foreach ($users as $key => $user)
                    <div class="row usersRol" data-rolid="{{$user->roles->first()->id}}">
                        <div class="col-md-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    {!! Form::checkbox('usersM[]', $user->id, in_array($user->id,$usersM)) !!}                                            
                                </div>
                                <div class="form-control">
                                    {!! Form::label($key, $user->nombre.' '.$user->apellido.' [ '.$user->username.' ] ') !!}
                                </div>
                            </div>                
                        </div>
                    </div>
                    @endforeach                      
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="  text-align: right;">
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;
                        Cancelar
                    </a>    
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>&nbsp;
                        Guardar
                    </button>
                </div>
            </div>                    
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(".usersRol").hide();
    $(document).ready(function () {
        $('input:checkbox[name="rolesM[]"]:checked').each(function (index) {
            $(".usersRol[data-rolid=" + $(this).val() + "]").show();
        });
        $('input:checkbox[name="rolesM[]"]').on('change', function (element) {
            showHideUsers($(this).val());
        });
    });

    function showHideUsers(rolId) {
        if ($('input:checkbox[name="rolesM[]"][value="' + rolId + '"]').is(':checked')) {
            $(".usersRol[data-rolid=" + rolId + "]").show();
        } else {
            $(".usersRol[data-rolid=" + rolId + "]").hide();
        }
    }
</script>
@endsection