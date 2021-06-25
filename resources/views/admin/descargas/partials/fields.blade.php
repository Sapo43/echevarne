<div class="row">
    <div class="col-md-6 form-group">
        {!! Form::label('nombre', 'Nombre') !!}
        {!! Form::text('nombre', null, array('class' => 'form-control')) !!}                    
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
    <div class="col-md-4 form-group">
        {!! Form::label('tipo_archivo', 'Tipo Archivo') !!}
        {!! Form::text('tipo_archivo', null, array('class' => 'form-control')) !!}                    
    </div>    
    <div class="col-md-4 form-group">
        {!! Form::label('peso', 'Tamaño') !!}
        {!! Form::text('peso', null, array('class' => 'form-control')) !!}                    
    </div>    
    <div class="col-md-4 form-group">
        {!! Form::label('version', 'Versión') !!}
        {!! Form::text('version', null, array('class' => 'form-control')) !!}                    
    </div>    
    <div class="col-md-6 form-group">
        {!! Form::label('imagen', 'Imagen') !!}
        {!! Form::file('imagen', array('class' => 'form-control')) !!}                    
    </div>
    <div class="col-md-6 form-group">
        {!! Form::label('archivo', 'Archivo') !!}
        {!! Form::file('archivo', array('class' => 'form-control')) !!}                    
    </div>    
</div>