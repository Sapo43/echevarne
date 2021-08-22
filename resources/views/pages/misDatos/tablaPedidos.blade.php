<table class="table "> 
    <thead>
                    <th> Orden</th>
                     <th>Fecha</th>                     
                     <th>Notas</th>
                     <th>Productos</th>
                     <th>Total</th>
                     <th>Estado del pedido</th>
                     <th>&nbsp;</th>
                     </thead>


<tbody>
@foreach($pedidos as $index =>$pedido)
    
           <tr>
           
             <!-- <td>  {{$pedido->id}}</td> -->
             <td>{{$index+1}}</td>
               
             <td>{{ date('d-m', strtotime($pedido->created_at)) }}</td>
             <td>   {{$pedido->notas}}</td>    
            
             
         
              
             <td>    {{$pedido->total_cantidad}}</td>
            
             <td>$ {{number_format( $pedido->total_monto,2, ',','.')}}</td>           
             <td>   {{$pedido->estado}}</td>     
             <td>   
                   
                    
                    </td>      
                    </tr>
                         
@endforeach
</tbody>
</table>

            <div class="col-sm-12 col-md-12">
                <div class="text-center">
                {{$pedidos->links('includes.paginator')}}
                </div>
            </div>