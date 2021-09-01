@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="row cabecera">
            <div class="col-md-8">
                <h4>
                    &nbsp;Pedidos
                </h4>
            </div>
           
        </div>
        <div class="panel-body">
            
            <div class="table-responsive">
                <table class="table table-condensed table-striped">
                    <tr>
                        <th>Fecha</th>
                        <th>Usuario</th>
                      
                        <th>Apellido</th>
                        <th>Total</th>
                        <th>Cant Productos</th>
                        <th>Notas</th>
                        <th>Status</th>                        
                        <th>Acciones</th>
                    </tr>
                    @foreach ($pedidos as $pedido)
                       
                            <td>
                            {{$pedido->created_at}}
                                
                            </td>
                            <td>
                            {{$pedido->nro_cliente}} -  {{$pedido->apellido}}   {{$pedido->nombre}}
                            </td>
                           
                            
                            <td>
                            {{$pedido->total_monto}}
                            </td>
                            <td>
                                {{$pedido->total_cantidad}}
                            </td>
                            <td>
    {{$pedido->notas}}

                            </td>
                            <td>
               
                                {{$pedido->estado}}
                            </td>
                            <td >
                                <a href="{{ route('admin.pedidos.detalle', $pedido->id) }}" title="Editar Producto"
                                   class="btn btn-primary">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;
                                    Detalle
                            
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
                {{$pedidos->links()}}

@endsection
