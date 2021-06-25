<div class="row">                   
    <div class="col-md-4 form-group">
        {!! Form::label('padre', 'Padre') !!}
        {!! Form::select('padre', ['0' => 'Ninguno']+$menus, null, ['class' => 'form-control']) !!}
    </div>                                     
    <div class="col-md-4 form-group">
        {!! Form::label('nombre', 'Nombre') !!}
        {!! Form::text('nombre', null, array('class' => 'form-control')) !!}                    
    </div>    
    <div class="col-md-3 form-group">
        {!! Form::label('url_type', 'Url Type') !!}
        {!! Form::select('url_type', ['' => '', 'route' => 'route', 'action' => 'action'], null, ['class' => 'form-control']) !!}
    </div>         
</div>   
<div class="row">                    
    <div class="col-md-6 form-group">
        {!! Form::label('url', 'Url') !!}
        {!! Form::text('url', null, array('class' => 'form-control')) !!}                    
    </div>                    
</div>   