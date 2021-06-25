@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
            <h4>Editar Permiso {{$permission->display_name}}</h4>
	</div>
	<div class="panel-body">
            <div class="container-fluid editPermisos">
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
                {!! Form::model($permission, ['route' => ['admin.permisos.update', $permission->id], 'method' => 'PUT'])!!}                
                @include('admin.permisos.partials.fields')                   
                <div class="row">
                    <div class="col-md-12" style="  text-align: right;">
                        <a href="{{ route('admin.permisos.index') }}" class="btn btn-danger">
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