


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
                                        <h2>{{$producto->codigo}}</h2>
                                        <h5 class="price"><strong>Price:</strong> <span class="price-amount">$325.00</span>
                                        </h5>
                                        <p>Pursue pleasure rationally encounter consequences that are extremely painful. Nor
                                            again is there anyone who loves or pursues or desires to obtain pain of itself,
                                            because it is pain, but because occasionally circles</p>
                                        <p>Pursue pleasure rationally encounter consequences that are extremely painful. Nor
                                            again is there anyone who loves or pursues or desires to obtain pain of itself,
                                            because it is pain, but because occasionally circles occur in and pain can
                                            procure him some great ple cum solute nobie est eligendi option</p>

                                        <div class="product-config">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th class="config-label">Color</th>
                                                        <td class="config-option">
                                                            <div class="config-color">
                                                                <a href="#">Black</a>
                                                                <a href="#">Blue</a>
                                                                <a href="#">Green</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="config-label">Size</th>
                                                        <td class="config-option">
                                                            <div class="config-color">
                                                                <a href="#">Large</a>
                                                                <a href="#">Medium</a>
                                                                <a href="#">Small</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="product-action">
                                            <div class="action-top d-sm-flex">
                                                <div class="pro-qty mr-3 mb-4 mb-sm-0">
                                                    <label for="quantity" class="sr-only">Quantity</label>
                                                    <input type="text" id="quantity" title="Quantity" value="1" />
                                                </div>

                                                <button class="cart-button btn btn-bordered" onclick="selectByName('{{$producto->slug}}');">
      <span class="add-to-cart">Add to cart</span>
      <span class="added"></span>
      <i class="fa fa-shopping-cart"></i>
    </button>

                                                <!-- <button  id="addtocart" class="btn btn-bordered" onclick="selectByName('{{$producto->slug}}');">Add to Cart <span class="cart-item"></span></button> -->
                                                
                                            </div>
                                        </div> 


                                       

  
 



                                        <div class="product-meta">
                                            <span class="sku_wrapper">SKU: <span class="sku">N/A</span></span>

                                            <span class="posted_in">Categories:
                                            <a href="#">Best Seller,</a>
                                            <a href="#">Parts,</a>
                                            <a href="#">Shop</a>
                                        </span>

                                            <span class="tagged_as">Tags:
                                            <a href="#">Seller,</a>
                                            <a href="#">Modern,</a>
                                            <a href="#">Parts</a>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Info Area -->
                        </div>
               
                        <div class="row">
                            <div class="col-12">
                                 <!-- Start carousel -->
                                 <div class="container">
  <div class="carousel slide multi-item-carousel" id="theCarousel">
    <div class="carousel-inner row w-100 mx-auto">
      <div class="carousel-item active col-md-4">
        <img src="https://via.placeholder.com/300/f44336/000000?text=1" class="img-fluid mx-auto d-block">
      </div>
      <div class="carousel-item col-md-4">
        <img src="https://via.placeholder.com/300/e91e63/000000?text=2" class="img-fluid mx-auto d-block">
      </div>
      <div class="carousel-item col-md-4">
        <img src="https://via.placeholder.com/300/9c27b0/000000?text=3" class="img-fluid mx-auto d-block">
      </div>
      <div class="carousel-item col-md-4">
        <img src="https://via.placeholder.com/300/673ab7/000000?text=4" class="img-fluid mx-auto d-block">
      </div>
      <div class="carousel-item col-md-4">
        <img src="https://via.placeholder.com/300/4caf50/000000?text=5" class="img-fluid mx-auto d-block">
      </div>
      <div class="carousel-item col-md-4">
        <img src="https://via.placeholder.com/300/8bc34a/000000?text=6" class="img-fluid mx-auto d-block">
      </div>
      <div class="carousel-item col-md-4">
        <img src="https://via.placeholder.com/300/ffffff/000000?text=7" class="img-fluid mx-auto d-block">
      </div>
      <div class="carousel-item col-md-4">
        <img src="https://via.placeholder.com/300/000000/ffffff?text=8" class="img-fluid mx-auto d-block">
      </div>
    </div>
    <a class="carousel-control-prev" href="#theCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#theCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
                        <!-- end carousel -->
                    </div>
                </div>
            </div>
        </div>
    </div>



