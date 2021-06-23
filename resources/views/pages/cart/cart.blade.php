    <!--== Start Page Content Wrapper ==-->
    <div class="page-content-wrapper sp-y">
        <div class="cart-page-content-wrap">
            <div class="container container-wide">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shopping-cart-list-area">
                            <div class="shopping-cart-table table-responsive">
                                <table class="table table-bordered text-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($cart as $producto)
                                        <tr>
                                            <td class="product-list">
                                                <div class="cart-product-item d-flex align-items-center">
                                                    <div class="remove-icon">
                                                        <button><i class="fa fa-trash-o"></i></button>
                                                    </div>
                                                    <input id="codprod"  type="hidden" value=" {{$codProd=$producto->codigo}}">
                                            
                                                    <a href="single-product.html" class="product-thumb">

                                                    @include('pages.product.partials')
                                                    </a>
                                                    <a href="single-product.html" class="product-name"> {{$producto->nombre}}</a>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="price">{{number_format( $producto->precio,2, ',','.')}}</span>
                                            </td>
                                            <td>
                                                <div class="pro-qty">
                                              
                   
                                                    <input type="text"  min="1"
                   max="5"
                   value= "{{ $producto->cantidad }}"
                   id="product_{{$producto->id}}"class="quantity" title="Quantity" value="1" />
                                                </div>
                                            </td>
                                            <td>
                                                <span class="price">{{number_format($totalci,2, ',','.')}}</span>
                                            </td>
                                        </tr>

                                       @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="cart-coupon-update-area d-sm-flex justify-content-between align-items-center">
                                <div class="coupon-form-wrap">
                                    <form action="#" method="post">
                                        <label for="coupon" class="sr-only">Coupon Code</label>
                                        <input type="text" id="coupon" placeholder="Coupon Code" />
                                        <button class="btn-apply">Apply Button</button>
                                    </form>
                                </div>

                                <div class="cart-update-buttons mt-15 mt-sm-0">
                                    <button class="btn-clear-cart">Clear Cart</button>
                                    <button class="btn-update-cart">Update Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Cart Calculate Area -->
                        <div class="cart-calculate-area mt-sm-40 mt-md-60">
                            <h5 class="cal-title">Cart Totals</h5>

                            <div class="cart-cal-table table-responsive">
                                <table class="table table-borderless">
                                    <tr class="cart-sub-total">
                                        <th>Subtotal</th>
                                        <td>$289.89</td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Shipping</th>
                                        <td>
                                            <ul class="shipping-method">
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="flat_shipping" name="shipping_method" class="custom-control-input" checked />
                                                        <label class="custom-control-label" for="flat_shipping">Flat Rate :
                                                            $10</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="free_shipping" name="shipping_method" class="custom-control-input" />
                                                        <label class="custom-control-label" for="free_shipping">Free
                                                            Shipping</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="cod_shipping" name="shipping_method" class="custom-control-input" />
                                                        <label class="custom-control-label" for="cod_shipping">Cash on
                                                            Delivery</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td><b>$299.93</b></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="proceed-checkout-btn">
                                <a href="/checkout" class="btn btn-brand d-block">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== End Page Content Wrapper ==-->

  