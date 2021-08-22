<br>
<br>
<div class="row">
                <div class="col-lg-5 m-auto text-center">
                    <div class="section-title">
                        <h2 class="h2">Novedades</h2>
                    </div>
                </div>
            </div>

<div class="banner-area-wrapper">
        <div class="container container-wide">       
        <div class="row mtn-30">
        @foreach ($novedades as $novedad)
        <div class="col-lg-4">
        <div>
        <div>
       
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
    <br>
                                <div class="product-item__content">
                               
                                    
                                
                                    
                                        <h4 class="title"><a href="/shop/{{$novedad->titulo}}">{{$novedad->titulo}}</a></h4>
                                        <span class="price"><strong></strong> {{$novedad->subtitulo}}</span>
                                
                                </div>

                            
                            </div>
                        </div>
                            
                    </div>
                </div>     
                </div>            
                @endforeach
        
    

              

              
            </div>
        </div>
    </div>