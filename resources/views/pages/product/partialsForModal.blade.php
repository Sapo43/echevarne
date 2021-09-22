@if($producto->imagen != '')
    @if(file_exists(public_path().'/img/productos/'.$producto->imagen))
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{$producto->imagen}}.jpg">
        {{ HTML::image('/img/productos/'.$producto->imagen, $producto->nombre, array( 'title'=>$producto->nombre)) }}
        </figure>
    @else
    <figure class="pro-thumb-item" data-mfp-src="/img/productos/sin-imagen.png">
        {{ HTML::image('/img/productos/sin-imagen.png', $producto->nombre, array( 'title'=>$producto->nombre)) }}
        </figure>
    @endif
@else




        @if(isset($codProd))
    
                    @if(file_exists(public_path().'/img/productos/'.str_replace('/','_',$codProd).'.jpg'))
                    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{str_replace('/','_',$codProd)}}.jpg">
                        {{ HTML::image('/img/productos/'.str_replace('/','_',$codProd).'.jpg', $producto->nombre, array('class'=>'resize-image ', 'title'=>$producto->nombre)) }}
                        </figure>
                    @elseif(file_exists(public_path().'/img/productos/'.str_replace('/','_',$codProd).'.JPG'))
                    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{str_replace('/','_',$codProd)}}.JPG">
                        {{ HTML::image('/img/productos/'.str_replace('/','_',$codProd).'.JPG', $producto->nombre, array('class'=>'resize-image ', 'title'=>$producto->nombre)) }}
                        </figure>
                    @elseif(file_exists(public_path().'/img/productos/'.str_replace('/','_',$codProd).'.png'))
                    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{str_replace('/','_',$codProd)}}.png">
                        {{ HTML::image('/img/productos/'.str_replace('/','_',$codProd).'.png', $producto->nombre, array('class'=>'resize-image ', 'title'=>$producto->nombre)) }}
                        </figure>
                    @elseif(file_exists(public_path().'/img/productos/'.str_replace('/','_',$codProd).'.PNG'))
                    <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{str_replace('/','_',$codProd)}}.PNG">
                        {{ HTML::image('/img/productos/'.str_replace('/','_',$codProd).'.PNG', $producto->nombre, array('class'=>'resize-image ', 'title'=>$producto->nombre)) }}
                        </figure>
                    @else
                    <figure class="pro-thumb-item" data-mfp-src="/img/productos/sin-imagen.png">
                        {{ HTML::image('/img/productos/sin-imagen.png', $producto->nombre, array( 'title'=>$producto->nombre)) }}
                        </figure>
                    @endif

    

        @else   
    
                


                @if(file_exists(public_path().'/img/productos/'.str_replace('/','_',$producto->codigo.'.jpg')))
                <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{str_replace('/','_',$producto->codigo)}}.jpg">
                    {{ HTML::image('/img/productos/'.str_replace('/','_',$producto->codigo.'.jpg'), $producto->nombre, array('class'=>'resize-image ', 'title'=>$producto->nombre)) }}
                    </figure>
                @elseif(file_exists(public_path().'/img/productos/'.str_replace('/','_',$producto->codigo.'.JPG')))
                <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{str_replace('/','_',$producto->codigo)}}.JPG">
                    {{ HTML::image('/img/productos/'.str_replace('/','_',$producto->codigo.'.JPG'), $producto->nombre, array('class'=>'resize-image ', 'title'=>$producto->nombre)) }}
                    </figure>
                @elseif(file_exists(public_path().'/img/productos/'.str_replace('/','_',$producto->codigo.'.png')))
                <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{str_replace('/','_',$producto->codigo)}}.png">
                    {{ HTML::image('/img/productos/'.str_replace('/','_',$producto->codigo.'.png'), $producto->nombre, array('class'=>'resize-image ', 'title'=>$producto->nombre)) }}
                    </figure>
                @elseif(file_exists(public_path().'/img/productos/'.str_replace('/','_',$producto->codigo.'.PNG')))
                <figure class="pro-thumb-item" data-mfp-src="/img/productos/{{str_replace('/','_',$producto->codigo)}}.PNG">
                    {{ HTML::image('/img/productos/'.str_replace('/','_',$producto->codigo.'.PNG'), $producto->nombre, array('class'=>'resize-image ', 'title'=>$producto->nombre)) }}
                    </figure>
                @else
                <figure class="pro-thumb-item" data-mfp-src="/img/productos/sin-imagen.png">
                    {{ HTML::image('/img/productos/sin-imagen.png', $producto->nombre, array( 'title'=>$producto->nombre)) }}
                    </figure>
                @endif

                @endif
    

@endif    