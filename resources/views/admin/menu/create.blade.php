@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="row cabecera">
        <div class="col-md-8">
            <h4>
                Crear Menu
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
            {!! Form::open(['route' => 'admin.menus.store', 'method' => 'POST'])!!}                
            @include('admin.menu.partials.fields')
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
    $(document).ready(function () {

        $("#rol").on('change', function () {
            manejarComboJur();
        });
        manejarComboJur();

    });

    function manejarComboJur() {

        if ($("#rol").val() === '3') {
            $("#jurisdiccion").prop('disabled', false);
        } else {
            $("#jurisdiccion").prop('disabled', 'disabled');
        }

    }


</script>
@endsection