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
                                        <!-- <h4>Codigo: {{$producto->codigo}}</h4> -->
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
 @if(sizeof($productosEquivalencias)>0)                   
  <div class="carousel slide multi-item-carousel" id="theCarousel">
    <!-- <div class="carousel-inner row w-100 mx-auto" style="height:300px"> -->
    <h5 class="title">Equivalencias</h5>
    <div class="carousel-inner row w-100 mx-auto">


    @for ($i = 0; $i < 1 ; $i++)
    <div class="carousel-item col-md-4 active " style="height:auto;">
    <div class="card" >
    <input type="hidden" value="{{$producto=$productosEquivalencias[0]}}">
  
            <div class="card card-body">
            
                             <div class="sidebar-body">                         
                          
                             <div class="sidebar-product">
                                    <a href="#"  onclick="f(&quot;{{$producto->codigo}}&quot;)" class="image">
                                    @include('pages.product.partials')    

                                    </a>
                                    <div class="content">
                                    <?php echo '<a class="cod-link" href="#" onclick="f(&quot;'.$producto->codigo.'&quot;)">'.$producto->codigo.'</a> '; ?>
                                        <span class="price">$ {{$producto->precio}}</span>
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
                             

                        

                               

                            </div>
                        </div>
 
    </div>
      </div>
      </div>
@endfor  
    @for ($i = 1; $i < sizeof($productosEquivalencias) ; $i++)
    <div class="carousel-item col-md-4">
    <div class="card" >
    <input type="hidden" value="{{$producto=$productosEquivalencias[$i]}}">

            <div class="card card-body">
            <div class="sidebar-body">                         
                          
                          <div class="sidebar-product">
                          <a href="#"  onclick="f({{$producto->codigo}})" class="image">
                                 @include('pages.product.partials')    

                                 </a>
                                 <div class="content">
                                 <?php echo '<a class="cod-link" href="#" onclick="f(&quot;'.$producto->codigo.'&quot;)">'.$producto->codigo.'</a> '; ?>
                                     <span class="price">$ {{$producto->precio}}</span>
                                     <!-- <div class="ratting">
                                        @if(($producto->stock - $producto->stock_minimo) >= 1)
            <span class="badge stock-disponible product mb-4 ml-xl-0 ml-4">Disponible</span>
         
                                           
            @endif


            @if( ($producto->stock <= $producto->stock_minimo ) && $producto->stock >0)
            <span class="badge stock-consultar product mb-4 ml-xl-0 ml-4">Consultar</span>
            @endif


            @if($producto->stock <=0)
            <span class="badge stock-nodisponible product mb-4 ml-xl-0 ml-4">No Disponible</span>
            @endif
               
                                          
                                        </div> -->
                                 </div>
                          

                     

                            

                         </div>
                     </div>
 
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

    @endif
  </div>
</div>


