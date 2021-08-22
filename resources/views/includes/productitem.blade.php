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
                                       
                                             <h5 class=""><strong>{{ucfirst(strtolower($producto->nombre))}}</strong> -  {{ucfirst(strtolower($producto->marca->nombre))}}</h5>                                         
                                         
                                    
                                            <span><strong>Codigo : </strong>{{$producto->codigo}}</span>
                                         
                                            <h6 class="precioLista text-center"><p>${{number_format( $producto->precio,2, ',','.')}}<p></h6> 
                        

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
                     