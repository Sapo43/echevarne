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

                                    <div class="">
                                         <!-- Stock -->
                                         <br>
                                         <div class="ratting">
                                         <h6>Stock :

                                        @if(($producto->stock - $producto->stock_minimo) >= 1)
            <span class="badge stock-disponible product mb-4 ml-xl-0 ml-4">Disponible</span>
                                                   
            @endif

            @if( ($producto->stock <= $producto->stock_minimo ) && $producto->stock >0)
            <span class="badge stock-consultar product mb-4 ml-xl-0 ml-4">Consultar</span>
            @endif

            @if($producto->stock <=0)
            <span class="badge stock-nodisponible product mb-4 ml-xl-0 ml-4">No Disponible</span>
            @endif
            </h6>                   
                                         
                                        </div>
                                        <!-- End Stock -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Thumbnail Area -->

                            <!-- Start Product Info Area -->
                            <div class="col-md-7">
                                <div class="product-details-info-content-wrap">
                                    <div class="prod-details-info-content">
                                        <div class="row">
                                        <div class="col-md-12">
                                        <h2>{{$producto->nombre}} - {{$producto->codigo}}</h2>
                                        </div>
                                        </div>
                                   
                                  
                                            <h6>Marca: {{$producto->marca->nombre}}</h6>
                                            
                                            @if(\Auth::check())
                                                @if(\Auth::user()->porcentaje_compra>0 || \Auth::user()->porcentaje_venta>0)
                                                 
                                                <h6 style="color:#F76725" class="precioLista"><p>Precio: ${{number_format( $producto->precio,2, ',','.')}}<p></h6> 
                                                <h6 style="color:#F76725" class="precioCompra"><p>Precio: ${{number_format($producto->precio- ($producto->precio* Auth::user()->porcentaje_compra   / 100),2, ',','.')}}<p></h6>  
                                                <h6 style="color:#F76725" class="precioVenta "><p>Precio: ${{number_format($producto->precio- ($producto->precio* Auth::user()->porcentaje_compra  / 100)+( ($producto->precio - ($producto->precio* Auth::user()->porcentaje_compra  / 100)) * Auth::user()->porcentaje_venta  / 100),2, ',','.')}}<p></h5>    
                                                @else
                                                <h6 style="color:#F76725" class="precioLista"><p>Precio: ${{number_format( $producto->precio,2, ',','.')}}<p></h6> 
                                                 @endif
                                                 @else
                                                <h6 style="color:#F76725" class="precioLista"><p>Precio: ${{number_format( $producto->precio,2, ',','.')}}<p></h6> 
                                                 @endif
                                          
                                            
                                       

                                 
                                     
                                   
                                 

                                        <div class="row">
                                        <div class="col-md-12">
                                        <div class="product-config">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th class="config-label">Equivalencias*</th>
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
                                        </div>
                                        </div>
                                   
                                        @if(url('/').'/cart' != url()->previous())

                                        <div class="product-action">
                                            <div class="action-top flex">
                                            <div class="row">
                                                    <div class="col-sm-2 col-md-2 col-lg-2">

                                                    </div>
                                                    

                                                    <div class="col-sm-8 col-md-8 col-lg-8">
                                                    <div class="pro-qty ">
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
                                               
                                                
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-md-9">

                                            </div>
                                            <div class="col-md-3">
                                            <p style="text-align:right">IVA: {{$producto->iva}} %</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7">

                                            </div>
                                            <div class="col-md-5">
                                                    <p style="text-align:right">Actualizado: {{ $producto->actualizado}} </p>
                                            </div>
                                        </div>
                                   
                                      
                                     
                                       @endif

  
 



                                        <div class="product-meta">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Info Area -->
                        </div>
                      <div class="row">
                                <div class="col-12">                           
                                    <div class="container">
                                    @if(sizeof($productosEquivalencias)>0)
                                        <h5>Equivalencias disponibles</h5>
                                        
                                        <div id="carrusel">
                                            <a href="" class="left-arrow"><img src="assets/left-arrow.png" /></a>
                                            <a href="" class="right-arrow"><img src="assets/right-arrow.png" /></a>
                                            <div class="carrusel">
                                            @for ($i = 0; $i < sizeof($productosEquivalencias) ; $i++)
                                            <input type="hidden" value="{{$producto=$productosEquivalencias[$i]}}">
                                                    <div class="product slides" id="product_{{$i}}">
                                                            <div class="resize-image"> 
                                                            <?php echo '<a class="cod-link" href="#" onclick="f(&quot;'.$producto->codigo.'&quot;)">'?>
                                                             @include('pages.product.partialsForModal')    
                                                            </a>
                                                            </div>
                                                            <?php echo '<a class="cod-link" href="#" onclick="f(&quot;'.$producto->codigo.'&quot;)">'.$producto->codigo.'</a> '; ?>
                                                        
                                                            <span class="price">$ {{$producto->precio}}</span>
                                                    </div>
                                            @endfor 
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

    <div>
<p style='color:red'>* Estos códigos se corresponde a equivalencias de productos según otras marcas</p>
    </div>
<script>
                        var current = 0;
var imagenes = new Array();
 
$(document).ready(function() {



    if(sessionStorage.Tipo=='Compra'){
              $('.precioVenta').css('display', 'none');
              $('.precioLista').css('display', 'none');
              $('.precioCompra').css('display', 'block');
          } 
          if(sessionStorage.Tipo=='Venta'){
              $('.precioCompra').css('display', 'none');
              $('.precioLista').css('display', 'none');
              $('.precioVenta').css('display', 'block');
              
          } 
          if(sessionStorage.Tipo=='Lista'){
              $('.precioVenta').css('display', 'none');
              $('.precioCompra').css('display', 'none');
              $('.precioLista').css('display', 'block');
          }
        



    var numImages={{sizeof($productosEquivalencias)}};
    if (numImages <= 3) {
        $('.right-arrow').css('display', 'none');
        $('.left-arrow').css('display', 'none');
    }
 
    $('.left-arrow').on('click',function() {
        console.log(current);
        if (current > 0) {
            current = current - 1;
        } else {
            current = numImages - 3;
        }
 
        $(".carrusel").animate({"left": -($('#product_'+current).position().left)}, 600);
 
        return false;
    });
 
    $('.left-arrow').on('hover', function() {
        $(this).css('opacity','0.5');
    }, function() {
        $(this).css('opacity','1');
    });
 
    $('.right-arrow').on('hover', function() {
        $(this).css('opacity','0.5');
    }, function() {
        $(this).css('opacity','1');
    });
 
    $('.right-arrow').on('click', function() {
        if (numImages > current + 3) {
            current = current+1;
        } else {
            current = 0;
        }
 
        $(".carrusel").animate({"left": -($('#product_'+current).position().left)}, 600);
 
        return false;
    }); 
 });


</script>
