@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="row cabecera">
            <div class="col-md-8">
                <h4>
                    {{$productos->total()}}&nbsp;Productos
                </h4>
            </div>
            <div class="col-md-4">
                <a href="{{ route('admin.productos.create') }}" title="Crear Producto" class="btn btn-success">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
                    Nuevo Producto
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                {!! Form::model(Request::all(), ['route' => ['admin.productos.index'], 'method' => 'GET'])!!}
                <div class="col-md-2 form-group">
                    {!! Form::label('rubro', 'Rubro') !!}
                    <div class="sort-by-wrapper">  
                    {!! Form::select('rubro', ['0' => 'Todos']+$rubros, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-2 form-group">
                    {!! Form::label('marca', 'Marca') !!}
                    <div class="sort-by-wrapper">  
                    {!! Form::select('marca', ['0' => 'Todas']+$marcas, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-2 form-group">
                    {!! Form::label('nombre', 'Nombre Producto') !!}
                    {!! Form::text('nombre', null, array('class' => 'form-control')) !!}
                </div>
                <div class="col-md-2 form-group">
                    {!! Form::label('codigo', 'Codigo Producto') !!}
                    {!! Form::text('codigo', null, array('class' => 'form-control')) !!}
                </div>
                <div class="col-md-2 form-group">
                    {!! Form::label('activo', 'Estado Producto') !!}
                    <div class="sort-by-wrapper">  
                    {!! Form::select('activo', ['' => 'Todos', '1' => 'Activos', '0' => 'Inactivos'], null, ['class' => 'form-control']) !!}
</div>
                </div>
                <div class="col-md-2 form-group">
                    {!! Form::label('', '') !!}
                    <button type="submit" class="btn btn-success form-control">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;
                        Filtrar
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="table-responsive">
                <table class="table table-condensed table-striped">
                    <tr>
                        <th>Imagen</th>
                        <th>Codigo Prod</th>
                        <th>Nombre</th>
                        <th>Rubro</th>
                        <th>Marca</th>
                        <th style="text-align: right;">Precio</th>
                        <th style="text-align: right;">Acciones</th>
                    </tr>
                    @foreach ($productos as $producto)
                        <tr data-id="{{$producto->id}}">
                            <td>
                                @include('admin.productos.partials.image')
                            </td>
                            <td>
                                <a href="{{route('front.productos.show',[$producto->slug])}}" title="Ver Ficha"
                                   target="_blank">
                                    {{$producto->codigo}}
                                </a>
                            </td>
                            <td>
                                {{$producto->nombre}}
                            </td>
                            <td>
                                @if(isset($producto->rubro))
                                    {{$producto->rubro->nombre}}
                                @endif
                            </td>
                            <td>
                                {{$producto->marca->nombre}}
                            </td>
                            <td align="right">
                                ${{ number_format($producto->precio, 2, ',', '.') }}
                            </td>
                            <td align="right">
                                <a href="/admin/productos/edit/{{$producto->id}}" title="Editar Producto"
                                   class="btn btn-primary">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;
                                    Editar
                                </a>
                                <a href="#" title="Eliminar Producto" class="btn btn-danger"
                                   data-toggle="confirmationEliminar">
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
                    <div class="text-center">
                        {!! str_replace('/?', '?', $productos->appends(Request::only(['rubro','marca','nombre','codigo','activo']))->render()) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="{{route('admin.productos.downloadFile')}}" class="btn btn-info">Descargar Listado</a>
                </div>
            </div>
        </div>
    </div>

    {{ Form::open(['action' => ['App\Http\Controllers\Admin\ProductController@destroy', ':id'], 'method' => 'DELETE', 'id' => 'delete-form'])}}

    {{ Form::close() }}

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
  
            var url = form.attr('action').replace(':id', id);
          
            var data = form.serialize();
      
            $("#modalProcessing #mensaje").html('Se esta eliminando el Producto. <br />Por favor aguarde.');
            $('#modalProcessing').modal();
         
            $.post(url, data, function (result) {

                if (result.result !== "ERROR") {
                    row.fadeOut();
                    $('#modalProcessing').modal('hide');
                } else {
                    $('#modalProcessing').modal('hide');
                    $('#modalError #mensaje').html(result.message);
                    $('#modalError').modal();
                }
            }).fail(function () {
                $('#modalProcessing').modal('hide');
                $('#modalError #mensaje').html('Se produjo un error al intentar eliminar el Producto');
                $('#modalError').modal();
            });

        }

    </script>
@endsection