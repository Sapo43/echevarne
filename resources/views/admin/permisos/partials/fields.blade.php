<div class="row">
    <div class="col-md-3 form-group">
        {!! Form::label('grupo', 'Grupo') !!}
        {!! Form::text('grupo', null, array('class' => 'form-control')) !!}                    
    </div>    
    <div class="col-md-3 form-group">
        {!! Form::label('name', 'Nombre') !!}
        {!! Form::text('name', null, array('class' => 'form-control')) !!}                    
    </div>
    <div class="col-md-3 form-group">
        {!! Form::label('display_name', 'Nombre Completo') !!}
        {!! Form::text('display_name', null, array('class' => 'form-control')) !!}                                                            
    </div>
    <div class="col-md-3 form-group">
        {!! Form::label('description', 'Descripción del Permiso') !!}
        {!! Form::text('description', null, array('class' => 'form-control')) !!}                                                            
    </div>          
</div>        
    