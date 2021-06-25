<div class="row mtn-30">
                            @foreach($data as $producto)
                              <!-- Start Product Item -->
                            <div class="col-sm-6 col-lg-4">
                                <div class="product-item">
                                    <div class="product-item__thumb">
                                        <a href="/producto/{{$producto->slug}}">
                                            <img class="thumb-primary" src="assets/img/product/product-6.png" alt="Product" />
                                            <img class="thumb-secondary" src="assets/img/product/product-7.png" alt="Product" />
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
                                            <h4 class="title"><a href="/producto/{{$producto->slug}}">{{$producto->codigo}}</a></h4>
                                            <!-- <span class="price"><strong>Price:</strong> $165.00</span> -->
                                            <h5 class="precioLista"><p>${{number_format( $producto->precio,2, ',','.')}}<p></h5> 
                            <h5 class="precioCompra"><p >${{number_format($producto->precio- ($producto->precio* Auth::user()->porcentaje_compra  / 100),2, ',','.')}}<p></h5>  
                            <h5 class="precioVenta"><p >${{number_format($producto->precio- ($producto->precio* Auth::user()->porcentaje_compra  / 100)+( ($producto->precio- ($producto->precio* Auth::user()->porcentaje_compra  / 100)) * Auth::user()->porcentaje_venta  / 100),2, ',','.')}}<p></h5>    



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
                          

                       