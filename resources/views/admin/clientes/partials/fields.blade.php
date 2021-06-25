<div class="row">
    <div class="col-md-3 form-group">
        {!! Form::label('nro_cliente', 'Nro Cliente') !!}
        {!! Form::text('nro_cliente', null, array('class' => 'form-control')) !!}
    </div>
    <div class="col-md-3 form-group">
        {!! Form::label('username', 'Usuario') !!}
        {!! Form::text('username', null, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-3 form-group">
        {!! Form::label('nombre', 'Nombre') !!}
        {!! Form::text('nombre', null, array('class' => 'form-control')) !!}   
    </div>
    <div class="col-md-3 form-group">
        {!! Form::label('apellido', 'Apellido') !!}
        {!! Form::text('apellido', null, array('class' => 'form-control')) !!}   
    </div>                        
    <div class="col-md-3 form-group">
        {!! Form::label('dni', 'DNI') !!}
        {!! Form::text('dni', null, array('class' => 'form-control dni')) !!}
    </div>
    <div class="col-md-3 form-group">
        {!! Form::label('cuit', 'CUIT') !!}
        {!! Form::text('cuit', null, array('class' => 'form-control cuit')) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-3 form-group">
        {!! Form::label('telefono', 'Telefono') !!}
        {!! Form::text('telefono', null, array('class' => 'form-control')) !!}                               
    </div>
    <div class="col-md-3 form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email', null, array('class' => 'form-control')) !!}                               
    </div>
    <div class="col-md-3">
        {!! Form::label('operatoria', 'Operatoria') !!}
        {!! Form::select('operatoria', $operatorias, null, ['class' => 'form-control']) !!}
    </div>
</div>