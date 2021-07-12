@if($producto->imagen != '')
    @if(file_exists(public_path().'/img/productos/'.$producto->imagen))
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{$producto->imagen}}.jpg">
        {{ HTML::image('/img/productos/'.$producto->imagen, $producto->nombre, array('class'=>'img-responsive ', 'title'=>$producto->nombre)) }}
        </figure>
    @else
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/sin-imagen.png">
        {{ HTML::image('/img/productos/sin-imagen.png', $producto->nombre, array('class'=>'img-responsive ', 'title'=>$producto->nombre)) }}
        </figure>
    @endif
@else
    @if(isset($codProd))
    
    @if(file_exists(public_path().'/img/productos/'.$codProd.'.jpg'))
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{$codProd}}.jpg">
        {{ HTML::image('/img/productos/'.$codProd.'.jpg', $producto->nombre, array('class'=>'img-responsive ', 'title'=>$producto->nombre)) }}
        </figure>
    @elseif(file_exists(public_path().'/img/productos/'.$codProd.'.JPG'))
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{$codProd}}.JPG">
        {{ HTML::image('/img/productos/'.$codProd.'.JPG', $producto->nombre, array('class'=>'img-responsive ', 'title'=>$producto->nombre)) }}
        </figure>
    @elseif(file_exists(public_path().'/img/productos/'.$codProd.'.png'))
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{$codProd}}.png">
        {{ HTML::image('/img/productos/'.$codProd.'.png', $producto->nombre, array('class'=>'img-responsive ', 'title'=>$producto->nombre)) }}
        </figure>
    @elseif(file_exists(public_path().'/img/productos/'.$codProd.'.PNG'))
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{$codProd}}.PNG">
        {{ HTML::image('/img/productos/'.$codProd.'.PNG', $producto->nombre, array('class'=>'img-responsive ', 'title'=>$producto->nombre)) }}
        </figure>
    @else
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/sin-imagen.png">
        {{ HTML::image('/img/productos/sin-imagen.png', $producto->nombre, array('class'=>'img-responsive ', 'title'=>$producto->nombre)) }}
        </figure>
    @endif

    

    @else   
    
    @if(file_exists(public_path().'/img/productos/'.$producto->codigo.'.jpg'))
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{$producto->codigo}}.jpg">
        {{ HTML::image('/img/productos/'.$producto->codigo.'.jpg', $producto->nombre, array('class'=>'img-responsive ', 'title'=>$producto->nombre)) }}
        </figure>
    @elseif(file_exists(public_path().'/img/productos/'.$producto->codigo.'.JPG'))
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{$producto->codigo}}.JPG">
        {{ HTML::image('/img/productos/'.$producto->codigo.'.JPG', $producto->nombre, array('class'=>'img-responsive ', 'title'=>$producto->nombre)) }}
        </figure>
    @elseif(file_exists(public_path().'/img/productos/'.$producto->codigo.'.png'))
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{$producto->codigo}}.png">
        {{ HTML::image('/img/productos/'.$producto->codigo.'.png', $producto->nombre, array('class'=>'img-responsive ', 'title'=>$producto->nombre)) }}
        </figure>
    @elseif(file_exists(public_path().'/img/productos/'.$producto->codigo.'.PNG'))
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{$producto->codigo}}.PNG">
        {{ HTML::image('/img/productos/'.$producto->codigo.'.PNG', $producto->nombre, array('class'=>'img-responsive ', 'title'=>$producto->nombre)) }}
        </figure>
    @else
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/sin-imagen.png">
        {{ HTML::image('/img/productos/sin-imagen.png', $producto->nombre, array('class'=>'img-responsive ', 'title'=>$producto->nombre)) }}
        </figure>
    @endif

    @endif
    

@endif    