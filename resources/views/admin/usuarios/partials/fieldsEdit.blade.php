<div class="row">
    <div class="col-md-3 form-group">
        {!! Form::label('username', 'Usuario') !!}
        {!! Form::text('username', null, array('class' => 'form-control')) !!}                    
    </div>      
    <div class="col-md-3 form-group">
        {!! Form::label('nombre', 'Nombre') !!}
        {!! Form::text('nombre', null, array('class' => 'form-control')) !!}                    
    </div>      
    <div class="col-md-3 form-group">
        {!! Form::label('apellido', 'Apellido') !!}
        {!! Form::text('apellido', null, array('class' => 'form-control')) !!}                    
    </div>      
    <div class="col-md-3 form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email', null, array('class' => 'form-control')) !!}                    
    </div>      
</div>    
<div class="row">   
    <div class="col-md-3 form-group">
        {!! Form::label('rol', 'Rol') !!}        
        @if(isset($userRol))
        {!! Form::select('rol', ['0' => 'Seleccionar..']+$roles, $userRol->id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('rol', ['0' => 'Seleccionar..']+$roles, null, ['class' => 'form-control']) !!}
        @endif
    </div>  
</div>        