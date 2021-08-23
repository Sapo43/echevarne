<div class="page-content-wrapper sp-y">
        <div class="product-details-page-content">
            <div class="container container-wide">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                        
                            <!-- Start Product Thumbnail Area -->
                            <div class="col-md-5">
                                <div class="product-thumb-area">
                                    <div class="product-details-thumbnail">
                                        <div class="product-thumbnail-slider" id="thumb-gallery">
                                          
                                                @include('pages.product.partials')
                                            
                                         
                                          
                                       
                                        </div>

                                        <a href="#thumb-gallery" class="btn-large-view btn-gallery-popup">View Larger <i class="fa fa-search-plus"></i></a>
                                    </div>

                                    <div class="product-details-thumbnail-nav">
                                         
                                      
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Thumbnail Area -->

                            <!-- Start Product Info Area -->
                            <div class="col-md-7">
                                <div class="product-details-info-content-wrap">
                                    <div class="prod-details-info-content">
                                        <h2>{{$producto->nombre}}</h2>
                                        <h4 class="price"><strong>Codigo:</strong> <span>{{$producto->codigo}} </span></span></h4>
                                        <h6 class="price"><strong>Precio:</strong> {{$producto->precio}} <span></h6>
                                        

                                        <div class="product-config">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th class="config-label">Equivalencias</th>
                                                        <td class="config-option">
                                                            <div class="config-color">
                                                                @foreach($productosEquivalencia as $dato)
                                                                <a href="#">{{$dato->codigo}}</a>
                                                                <?php echo '<a class="cod-link" href="#" onclick="f(&quot;'.$dato->codigo.'&quot;)">'.$dato->codigo.'</a> '; ?>
                                                                @endforeach
                                                               
                                                               
                                                            </div>
                                                        </td>
                                                    </tr>
                                                   
                                                </table>
                                            </div>
                                        </div>

                                        <div class="product-action">
                                            <div class="action-top d-sm-flex">
                                                <div class="pro-qty mr-3 mb-4 mb-sm-0">
                                                    <label for="quantity" class="sr-only">Cantidad</label>
                                                    <input type="number" id="quantity" title="Quantity" value="1" />
                                                </div>

                                                <button class="cart-button btn btn-orange" onclick="selectByName('{{$producto->slug}}',$('#quantity').val());">
      <span class="add-to-cart">Agregar</span>
      <span class="added"></span>
      <i class="fa fa-shopping-cart"></i>
    </button>

                                               
                                                
                                            </div>
                                        </div> 


                                       

  
 



                                        <div class="product-meta">
                                            <!-- <span class="sku_wrapper">SKU: <span class="sku">N/A</span></span>

                                            <span class="posted_in">Categories:
                                            <a href="#">Best Seller,</a>
                                            <a href="#">Parts,</a>
                                            <a href="#">Shop</a>
                                        </span>

                                            <span class="tagged_as">Tags:
                                            <a href="#">Seller,</a>
                                            <a href="#">Modern,</a>
                                            <a href="#">Parts</a>
                                        </span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Info Area -->
                        </div>
               <br>
                        <div class="row">
                            <div class="col-12">
                                 <!-- Start carousel -->
                                 <div class="container">
  <div class="carousel slide multi-item-carousel" id="theCarousel">
    <!-- <div class="carousel-inner row w-100 mx-auto" style="height:300px"> -->
    <div class="carousel-inner row w-100 mx-auto">


    @for ($i = 0; $i < 1 ; $i++)
                    <div class="carousel-item col-md-4 active " >
                        <div class="card" >
                            <input type="hidden" value="{{$producto=$productosEquivalencia[0]}}">
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
                                             <h5 class=""><strong>{{$producto->nombre}}</strong> -  {{$producto->marca->nombre}}</h5>                                                                     
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
                                </div>
                        </div>
                    </div>
@endfor  
    @for ($i = 1; $i < sizeof($productosEquivalencia) ; $i++)
    <div class="carousel-item col-md-4">
    <div class="card" >
    <input type="hidden" value="{{$producto=$productosEquivalencia[$i]}}">
    @include('pages.product.partials')
            <div class="card card-body">
            <h5 class="card-title">{{$producto->codigo}}</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
 
    </div>
      </div>
      </div>
@endfor  
    








    
  

    </div>
    <a style="color:red"class="carousel-control-prev" href="#theCarousel" role="button" data-slide="prev">
      <span style="color:red" class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span  style="color:red" class="sr-only">Anterior</span>
    </a>
    <a style="color:red" class="carousel-control-next" href="#theCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Siguiente</span>
    </a>
  </div>
</div>




                        <!-- end carousel -->
                    </div>
                </div>
            </div>
        </div>
    </div>



