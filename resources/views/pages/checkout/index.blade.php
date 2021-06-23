@extends('layouts.default')

@section('content')






  <!--== Start Page Content Wrapper ==-->
  <div class="page-content-wrapper sp-y">
        <div class="cart-page-content-wrap">
            <div class="container container-wide">
                <div class="row">
                    <div class="col-12">
                        <div class="checkout-page-coupon-area">
                            <!-- Checkout Coupon Accordion Start -->
                            <div class="checkoutAccordion" id="checkOutAccordion">
                                <div class="card">
                                    <h3><i class="fa fa-info-circle"></i> Have a Coupon? <span data-toggle="collapse" data-target="#couponaccordion">
                                    Click here to Enter your Code</span>
                                    </h3>
                                    <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="apply-coupon-wrapper">
                                                        <p>If you have a coupon code, please apply it below.</p>
                                                        <form action="#" method="post">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="input-item mt-0">
                                                                        <input type="text" placeholder="Enter Your Coupon Code" required />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4 mt-20 mt-md-0">
                                                                    <button class="btn btn-bordered">Apply Coupon</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkout Coupon Accordion End -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <!-- Checkout Form Area Start -->
                        <div class="checkout-billing-details-wrap">
                            <h2>Billing Details</h2>
                            <div class="billing-form-wrap">
                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item mt-0">
                                                <label for="f_name" class="sr-only required">First Name</label>
                                                <input type="text" id="f_name" placeholder="First Name" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-item mt-md-0">
                                                <label for="l_name" class="sr-only required">Last Name</label>
                                                <input type="text" id="l_name" placeholder="Last Name" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-item">
                                        <label for="email" class="sr-only required">Email Address</label>
                                        <input type="email" id="email" placeholder="Email Address" required />
                                    </div>

                                    <div class="input-item">
                                        <label for="com-name" class="sr-only">Company Name</label>
                                        <input type="text" id="com-name" placeholder="Company Name" />
                                    </div>

                                    <div class="input-item">
                                        <label for="country" class="sr-only required">Country</label>
                                        <select name="country" id="country">
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="India">India</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="England">England</option>
                                            <option value="London">London</option>
                                            <option value="London">London</option>
                                            <option value="Chaina">China</option>
                                        </select>
                                    </div>

                                    <div class="input-item">
                                        <label for="street-address" class="sr-only required">Street address</label>
                                        <input type="text" id="street-address" placeholder="Street address Line 1" required />
                                    </div>

                                    <div class="input-item">
                                        <input type="text" placeholder="Street address Line 2 (Optional)" />
                                    </div>

                                    <div class="input-item">
                                        <label for="town" class="sr-only required">Town / City</label>
                                        <input type="text" id="town" placeholder="Town / City" required />
                                    </div>

                                    <div class="input-item">
                                        <label for="state" class="sr-only">State / Divition</label>
                                        <input type="text" id="state" placeholder="State / Divition" />
                                    </div>

                                    <div class="input-item">
                                        <label for="postcode" class="sr-only required">Postcode / ZIP</label>
                                        <input type="text" id="postcode" placeholder="Postcode / ZIP" required />
                                    </div>

                                    <div class="input-item">
                                        <label for="phone" class="sr-only">Phone</label>
                                        <input type="text" id="phone" placeholder="Phone" />
                                    </div>

                                    <div class="checkout-box-wrap">
                                        <div class="input-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="create_pwd">
                                                <label class="custom-control-label" for="create_pwd">Create an
                                                    account?</label>
                                            </div>
                                        </div>
                                        <div class="account-create single-form-row">
                                            <p>Create an account by entering the information below. If you are a returning
                                                customer please login at the top of the page.</p>
                                            <div class="input-item">
                                                <label for="pwd" class="sr-only required">Account Password</label>
                                                <input type="password" id="pwd" placeholder="Account Password" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="checkout-box-wrap">
                                        <div class="input-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ship_to_different">
                                                <label class="custom-control-label" for="ship_to_different">Ship to a
                                                    different
                                                    address?</label>
                                            </div>
                                        </div>
                                        <div class="ship-to-different single-form-row">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-item">
                                                        <label for="f_name_2" class="sr-only required">First Name</label>
                                                        <input type="text" id="f_name_2" placeholder="First Name" required />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-item">
                                                        <label for="l_name_2" class="sr-only required">Last Name</label>
                                                        <input type="text" id="l_name_2" placeholder="Last Name" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="input-item">
                                                <label for="email_2" class="sr-only required">Email Address</label>
                                                <input type="email" id="email_2" placeholder="Email Address" required />
                                            </div>

                                            <div class="input-item">
                                                <label for="com-name_2" class="sr-only">Company Name</label>
                                                <input type="text" id="com-name_2" placeholder="Company Name" />
                                            </div>

                                            <div class="input-item">
                                                <label for="country_2" class="sr-only required">Country</label>
                                                <select name="country" id="country_2">
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="India">India</option>
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="England">England</option>
                                                    <option value="London">London</option>
                                                    <option value="London">London</option>
                                                    <option value="Chaina">Chaina</option>
                                                </select>
                                            </div>

                                            <div class="input-item">
                                                <label for="street-address_2" class="sr-only required">Street address</label>
                                                <input type="text" id="street-address_2" placeholder="Street address Line 1" required />
                                            </div>

                                            <div class="input-item">
                                                <input type="text" placeholder="Street address Line 2 (Optional)" />
                                            </div>

                                            <div class="input-item">
                                                <label for="town_2" class="sr-only required">Town / City</label>
                                                <input type="text" id="town_2" placeholder="Town / City" required />
                                            </div>

                                            <div class="input-item">
                                                <label for="state_2" class="sr-only">State / Divition</label>
                                                <input type="text" id="state_2" placeholder="State / Divition" />
                                            </div>

                                            <div class="input-item">
                                                <label for="postcode_2" class="sr-only required">Postcode / ZIP</label>
                                                <input type="text" id="postcode_2" placeholder="Postcode / ZIP" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-item">
                                        <label for="ordernote" class="sr-only">Order Note</label>
                                        <textarea name="ordernote" id="ordernote" cols="30" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-5 ml-auto">
                        <!-- Checkout Page Order Details -->
                        <div class="order-details-area-wrap">
                            <h2>Your Order</h2>

                            <div class="order-details-table table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cart as $producto)
                                        <tr class="cart-item">
                                            <td><span class="product-title">{{$producto->codigo}}</span> <span
                                            class="product-quantity">&#215; {{$producto->cantidad}}</span></td>
                                            <td>{{$producto->precio}}</td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td>$309.00</td>
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
                                        <tr class="final-total">
                                            <th>Total</th>
                                            <td><span class="total-amount">$289.93</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="order-details-footer">
                                <p>Your personal data will be used to process your order, support your experience throughout
                                    this website, and for other purposes described in our
                                    <a href="#" class="text-warning">privacy policy</a>.</p>
                                <div class="custom-control custom-checkbox mt-10">
                                    <input type="checkbox" id="privacy" class="custom-control-input" required />
                                    <label for="privacy" class="custom-control-label">I have read and agree to the website
                                        terms
                                        and conditions</label>
                                </div>

                                <button id="confirmar" class="btn btn-bordered mt-40">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== End Page Content Wrapper ==-->






   @endsection

