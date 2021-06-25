@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                Resultado del Proceso de la Actualización de Productos
            </h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    @if($proceso == 'OK')
                        <h3>Finalizo el proceso de actualización de Productos:</h3>
                        <ul>
                            <li>
                                El archivo contenia un total de {{$qRegistros}} registros.
                            </li>
                            <li>
                                Se actualizaron: {{$qActualizados}} Productos
                            </li>
                            <li>
                                Se agregaron: {{$nuevos}} Productos
                            </li>
                            <li>
                                El Proceso demoro: {{$demoro}} Segundos
                            </li>
                            <li>
                                Se encontraron {{count($errores)}} errores.
                                <ul>
                                    @foreach($errores as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    @else
                        <h3>Se produjo un error al intentar actualizar los Productos</h3>
                        <ul>
                            <li>
                                No se encontro el archivo necesario <strong>(productos.csv)</strong> para la actualización de Productos en el directorio <strong>/storage/csv/repo</strong>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin.importers.index')}}" title="Volver" class="btn btn-danger">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>&nbsp;
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection