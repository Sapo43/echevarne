@extends('layouts.app')
@section('styles')
    {{ HTML::style('css/jquery-ui.min.css') }}
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="panel panel-default">
        <div class="row cabecera">
            <div class="col-md-8">
                <h4>
                    Descargas
                </h4>
            </div>
            <div class="col-md-4">
                <a href="{{ route('admin.descargas.create') }}" title="Crear Descarga" class="btn btn-success">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
                    Crear Nueva Descarga
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-condensed table-striped">
                    <tr>
                        <th>Ordenar</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Tipo Archivo</th>
                        <th>Tamaño</th>
                        <th>Versión</th>
                        <th>Visible</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($descargas as $descarga)
                        <tr data-id="{{$descarga->id}}">
                            <td style="vertical-align:middle;">
                                <a class="handle" id="item-{{$descarga->id}}">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;
                                </a>
                            </td>
                            <td>
                                <a href="{{url('file/'.$descarga->archivo)}}" title="Ver" target="_blank">
                                    {!! HTML::image($descarga->imagen, $descarga->nombre, array('width'=>'100px')) !!}
                                </a>
                            </td>
                            <td>
                                {{$descarga->nombre}}
                            </td>
                            <td>
                                {{$descarga->tipo_archivo}}
                            </td>
                            <td>
                                {{$descarga->peso}}
                            </td>
                            <td>
                                {{$descarga->version}}
                            </td>
                            <td>
                                @if($descarga->visible == 1)
                                    Si
                                @else
                                    No
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.descargas.edit', $descarga->id) }}" title="Editar Descarga"
                                   class="btn btn-primary">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;
                                    Editar
                                </a>
                                <a href="#" title="Eliminar Descarga" class="btn btn-danger"
                                   data-toggle="confirmationEliminar">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;
                                    Eliminar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {!! str_replace('/?', '?', $descargas->render()) !!}
        </div>
    </div>

    {!! Form::open(['action' => ['App\Http\Controllers\Admin\DescargasController@destroy', ':DESCARGA_ID'], 'method' => 'DELETE', 'id' => 'delete-form'])!!}
    {!! Form::close() !!}

    @include('commons.modalProcessing');

@endsection
@section('scripts')
    {!! HTML::script('assetsAdmin/js/jquery-ui.min.js?v=2') !!}
    <script type="text/javascript">

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            ordenable();
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
            var url = form.attr('action').replace(':DESCARGA_ID', id);
            var data = form.serialize();
            $("#modalProcessing #mensaje").html('Se esta eliminando la Descarga. <br />Por favor aguarde.');
            $('#modalProcessing').modal();

            $.post(url, data, function (data) {
                if (data.result !== "ERROR") {
                    row.fadeOut();
                    $('#modalProcessing').modal('hide');
                } else {
                    $('#modalProcessing').modal('hide');
                    $('#modalError #mensaje').html(data.message);
                    $('#modalError').modal();
                }
            }).fail(function () {
                $('#modalProcessing').modal('hide');
                $('#modalError #mensaje').html('Se produjo un error al intentar eliminar la descarga');
                $('#modalError').modal();
            });

        }

        function ordenable() {

            $('table tbody').sortable().bind('sortupdate', function(e, ui) {

                var order = $("table tbody tr").map(function(){
                    return $(this).data("id");
                }).get();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.descargas.reposition') }}",
                    dataType: "json",
                    data: {order: order},
                    success: function(order){
                        console.log(order)
                    }
                });
            });
        }

    </script>
@endsection