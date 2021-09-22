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
                                        <h2>{{$producto->nombre}} - {{$producto->codigo}}</h2>
                                        <h6>{{$producto->marca->nombre}}</h6>
                                        <h5><b>Precio:</b> $ {{$producto->precio}} </h5>
                                        <p>Actulizado: {{$producto->actualizado}} </p>
                                        <p>IVA: % {{$producto->iva}} </p>

                                        

                                        <div class="product-config">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th class="config-label">Equivalencias</th>
                                                        <td class="config-option">
                                                            <div class="config-color">
                                                                @foreach($productosEquivalencia as $dato)
                                                                <?php echo '<a class="cod-link" href="#" onclick="f(&quot;'.$dato.'&quot;)">'.$dato.'</a> '; ?>
                                                                @endforeach
                                                               
                                                               
                                                            </div>
                                                        </td>
                                                    </tr>
                                                   
                                                </table>
                                            </div>
                                        </div>
                                   
                                        @if(url('/').'/cart' != url()->previous())

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


                                       @endif

  
 



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
                                 <div id="carrusel">
    <a href="#" class="left-arrow"><img src="assets/left-arrow.png" /></a>
    <a href="#" class="right-arrow"><img src="assets/right-arrow.png" /></a>
    <div class="carrusel">
{{sizeof($productosEquivalencias)}}
    @for ($i = 0; $i < sizeof($productosEquivalencias) ; $i++)
    <input type="hidden" value="{{$producto=$productosEquivalencias[$i]}}">
    <div class="product" id="product_{{$i}}">
        <div class="resize-image">  <a href=""  onclick="f({{$producto->codigo}})"  >
                                 @include('pages.product.partialsForModal')    

                                 </a></div>
  
    
                                
                                 <?php echo '<a class="cod-link" href="#" onclick="f(&quot;'.$producto->codigo.'&quot;)">'.$producto->codigo.'</a> '; ?>
                                 <br>
                                     <span class="price">$ {{$producto->precio}}</span>
                                     
                                
        </div>

    @endfor 
        
    </div>
</div>
                                </div>
                            </div>
                        </div>



   
                      



