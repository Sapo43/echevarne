
<div class="sidebar-item">
                            <h4 class="sidebar-title">Busqueda Reciente</h4>
                            <div class="sidebar-body">
                             @if(isset($products))
                             @foreach($products as $producto)
                             <div class="sidebar-product">
                                    <a href="single-product.html" class="image">
                                    @include('pages.product.partials')    

                                    </a>
                                    <div class="content">
                                    <?php echo '<a class="cod-link" href="#" onclick="f(&quot;'.$producto->codigo.'&quot;)">'.$producto->codigo.'</a> '; ?>
                                        <span class="price">$ {{$producto->precio}}</span>
                                        <!-- <div class="ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </div> -->
                                    </div>
                                </div>
@endforeach
                             @endif

                               

                            </div>
                        </div>
                        <br>