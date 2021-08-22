<div class="best-seller-products-area sm-top">
        <div class="container container-wide">
            <div class="row">
                <div class="col-lg-5 m-auto text-center">
                    <div class="section-title">
                        <h2 class="h3">NUESTROS PRODUCTOS MAS VENDIDOS</h2>
                        <p></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="product-wrapper">
                        <div class="product-carousel">
                        
                        @foreach($productos as $producto)
                        
                            <!-- Start Product Item -->
                            @include('includes.productitem')
                            <!-- End Product Item -->
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>