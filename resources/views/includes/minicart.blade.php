
                               @if(isset($cart))
                                @foreach($cart as $producto)

                                <div class="mini-product">
                                        <div class="mini-product__thumb">
                                            <a href="single-product.html">  @include('pages.product.partials')</a>
                                        </div>
                                        <div class="mini-product__info">
                                            <h2 class="title"><a href="single-product.html">{{$producto->codigo}}</a></h2>

                                            <div class="mini-calculation">
                                                <p class="price">{{$producto->cantidad}} x <span>${{$producto->precio}}</span></p>
                                                <!-- <button class="remove-pro"><i class="ion-trash-b"></i></button> -->
                                                <a onclick="deleteFromCart('{{$producto->slug}}')" class="remove-pro"><i class="ion-trash-b"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                         