@if($producto->imagen != '')
    @if(file_exists(public_path().'/img/productos/'.$producto->imagen))
        {!! HTML::image('/img/productos/'.$producto->imagen, $producto->nombre, array('class'=>'img-responsive', 'title'=>$producto->nombre, 'width'=>'55px')) !!}
    @else
        {!! HTML::image('/img/productos/sin-imagen.png', $producto->nombre, array('class'=>'img-responsive', 'title'=>$producto->nombre, 'width'=>'55px')) !!}
    @endif
@else
    @if(str_contains($producto->codigo, '/'))
        {{--*/ $codProd = str_replace('/', '_', $producto->codigo) /*--}}
    @else
        {{--*/ $codProd = $producto->codigo /*--}}
    @endif

    @if(file_exists(public_path().'/img/productos/'.$codProd.'.jpg'))
        {!! HTML::image('/img/productos/'.$codProd.'.jpg', $producto->nombre, array('class'=>'img-responsive', 'title'=>$producto->nombre, 'width'=>'55px')) !!}
    @elseif(file_exists(public_path().'/img/productos/'.$codProd.'.JPG'))
        {!! HTML::image('/img/productos/'.$codProd.'.JPG', $producto->nombre, array('class'=>'img-responsive', 'title'=>$producto->nombre, 'width'=>'55px')) !!}
    @elseif(file_exists(public_path().'/img/productos/'.$codProd.'.png'))
        {!! HTML::image('/img/productos/'.$codProd.'.png', $producto->nombre, array('class'=>'img-responsive', 'title'=>$producto->nombre, 'width'=>'55px')) !!}
    @elseif(file_exists(public_path().'/img/productos/'.$codProd.'.PNG'))
        {!! HTML::image('/img/productos/'.$codProd.'.PNG', $producto->nombre, array('class'=>'img-responsive', 'title'=>$producto->nombre, 'width'=>'55px')) !!}
    @else
        {!! HTML::image('/img/productos/sin-imagen.png', $producto->nombre, array('class'=>'img-responsive', 'title'=>$producto->nombre, 'width'=>'55px')) !!}
    @endif

@endif