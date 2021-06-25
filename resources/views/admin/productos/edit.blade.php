@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="row cabecera">
        <div class="col-md-10">
            <h4>Editar Producto</h4>
        </div>
        <div class="col-md-2">
            <a href="{{route('front.productos.show',[$producto->slug])}}" target="_blank" class="verFicha">
                Ver Ficha
            </a>
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
            {!! Form::model($producto, ['route' => ['admin.productos.update', $producto->id], 'method' => 'PUT', 'files' => 'true'])!!}                
            @include('admin.productos.partials.fieldsEdit')   
            <div class="row">
                <div class="col-md-12" style="  text-align: right;">
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;
                        Cancelar
                    </a>    
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>&nbsp;
                        Guardar</button>
                </div>
            </div>       
            {!! Form::hidden('productoId', $producto->id, array('id'=>'productoId')) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">

    $(document).ready(function () {

    });
    
</script>    
@endsection