<div class="row">
    @foreach ($permisos as $key => $permisoGroups)
    <div class="col-md-3 form-group grupo">
        <fieldset>
            <legend>{{$key}}</legend>            
            <ul>
                @foreach ($permisoGroups as $permiso)                  
                <li>
                    <div class="input-group">
                        <div class="input-group-addon">
                            {!! Form::checkbox('perm_'.$permiso->id, $permiso->id, null) !!}        
                        </div>
                        <div class="form-control">
                            {!! Form::label($permiso->id, $permiso->display_name) !!}            
                        </div>
                    </div>
                </li>    
                @endforeach
            </ul>
        </fieldset>
    </div>     
    @endforeach
</div>        
