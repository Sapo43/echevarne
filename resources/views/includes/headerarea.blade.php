<header class="header-area">
        <div class="container container-wide">
            <div class="row align-items-center">
                <div class="col-sm-4 col-lg-2">
                    <div class="site-logo text-center text-sm-left">
                        <a href="/"><img src="/assets/img/EchevarneHnos_Logo.png" alt="Logo"  style="width: 200px; height: 100px"/></a>
                    </div>
                </div>

                <div class="col-lg-7 d-none d-lg-block">
                    <div class="site-navigation">
                        <ul class="main-menu nav">
                            <!-- <li class="has-submenu"><a href="/">Home</a>
                                 <ul class="sub-menu">
                                    <li><a href="index.html">Home 1</a></li>
                                    <li><a href="index-2.html">Home 2</a></li>
                                    <li><a href="index-boxed.html">Home Box Layout</a></li>
                                </ul> 
                            </li> -->
                            <!-- <li><a href="/about">Nosotros</a></li> -->
                            <li class="has-submenu"><a href="/shop">Shop</a>
                                
                            </li>
                            <!-- <li class="has-submenu"><a href="/servicios">Servicios</a> -->
                                <!-- <ul class="sub-menu">
                                    <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                    <li><a href="blog.html">Blog Right Sidebar</a></li>
                                    <li><a href="blog-details.html">Single Blog</a></li>
                                    <li><a href="blog-details-sidebar.html">Single Blog Sidebar</a></li>
                                </ul> -->
                            </li>
                            <li><a href="/descargas">Catalogos</a></li>
                           
                            <li><a href="/contacto">Contacto</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-8 col-lg-3">
                    <div class="site-action d-flex justify-content-center justify-content-sm-end align-items-center">
                        <ul class="login-reg-nav nav">
                        @if (Auth::check()) 
                        <li><a href="/logout">Salir</a></li>
                        <li><a href="/misDatos">{{\Auth::user()->nombre}}</a></li>
@else
<li><a href="/login">Ingresar</a></li>
<li><a href="/register">Registrame</a></li>
 @endif
                            

                           
                        </ul>

                        <div class="mini-cart-wrap">
                       @if(isset($cart))     
                        @if(sizeof($cart)>0)
                            <a href="/cart" class="btn-mini-cart">
                                <i class="ion-bag"></i>
                                <span id ="qtyCart" class="cart-total">{{sizeof($cart)}}</span>
                            </a>
                            @else
                            <a href="/shop" class="btn-mini-cart">
                                <i class="ion-bag"></i>
                                <span id ="qtyCart" class="cart-total"></span>
                            </a>
                                
                            <div class="mini-cart-content">
                                <div class="mini-cart-product">
                                   <!--  -->
                                    <div id="minicart">
                                    
                                    </div>
                             

                             <!--  -->
                                </div>
                            </div>
                            @endif
                            @if(sizeof($cart)>0)
                            <div class="mini-cart-content">
                                <div class="mini-cart-product">
                                   <!--  -->
                                    <div id="minicart">
                                
                                    @include('includes.minicart')
                                    
                                    </div>
                             

                                   <!--  -->
                                </div>
                            </div>
                            @endif
                            @else
                            <a href="/shop" class="btn-mini-cart">
                                <i class="ion-bag"></i>
                                <span id ="qtyCart" class="cart-total"></span>
                            </a>

                         @endif   
                        </div>

                        <div class="responsive-menu d-lg-none">
                            <button class="btn-menu">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>