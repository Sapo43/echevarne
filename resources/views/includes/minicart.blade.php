
                               @if(isset($cart))
                                @foreach($cart as $producto)

                                <div class="mini-product">
                                        <div class="mini-product__thumb">
                                              @include('pages.product.partials')
                                        </div>
                                        <div class="mini-product__info">
                                            <h2 class="title">{{$producto->codigo}}</h2>

                                            <div class="mini-calculation">
                                                <p class="price">{{$producto->cantidad}} x <span>${{$producto->precio}}</span></p>
                                                <!-- <button class="remove-pro"><i class="ion-trash-b"></i></button> -->
                                                <a onclick="deleteFromCart('{{$producto->slug}}')" class="remove-pro"><i class="ion-trash-b"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                         