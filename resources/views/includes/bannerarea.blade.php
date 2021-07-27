<br>

<div class="row">
                <div class="col-lg-5 m-auto text-center">
                    <div class="section-title">
                        <h2 class="h3">Novedades</h2>
                        <p>

                        </p>
                    </div>
                </div>
            </div>

<div class="banner-area-wrapper sm-top">
        <div class="container container-wide">
        
        
        
        
        <div class="row mtn-30">
        @foreach ($novedades as $novedad)
        <div class="col-lg-4">
        <div>
        <div>
        <!-- <div class="col-md-6 col-lg-4">
        <div class="banner-item">
        <div class="banner-item__img"> -->
                        <!-- @if($novedad->es_producto != 1)
                        <a href="" title="{{$novedad->titulo}}">
                        @else
                        <a href="" title="{{$novedad->titulo}}">
                        @endif
                                <figure style="background-image:url({{$novedad->imagen}})">
                                    <img src="{{$novedad->imagen}}" alt="" class="img-responsive">
                                </figure>
                        </a>
                        <h2>
                            @if($novedad->es_producto != 1)
                                <a href="" title="{{$novedad->titulo}}">
                                    @else
                                    <a href="" title="{{$novedad->titulo}}">
                                        @endif                            
                                        {{$novedad->titulo}}
                                    </a>
                            </h2>
                            <h4>
                                @if($novedad->es_producto != 1)
                                <a href="" title="{{$novedad->titulo}}">
                                    @else
                                    <a href="" title="{{$novedad->titulo}}">
                                        @endif
                                        {{$novedad->subtitulo}}
                                    </a>
                            </h4> -->
                            <div class="col">
                            <div class="product-item">
                                <div class="product-item__thumb">
                                   
                                @if($novedad->es_producto != 1)
                                <!-- Es novedad -->
                                    <a href="">
                                        <img class="thumb-primary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px" />
                                        <img class="thumb-secondary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px"/>
                                    </a>
                                @else
                                
                                <a href="">
                                        <img class="thumb-primary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px" />
                                        <img class="thumb-secondary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px"/>
                                    </a>
                                @endif
                                </div>

                                <div class="product-item__content">
                                    <div class="ratting">
                                        <span><i class="ion-android-star"></i></span>
                                        <span><i class="ion-android-star"></i></span>
                                        <span><i class="ion-android-star"></i></span>
                                        <span><i class="ion-android-star-half"></i></span>
                                        <span><i class="ion-android-star-half"></i></span>
                                    </div>
                                    @if($novedad->es_producto != 1)
                                          <!-- Es novedad -->
                                    <h4 class="title"><a href="single-product.html">{{$novedad->titulo}}</a></h4>
                                    <span class="price"><strong></strong> {{$novedad->subtitulo}}</span>
                                    @else
                                    
                                        <h4 class="title"><a href="{{$novedad->f_url}}">{{$novedad->titulo}}</a></h4>
                                        <span class="price"><strong></strong> {{$novedad->subtitulo}}</span>
                                    @endif
                                </div>

                                <!-- <div class="product-item__action">
                                    <button class="btn-add-to-cart"><i class="ion-bag"></i></button>
                                    <button class="btn-add-to-cart"><i class="ion-ios-loop-strong"></i></button>
                                    <button class="btn-add-to-cart"><i class="ion-ios-heart-outline"></i></button>
                                    <button class="btn-add-to-cart"><i class="ion-eye"></i></button>
                                </div> -->
                            </div>
                        </div>
                            
                    </div>
                </div>     
                </div>            
                @endforeach
        
    

              

              
            </div>
        </div>
    </div>