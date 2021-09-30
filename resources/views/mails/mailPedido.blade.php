<img  src="http://echevarnehnos.com/assets/img/logo_completo.png" height="100px" width="300px">

<h1>¡Tu orden de pedido fue generada! </h1>

<h3> {{$usuario}}</h3>
<h6>Debajo podés ver el detalle de tu pedido:</h6>
<br>



         
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
     
 
 </div>
    <br>
<p>Te enviaremos tu pedido una vez que recibamos la confirmación de la venta por parte del medio de pago. Si no realizaste este pedido o simplemente estabas probando nuestro sitio, por favor desestimá este e-mail.  </p>