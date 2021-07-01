@extends('layouts.app')
@section('styles')
    {{ HTML::style('assetsAdmin/css/jquery-ui.min.css') }}
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="panel panel-default">
        <div class="row cabecera">
            <div class="col-md-8">
                <h4>
                    Novedades
                </h4>
            </div>
            <div class="col-md-4">
                <a href="{{ route('admin.novedades.create') }}" title="Crear Novedad" class="btn btn-success">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
                    Cargar Nueva Novedad
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-condensed table-striped">
                    <tr>
                        <th>Ordenar</th>
                        <th>Titulo</th>
                        <th>subtitulo</th>
                        <th>Imagen</th>
                        <th>Visible</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($novedades as $novedad)
                        <tr data-id="{{$novedad->id}}">
                            <td style="vertical-align:middle;">
                                <a class="handle" id="item-{{$novedad->id}}">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;
                                </a>
                            </td>
                            <td>
                                @if($novedad->es_producto != 1)
                                    <a href="{{route('front.novedad.show',[$novedad->f_url])}}"
                                       title="{{$novedad->titulo}}" target="_blank">
                                        @else
                                            <a href="{{$novedad->f_url}}" title="{{$novedad->titulo}}" target="_blank">
                                                @endif
                                                {{$novedad->titulo}}
                                            </a>
                            </td>
                            <td>
                            {{ substr(strip_tags($novedad->subtitulo), 0, 100) }}
                               
                            </td>
                            <td>
                                {!! HTML::image($novedad->imagen, $novedad->titulo, array('width'=>'100px')) !!}
                            </td>
                            <td>
                                @if($novedad->visible == 1)
                                    Si
                                @else
                                    No
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.novedades.edit', $novedad->id) }}" title="Editar Novedad"
                                   class="btn btn-primary">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;
                                    Editar
                                </a>
                                <a href="#" title="Eliminar Novedad" class="btn btn-danger"
                                   data-toggle="confirmationEliminar">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;
                                    Eliminar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {!! str_replace('/?', '?', $novedades->render()) !!}
        </div>
    </div>

    {!! Form::open(['action' => ['App\Http\Controllers\Admin\NovedadesController@destroy', ':NOVEDAD_ID'], 'method' => 'DELETE', 'id' => 'delete-form'])!!}
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
            var url = form.attr('action').replace(':NOVEDAD_ID', id);
            var data = form.serialize();
            $("#modalProcessing #mensaje").html('Se esta eliminando la Novedad. <br />Por favor aguarde.');
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
                $('#modalError #mensaje').html('Se produjo un error al intentar eliminar la novedad');
                $('#modalError').modal();
            });

        }

        function ordenable() {

            $('table tbody').sortable().bind('sortupdate', function (e, ui) {

                var order = $("table tbody tr").map(function () {
                    return $(this).data("id");
                }).get();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.novedades.reposition') }}",
                    dataType: "json",
                    data: {order: order},
                    success: function (order) {
                        console.log(order)
                    }
                });
            });
        }

    </script>
@endsection