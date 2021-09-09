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
                                   
                           
                                @if($novedad->marca_id==null && $novedad->rubro_id==null && $novedad->codigo_producto==null)
                                     <a href="/shop">
                                        <img class="thumb-primary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px" />
                                        <img class="thumb-secondary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px"/>
                                    </a>
                                @endif

                                @if($novedad->marca_id!=null && $novedad->rubro_id==null && $novedad->codigo_producto==null)
                                <a href="/shop/novedad/{{$novedad->marca_id}}/0/0">
                                        <img class="thumb-primary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px" />
                                        <img class="thumb-secondary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px"/>
                                    </a>

                                @endif

  @if($novedad->marca_id!=null && $novedad->rubro_id==null && $novedad->codigo_producto==null)
  <a href="/shop/novedad/{{$novedad->marca_id}}/{{$novedad->rubro_id}}/0">
                                        <img class="thumb-primary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px" />
                                        <img class="thumb-secondary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px"/>
                                    </a>

  @endif

  @if($novedad->marca_id!=null && $novedad->rubro_id!=null && $novedad->codigo_producto!=null)
  <a href="/shop/novedad/{{$novedad->marca_id}}/{{$novedad->rubro_id}}/{{$novedad->codigo_producto}}">
                                        <img class="thumb-primary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px" />
                                        <img class="thumb-secondary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px"/>
                                    </a>
  @endif


  @if($novedad->marca_id==null && $novedad->rubro_id!=null && $novedad->codigo_producto==null)
  <a href="/shop/novedad/0/{{$novedad->rubro_id}}/0">
                                        <img class="thumb-primary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px" />
                                        <img class="thumb-secondary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px"/>
                                    </a>

  @endif

  @if($novedad->marca_id==null && $novedad->rubro_id!=null && $novedad->codigo_producto!=null)
  <a href="/shop/novedad/0/{{$novedad->rubro_id}}/{{$novedad->codigo_producto}}">
                                        <img class="thumb-primary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px" />
                                        <img class="thumb-secondary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px"/>
                                    </a>

  @endif
  @if($novedad->marca_id==null && $novedad->rubro_id==null && $novedad->codigo_producto!=null)
  <a href="/shop/novedad/0/0/{{$novedad->codigo_producto}}">
  <img class="thumb-primary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px" />
                                        <img class="thumb-secondary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px"/>
                                    </a>
  @endif

  @if($novedad->marca_id!=null && $novedad->rubro_id==null && $novedad->codigo_producto!=null)
  <a href="/shop/novedad/{{$novedad->marca_id}}/0/{{$novedad->codigo_producto}}">
  <img class="thumb-primary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px" />
                                        <img class="thumb-secondary" src="{{$novedad->imagen}}" alt="{{$novedad->titulo}}" style="width: 300px; height: 300px"/>
                                    </a>

  @endif
                                </div>
                                <br>
                                <div class="product-item__content">
                                @if($novedad->marca_id==null && $novedad->rubro_id==null && $novedad->codigo_producto==null)
                                <h4 class="title"><a href="/shop">{{$novedad->titulo}}</a></h4>                            
                                @endif

                               @if($novedad->marca_id!=null && $novedad->rubro_id==null && $novedad->codigo_producto==null)
                                <h4 class="title"><a href="/shop/novedad/{{$novedad->marca_id}}/0/0">{{$novedad->titulo}}</a></h4>
                                @endif
                                @if($novedad->marca_id!=null && $novedad->rubro_id!=null && $novedad->codigo_producto==null)
                                <h4 class="title"><a href="/shop/novedad/{{$novedad->marca_id}}/{{$novedad->rubro_id}}/0">{{$novedad->titulo}}</a></h4>
                                @endif
                                @if($novedad->marca_id!=null && $novedad->rubro_id!=null && $novedad->codigo_producto!=null)
                                <h4 class="title"><a href="/shop/novedad/{{$novedad->marca_id}}/{{$novedad->rubro_id}}/{{$novedad->codigo_producto}}">{{$novedad->titulo}}</a></h4>
                                @endif
                                @if($novedad->marca_id==null && $novedad->rubro_id!=null && $novedad->codigo_producto==null)
                                <h4 class="title"><a href="/shop/novedad/0/{{$novedad->rubro_id}}/0">{{$novedad->titulo}}</a></h4>
                                @endif
                                @if($novedad->marca_id==null && $novedad->rubro_id!=null && $novedad->codigo_producto!=null)
                                <h4 class="title"><a href="/shop/novedad/0/{{$novedad->rubro_id}}/{{$novedad->codigo_producto}}">{{$novedad->titulo}}</a></h4>
                                @endif
                                @if($novedad->marca_id==null && $novedad->rubro_id==null && $novedad->codigo_producto!=null)
                                <h4 class="title"><a href="/shop/novedad/0/0/{{$novedad->codigo_producto}}">{{$novedad->titulo}}</a></h4>
                                @endif
                                @if($novedad->marca_id!=null && $novedad->rubro_id==null && $novedad->codigo_producto!=null)
                                <h4 class="title"><a href="/shop/novedad/{{$novedad->marca_id}}/0/{{$novedad->codigo_producto}}">{{$novedad->titulo}}</a></h4>
                                @endif
                                <span><strong>{{$novedad->subtitulo}}</strong> </span>
                            
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


