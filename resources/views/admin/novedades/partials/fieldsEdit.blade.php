<div class="row">
    <div class="col-md-6 form-group">
        {!! Form::label('titulo', 'Titulo') !!}
        {!! Form::text('titulo', $novedad->titulo, array('class' => 'form-control')) !!}                    
    </div>         
    <div class="col-md-2 form-group">
        {!! Form::label('visible', 'Es Visible') !!}
        <div class="input-group">
            <div class="input-group-addon">            
                {!! Form::checkbox('visible', 1, $novedad->visible) !!}
            </div>    
            <div class="form-control">
                {!! Form::label('visible', 'Si') !!}
            </div>
        </div>
    </div>           
</div>     
<div class="row">
    <div class="col-md-6 form-group">
        {!! Form::label('subtitulo', 'SubTitulo') !!}
        {!! Form::text('subtitulo', $novedad->subtitulo, array('class' => 'form-control')) !!}                    
    </div>    
    <div class="col-md-6 form-group">
        {!! Form::label('img', 'Imagen Actual') !!}
        <div class="row">
            <div class="col-md-12 imgActual">
                @if($novedad->imagen != '')
                @if(file_exists(public_path().'/'.$novedad->imagen))
                {!! HTML::image('/'.$novedad->imagen, $novedad->titulo, array('class'=>'img-responsive', 'title'=>$novedad->titulo, 'width'=>'340px')) !!}                        
                @else
                {!! HTML::image('/img/novedades/sin-imagen.png', $novedad->titulo, array('class'=>'img-responsive', 'title'=>$novedad->titulo, 'width'=>'340px')) !!}
                @endif                                            
                @else
                {!! HTML::image('/img/novedades/sin-imagen.png', $novedad->titulo, array('class'=>'img-responsive', 'title'=>$novedad->titulo, 'width'=>'340px')) !!}
                @endif                  
            </div>
        </div>
        {!! Form::label('img', 'Cambiar Imagen') !!}
        <div class="row">
            <div class="col-md-12">
                {!! Form::file('imagen', array('class' => 'form-control')) !!}                    
            </div>
        </div>                      
    </div>
</div>
<div class="row">
    <div class="col-md-6 form-group" id="texto_novedad">
        {!! Form::label('texto', 'Texto') !!}
        {!! Form::textarea('texto', $novedad->texto, array('class' => 'form-control')) !!}                    
    </div>       
    <div class="col-md-2 form-group">
        {!! Form::label('es_producto', 'Es Producto') !!}
        <div class="input-group">
            <div class="input-group-addon">            
                {!! Form::checkbox('es_producto', 1, $novedad->es_producto) !!}
            </div>    
            <div class="form-control">
                {!! Form::label('es_producto', 'Si') !!}
            </div>
        </div>
    </div>   
    <div class="col-md-6 form-group" id="url_producto" style="display:none;">
        {!! Form::label('url', 'Link al Producto') !!}
        {!! Form::text('url', $novedad->f_url, array('class' => 'form-control')) !!}                    
    </div>      
</div>