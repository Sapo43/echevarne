<div class="row mtn-30">
                            @foreach($data as $producto)
                              <!-- Start Product Item -->
                            <div class="col-sm-6 col-lg-4">
                                <div class="product-item">
                                    <div class="product-item__thumb">
                                        <!-- <a href="/producto/{{$producto->slug}}"> -->
                                      <a href="#" data-toggle="modal" data-id="{{$producto->slug}}" onclick='loadModal(this)' data-target="#basicModal">
                                        @include('pages.product.partials')
                                           
                                        </a>

                                        <div class="ratting">
                                            <span><i class="ion-android-star"></i></span>
                                            <span><i class="ion-android-star"></i></span>
                                            <span><i class="ion-android-star"></i></span>
                                            <span><i class="ion-android-star"></i></span>
                                            <span><i class="ion-android-star-half"></i></span>
                                        </div>
                                    </div>

                                    <div class="product-item__content">
                                        <div class="product-item__info">
                                       
                                            <!-- <h4 class="title"><a href="/producto/{{$producto->slug}}">{{$producto->codigo}}</a></h4> -->
                                            
                                            <span><strong>{{$producto->nombre}}</strong></span>
                                            <br>
                                            <span><strong>COD: </strong>{{$producto->codigo}}</span>
                                          @if(\Auth::check())  
                                            <h5 class="precioLista"><p>${{number_format( $producto->precio,2, ',','.')}}<p></h5> 
                            <h5 class="precioCompra"><p >${{number_format($producto->precio- ($porcentaje_compra   / 100),2, ',','.')}}<p></h5>  
                            <h5 class="precioVenta"><p >${{number_format($producto->precio- ($porcentaje_compra  / 100)+( ($producto->precio- ($producto->precio* $porcentaje_compra  / 100)) * $porcentaje_venta  / 100),2, ',','.')}}<p></h5>    
                                    @else
                                    <h5 class="precioLista"><p>${{number_format( $producto->precio,2, ',','.')}}<p></h5> 
                                    @endif

                                        </div>

                                        <div class="product-item__action">
                                            <button class="btn-add-to-cart"><i class="ion-bag"></i></button>
                                            <button class="btn-add-to-cart"><i class="ion-ios-loop-strong"></i></button>
                                            <button class="btn-add-to-cart"><i class="ion-ios-heart-outline"></i></button>
                                            <button class="btn-add-to-cart"><i class="ion-eye"></i></button>
                                        </div>

                                        <div class="product-item__desc">
                                            <p>Pursue pleasure rationally encounter consequences that are extremely painful.
                                                Nor
                                                again is there anyone who loves or pursues or desires to obtain pain of
                                                itself,
                                                because it is pain, but because occasionally circles</p>
                                        </div>
                                    </div>

                                    <div class="product-item__sale">
                                        <span class="sale-txt">25%</span>
                                    </div>
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
                                <div class="col-sm-6">
                                    <nav class="pagination-wrap mb-10 mb-sm-0">                                            
                                    {!! $data->links('includes.paginator') !!}                             
                                    </nav>
                                </div>                          
                            </div>
                        </div>
                    </div>
                    <!-- cierro links -->