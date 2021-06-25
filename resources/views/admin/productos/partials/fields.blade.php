<div class="row">
    <div class="col-md-4 form-group">
        {!! Form::label('codigo', 'Codigo Producto') !!}
        {!! Form::text('codigo', null, array('class' => 'form-control')) !!}                    
    </div>      
    <div class="col-md-2 form-group">
        {!! Form::label('activo', 'Producto Activo?') !!}
        <div class="input-group">
            <div class="input-group-addon">            
                {!! Form::checkbox('activo', 1, null) !!}
            </div>    
            <div class="form-control">
                {!! Form::label('activo', 'Si') !!}
            </div>
        </div>
    </div>           
</div>    
<div class="row">
    <div class="col-md-12 form-group">
        {!! Form::label('nombre', 'Nombre') !!}
        {!! Form::text('nombre', null, array('class' => 'form-control')) !!}                    
    </div>   
</div>
<div class="row">      
    <div class="col-md-4 form-group">
        {!! Form::label('rubro_id', 'Rubro') !!}
        {!! Form::select('rubro_id', ['0' => 'Seleccionar...']+  $rubros, null, ['class' => 'form-control']) !!}
    </div>      
    <div class="col-md-4 form-group">
        {!! Form::label('marca_id', 'Marca') !!}
        {!! Form::select('marca_id', ['0' => 'Ninguna']+  $marcas, null, ['class' => 'form-control']) !!}
    </div>  
</div>     
<div class="row">
    <div class="col-md-6 form-group">
        {!! Form::label('descripcion', 'Descripción') !!}
        {!! Form::textarea('descripcion', null, array('class' => 'form-control')) !!}                    
    </div>    
    <div class="col-md-6 form-group">
        {!! Form::label('notas', 'Notas') !!}
        {!! Form::textarea('notas', null, array('class' => 'form-control')) !!}                    
    </div>       
</div>
<div class="row">
    <div class="col-md-4 form-group">
        {!! Form::label('imagen', 'Imagen') !!}
        <div class="row">
            <div class="col-md-12">
                {!! Form::file('imagen', array('class' => 'form-control')) !!}               
            </div>
        </div>          
    </div>         
</div>   