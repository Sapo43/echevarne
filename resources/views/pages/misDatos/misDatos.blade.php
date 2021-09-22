<div class="row">
                            <div class="col-12">
                                <div class="product-description-review">
                                    <!-- Product Description Tab Menu -->
                                    <ul class="nav nav-tabs desc-review-tab-menu" id="desc-review-tab" role="tablist">
                                        <li>
                                            <a class="active" id="desc-tab" data-toggle="tab" href="#misdatosContent" role="tab">MIS DATOS</a>
                                        </li>
                                        <li>
                                        <a id="password-tab" data-toggle="tab" href="#passwordTab">CONTRASEÑA</a>
                                        </li>
                                        <li>
                                        <a id="profile-tab" data-toggle="tab" href="#pedidosContent">MIS PEDIDOS</a>
                                       
                                        </li>
                                    </ul>

                                    <!-- Product Description Tab Content -->
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="misdatosContent">
                                            <div class="description-content">
                                            <h4></h4>
                                            <div class="row">
                    <div class="col-lg-3">
                        </div>
                             <div class="col-lg-6">
                       
                        <div class="checkout-billing-details-wrap">
                         
                            <div class="billing-form-wrap">
                                <form action="/misDatos/{{\Auth::user()->id}}" method="post">
                                @csrf
                                    <div class="row">
                                        <input type="hidden" class="form-control" value="{{\Auth::user()->id}}">
                                        <div class="col-md-6">
                                            <div class="input-item mt-0">
                                                <label for="nombre" class="">Nombre</label>
                                                <input type="text"  class="form-control" id="nombre" name="nombre" placeholder="Nombre" required value="{{\Auth::user()->nombre}}"/>
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-item mt-md-0">
                                                <label for="apellido" class="">Apellido</label>
                                                <input class="form-control" type="text" id="apellido" name="apellido" placeholder="Apellido" required value="{{\Auth::user()->apellido}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-item">
                                        <label for="dni" class="">DNI</label>
                                        <input class="form-control" type="dni" id="dni" name="dni" placeholder="DNI" required value="{{\Auth::user()->dni}}" />
                                    </div>
                                    <div class="input-item">
                                        <label for="cuit" class="">Cuit </label>
                                        <input class="form-control" type="cuit" id="cuit" name="cuit" placeholder="Cuit" required value="{{\Auth::user()->cuit}}" />
                                    </div>
                                    <div class="input-item">
                                        <label for="email" class="">Email </label>
                                        <input  class="form-control" type="email" id="email" name="email" placeholder="Email" value="{{\Auth::user()->email}}" readonly/>
                                    </div>                             

                                    

                                    <div class="input-item">
                                        <label for="street-address" class="">Dirección</label>
                                        <input class="form-control" type="text" id="direccion" name="direccion" placeholder="Dirección" required  value="{{\Auth::user()->direccion}}"/>
                                    </div>

                                

                                    <div class="input-item">
                                        <label for="town" class="">Ciudad</label>
                                        <input class="form-control" type="text" id="ciudad" name="ciudad" placeholder="Ciudad" required value="{{\Auth::user()->ciudad}}"/>
                                    </div>

                                

                                    <div class="input-item">
                                        <label for="postcode" class="">Codigo postal</label>
                                        <input class="form-control" type="text" id="codigo_postal" name="codigo_postal" placeholder="Codigo postal" required value="{{\Auth::user()->codigo_postal}}"/>
                                    </div>

                                    <div class="input-item">
                                        <label for="phone" class="">Telefono</label>
                                        <input  class="form-control" type="text" id="telefono"name="telefono" placeholder="telefono" value="{{\Auth::user()->telefono}}" />
                                    </div>

                                    @if(\Auth::user()->porcentaje_venta>0)
                                 
                                    <div class="input-item">
                                        <label for="phone" class="">Porcentaje Venta</label>
                                        <input class="form-control" type="text" id="porcentaje_venta"name="porcentaje_venta" placeholder="porcentaje venta" value="{{\Auth::user()->porcentaje_venta}}" />
                                    </div>
                                    @endif
                                    @if(\Auth::user()->porcentaje_compra>0)
                                    <div class="input-item">
                                        <label for="phone" class="">Porcentaje Compra</label>
                                        <input class="form-control" type="text" id="porcentaje_compra"name="porcentaje_compra" placeholder="porcentaje compra" value="{{\Auth::user()->porcentaje_compra}}" />
                                    </div>
                                    @endif
                                    <button type="submit" class="btn btn-bordered mt-40">Guardar</button>     
</form>
                                <br>
                            </div>
                        </div>
                    </div>

</div>

                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pedidosContent">
                                            <div class="product-rating-wrap">
                                                <div class="average-rating">
                                                    <h4>Detalle de pedidos realizados</h4>
                                                    
                                                </div>
            <!-- tabla -->

                <div class="table">
            @include('pages.misDatos.tablaPedidos')         
            </div>


            <!-- cierro tabla -->


            
                                                
                                            </div>
                                            <!-- cierro tab -->
                                            
                                        </div>
                                        <div class="tab-pane fade" id="passwordTab">
                                            <div class="product-rating-wrap">
                                                <div class="average-rating">
                                                
                                                    
                                                </div>
                                                <div class="row contacto">
        <div class="col-xs-12 col-sm-2 col-md-2 col-wop-l">
         
        </div>
        <div class="col-xs-12 col-sm-10 col-md-10 col-wop-r-xs contactoWrapper">
            <div class="row camposWrapper">
                <div class="col-md-12">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                                <span style="text-transform: capitalize;">&nbsp;{{$error}}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
                {!! Form::model($cliente, ['route' => ['miCuenta.update.password', $cliente->id], 'method' => 'PUT'])!!}
                <div class="row">
                    <div class="col-md-3 form-group">
                        {!! Form::label('contraseña_actual', 'Contraseña Actual') !!}
                        {!! Form::password('contraseña_actual', array('class' => 'form-control tlp', 'title' => 'Ingrese aquí la contraseña que utilizo para ingresar al Sistema')) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 form-group">
                        {!! Form::label('contraseña', 'Nueva Contraseña') !!}
                        {!! Form::password('contraseña', array('class' => 'form-control tlp', 'title' => 'Ingrese aquí su nueva contraseña. Recuerde que la misma debe estar compuesta por letras y números')) !!}
                    </div>
                    <div class="col-md-3 form-group">
                        {!! Form::label('contraseña_rep', 'Repetir Contraseña') !!}
                        {!! Form::password('contraseña_rep', array('class' => 'form-control tlp', 'title' => 'Repita aquí su nueva contraseña')) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="  text-align: right;">
                        <a href="{{ route('home') }}" class="btn btn-default">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;
                            Cancelar
                        </a>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>&nbsp;
                            Guardar
                        </button>
                    </div>
                </div>
                {!! Form::hidden('clienteId', $cliente->id, array('id'=>'clienteId')) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
            </div>
                                                
                                            </div>
                                        </div>

                                        
                                </div>
                            </div>
                        </div>