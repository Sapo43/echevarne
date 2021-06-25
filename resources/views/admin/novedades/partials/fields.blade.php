<div class="row">
    <div class="col-md-6 form-group">
        {!! Form::label('titulo', 'Titulo') !!}
        {!! Form::text('titulo', null, array('class' => 'form-control')) !!}                    
    </div>         
    <div class="col-md-2 form-group">
        {!! Form::label('visible', 'Es Visible') !!}
        <div class="input-group">
            <div class="input-group-addon">            
                {!! Form::checkbox('visible', 1, null) !!}
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
        {!! Form::text('subtitulo', null, array('class' => 'form-control')) !!}                    
    </div>    
    <div class="col-md-6 form-group">
        {!! Form::label('imagen', 'Imagen') !!}
        {!! Form::file('imagen', array('class' => 'form-control')) !!}                    
    </div>
</div>
<div class="row">
    <div class="col-md-6 form-group" id="texto_novedad">
        {!! Form::label('texto', 'Texto') !!}
        {!! Form::textarea('texto', null, array('class' => 'form-control')) !!}                    
    </div>       
    <div class="col-md-2 form-group">
        {!! Form::label('es_producto', 'Es Producto') !!}
        <div class="input-group">
            <div class="input-group-addon">            
                {!! Form::checkbox('es_producto', 1, null) !!}
            </div>    
            <div class="form-control">
                {!! Form::label('es_producto', 'Si') !!}
            </div>
        </div>
    </div>   
    <div class="col-md-6 form-group" id="url_producto" style="display:none;">
        {!! Form::label('url', 'Link al Producto') !!}
        {!! Form::text('url', null, array('class' => 'form-control')) !!}                    
    </div>      
</div>