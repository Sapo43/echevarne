@extends('layouts.app')



@section('content')
    <div class="panel panel-default">
        <div class="row cabecera">
            <div class="col-md-8">
                <h4>
            
                    &nbsp;Detalle del pedido de : {{$pedido->apellido}} por un monto de :
                               $ {{$pedido ->total_monto}} del 
                      
                </h4>
            </div>
           
        </div>
        <div class="panel-body">
            
            <div class="table-responsive">
                <table class="table table-condensed table-striped">
                    <tr>
                        
                        <th>Producto</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Rubro</th>
                        <th>Cant </th>
               
                        
                     
                        
                       
                    </tr>
                    @foreach ($detalles as $detalle)
                       
                            
                            <td>
                                {{$detalle->codigo}}
                            </td>
                            <td>{{$detalle->nombre}}</td>
                            <td>    
                            {{$detalle->marca}}
                            </td>
                            <td>
                            {{$detalle->rubro}}
                            </td>
                            <td>
                                {{$detalle->cantidad}}
                            </td>
                       
                           
                           
                        </tr>
                    @endforeach
                </table>
                <div class="row">
           <div class="col-md-9">
           </div>
           <div class="col-md-3">
                <select class="form-control" id="estadoSelect" name="estadoSelect" >
                            <option value="" selected>{{$pedido->estado}}</option>
       @foreach ($status as $stat)                                     
            <option value="{{$stat->id}}">{{$stat->estado}}</option>
       @endforeach
 </select>
 </div>
 </div>      




                    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script>
$('#estadoSelect').change(function () {
    var type = document.getElementById("estadoSelect");      
        var idStatus = type.options[type.selectedIndex].value;
    var idPedido='{{$pedido->id}}'

    $.ajax({
        type: 'post',
        url: '/admin/pedidos/status',
       data:{   "_token": "{{ csrf_token() }}",
           idPedido:idPedido,
            idStatus:idStatus
       },
        success: function (data) {
          window.location=data.redirect
        }
    })
}
)

</script>
@endsection
