@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 style="margin:0;display:inline;">
                Actualizar Productos
            </h4>
        </div>
        <div class="panel-body">
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend style="color:red;font-size: 20px;font-weight: bold;">Atención</legend>
                        <div class="alert alert-danger" role="alert">
                            <p style="text-align: center">
                                Antes de hacer click en el boton por favor verifique que el archivo
                                <strong>productos.csv</strong> exista dentro de la carpeta
                                <strong>/storage/csv/repo</strong><br>
                                El archivo debe contener los siguientes campos separados por punto y coma
                                <strong>(;)</strong> y manteniendo el orden indicado<br><br>
                                <strong>'codigo';'nombre';'cod_barra';'precio';'iva';'rubro_id';'univen';'cod_origen';'marca_id';'activo';'detmarca';'detrubro';'actualizado';'stock';'stock_minimo'</strong>
                                <br><br>
                                <strong>El archivo no debe contener encabezado</strong>
                            </p>
                            <br>
                            <p>
                                El proceso recorrera el archivo  y realizara las siguientes acciones:
                            </p>
                            <ul>
                                <li>Si el código del producto <strong>EXISTE</strong> en la base de datos actualizara el
                                    resto de los campos con los campos existentes en el archivo
                                </li>
                                <li>Si el código del producto <strong>NO EXISTE</strong> en la base de datos, creara un
                                    nuevo producto con ese código.
                                </li>
                            </ul>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-12 text-right">
                    <a href="{{route('admin.update.productos')}}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-import" aria-hidden="true"></span>&nbsp;
                        Actualizar Productos
                    </a>
                </div>
            </div>
        <!--div class="row">
            <div class="col-md-2">
                <a href="{{route('admin.importers.rubros')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-import" aria-hidden="true"></span>&nbsp;
                    Importar Rubros
                </a>
            </div>
            <div class="col-md-2">
                <a href="{{route('admin.importers.marcas')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-import" aria-hidden="true"></span>&nbsp;
                    Importar Marcas
                </a>
            </div>            
            <div class="col-md-2">
                <a href="{{route('admin.importers.productos')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-import" aria-hidden="true"></span>&nbsp;
                    Importar Productos
                </a>
            </div>              
        </div-->
        </div>
    </div>
@endsection