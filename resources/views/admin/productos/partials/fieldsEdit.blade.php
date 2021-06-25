<input type="hidden" name="id" value="{{$producto->id}}"/>
<div class="row">
    <div class="col-md-4 form-group">
        {!! Form::label('codigo', 'Codigo Producto') !!}
        {!! Form::text('codigo', null, array('class' => 'form-control')) !!}
    </div>
    <div class="col-md-2 form-group">
        {!! Form::label('activo', 'Producto Activo?') !!}
        <div class="input-group">
            <div class="input-group-addon">
                {!! Form::checkbox('activo', 1, $producto->activo) !!}
            </div>
            <div class="form-control">
                {!! Form::label('activo', 'Si') !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 form-group">
        {!! Form::label('nombre', 'Nombre') !!}
        {!! Form::text('nombre', null, array('class' => 'form-control')) !!}
    </div>
    <div class="col-md-4 form-group">
        {!! Form::label('precio', 'Precio') !!}
        {!! Form::text('precio', null, array('class' => 'form-control')) !!}
    </div>
    <div class="col-md-4 form-group">
        {!! Form::label('iva', 'I.V.A.') !!}
        {!! Form::text('iva', null, array('class' => 'form-control')) !!}
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
    <div class="col-md-4 form-group">
        {!! Form::label('stock', 'Stock') !!}
        {!! Form::text('stock', null, array('class' => 'form-control')) !!}
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
        {!! Form::label('imagen', 'Imagen Actual') !!}
        <div class="row">
            <div class="col-md-12 imgActual" style="text-align: center;">
                @if($producto->imagen != '')
                    @if(file_exists(public_path().'/img/productos/'.$producto->imagen))
                        {!! HTML::image('/img/productos/'.$producto->imagen, $producto->nombre, array('class'=>'img-responsive', 'title'=>$producto->nombre, 'width'=>'255px')) !!}
                    @else
                        {!! HTML::image('/img/productos/sin-imagen.png', $producto->nombre, array('class'=>'img-responsive', 'title'=>$producto->nombre, 'width'=>'255px')) !!}
                    @endif
                @elseif(file_exists(public_path().'/img/productos/'.$producto->codigo.'.jpg'))
                    {!! HTML::image('/img/productos/'.$producto->codigo.'.jpg', $producto->nombre, array('class'=>'img-responsive', 'title'=>$producto->nombre, 'width'=>'255px')) !!}
                @else
                    {!! HTML::image('/img/productos/sin-imagen.png', $producto->nombre, array('class'=>'img-responsive', 'title'=>$producto->nombre, 'width'=>'255px')) !!}
                @endif
            </div>
        </div>
        {!! Form::label('imagen', 'Cambiar Imagen') !!}
        <div class="row">
            <div class="col-md-12">
                {!! Form::file('imagen', array('class' => 'form-control')) !!}
            </div>
        </div>
    </div>
</div>   