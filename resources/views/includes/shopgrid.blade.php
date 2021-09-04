<div class="countBusqueda" style="display:none;">

@if($count>1)
<h1>Se encontraron {{$count}} productos</h1>
@else
<h1>Se encontro {{$count}} producto</h1>
@endif
</div>


<div class="row mtn-30">
     
                            @foreach($data as $producto)
                                                    <!-- Start Product Item -->
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="product-item">
                                    <div class="product-item__thumb">
                                        <!-- <a href="/producto/{{$producto->slug}}"> -->
                                      <a href="#" data-toggle="modal" data-id="{{$producto->slug}}" onclick='loadModal(this)' data-target="#basicModal" style="height: 300px;weight:300px;">
                                        @include('pages.product.partials')
                                                         </a>
                <br>
                                        <div class="ratting">
                                        @if(($producto->stock - $producto->stock_minimo) >= 1)
            <span class="badge stock-disponible product mb-4 ml-xl-0 ml-4">Disponible</span>
                                                   
            @endif

            @if( ($producto->stock <= $producto->stock_minimo ) && $producto->stock >0)
            <span class="badge stock-consultar product mb-4 ml-xl-0 ml-4">Consultar</span>
            @endif

            @if($producto->stock <=0)
            <span class="badge stock-nodisponible product mb-4 ml-xl-0 ml-4">No Disponible</span>
            @endif
       
                                         
                                        </div>
                                    </div>
                                    <div class="product-item__content">
                                        <div class="product-item__info text-center">
                                       <h5 class=""><strong>{{$producto->nombre}}</strong> - 
                                        {{$producto->marca->nombre}}</h5>                                         
                                         
                                    
                                            <span><strong>Codigo : </strong>{{$producto->codigo}}</span>
                                            @if(\Auth::check())
                                                @if(\Auth::user()->porcentaje_compra>0 || \Auth::user()->porcentaje_venta>0)   
                                                <h6 class="precioLista text-center"><p>${{number_format( $producto->precio,2, ',','.')}}<p></h6> 
                                                <h6 class="precioCompra text-center"><p >${{number_format($producto->precio- ($producto->precio* $porcentaje_compra   / 100),2, ',','.')}}<p></h6>  
                                                <h6 class="precioVenta text-center"><p >${{number_format($producto->precio- ($producto->precio* $porcentaje_compra  / 100)+( ($producto->precio - ($producto->precio* $porcentaje_compra  / 100)) * $porcentaje_venta  / 100),2, ',','.')}}<p></h5>    
                                                @else
                                                <h6 class="precioLista text-center"><p>${{number_format( $producto->precio,2, ',','.')}}<p></h6> 
                                                 @endif
                                                 @else
                                                <h6 class="precioLista text-center"><p>${{number_format( $producto->precio,2, ',','.')}}<p></h6> 
                                                 @endif

                                        </div>

                                        <div class="product-item__action">
                                        <button class="btn-add-to-cart" onclick="selectByName('{{$producto->slug}}');"><i class="ion-bag"></i></button>                                            
                                        </div>

                                        <div class="product-item__desc">
                                        <h6>Codigos equivalentes :</h6>
                                        <?php  
                                        foreach (explode(",", $producto->equivalencia) as $equi){
                                             echo '<a class="cod-link" href="#" onclick="f(&quot;'.$equi.'&quot;)">'.$equi.'</a> ';
                                        }
                                           
                                        ?>
                                        
                                            
                                        </div>
                                    </div>

                                    <!-- <div class="product-item__sale">
                                        <span class="sale-txt">25%</span>
                                    </div> -->
                                </div>
                            </div>
                            <!-- End Product Item -->
                            @endforeach
                            </div>     
        <!-- divs de cierre de tabla -->
                                   

                       <!-- abro links -->
                       </div>
                         </div> 
                    <div id="linksShopGrid" style="display:none;">   
                           
                        <div class="action-bar-inner mt-30">
                            <div class="row align-items-center">
                            <div class="col-sm-3">
                                    </div>
                                <div class="col-sm-6">
                                    <nav class="pagination-wrap mb-10 mb-sm-0">                                            
                                    {!! $data->links('includes.paginator') !!}                             
                                    </nav>
                                </div>                          
                            </div>
                        </div>
                    </div>
                    <!-- cierro links -->




                    