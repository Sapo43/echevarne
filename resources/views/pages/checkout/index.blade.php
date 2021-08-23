@extends('layouts.default')

@section('content')




  <!--== Start Page Content Wrapper ==-->
  <div class="page-content-wrapper sp-y">
        <div class="cart-page-content-wrap">
            <div class="container container-wide">
                <div class="row">
                    <div class="col-12">
                        <div class="checkout-page-coupon-area">
@if(\Auth::user()->vendedor)
                            <!-- Checkout Coupon Accordion Start -->
                            <div class="checkoutAccordion" id="checkOutAccordion">
                                <div class="card">
                                     <h3><i class="fa fa-info-circle"></i> Pedir a nombre de un cliente? <span data-toggle="collapse" data-target="#couponaccordion">
                                    Seleccionar cliente</span>
                                    </h3> 
                                    <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="apply-coupon-wrapper">
                                                        <p></p>
                                                        <form action="#" method="post">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                <div class="col-md-6">
    <div class="form-group  sort-by-wrapper">
      
        <input id="custom_field1" name="custom_field1" type="text" list="custom_field1_datalist" class="form-control" placeholder="Cliente">
        <datalist id="custom_field1_datalist" class="sort-by-wrapper">
            @foreach($clientes as $cliente)
                <option data-value="{{$cliente->id}}" value="{{$cliente->nombre }} {{$cliente->apellido}}">{{$cliente->dni}}</option>
            @endforeach
        </datalist>
        <span id="error" class="text-danger"></span>
    </div>
</div>
                                                                </div>

                                                                
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endif
                            <!-- Checkout Coupon Accordion End -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <!-- Checkout Form Area Start -->
                        <div class="checkout-billing-details-wrap">
                            <h2>Detalle de Facturación</h2>
                            <div class="billing-form-wrap">
                                <form action="#" method="post">
                                    <div class="row">
                                        <input type="hidden" class="form-control" value="{{\Auth::user()->id}}">
                                        <div class="col-md-6">
                                            <div class="input-item mt-0">
                                                <label for="nombre" class="sr-only required">Nombre</label>

                                                <input type="text" id="nombre" placeholder="Nombre" required value="{{\Auth::user()->nombre}}"/>
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-item mt-md-0">
                                                <label for="l_name" class="sr-only required">Apellido</label>
                                                <input type="text" id="apellido" placeholder="Apellido" required value="{{\Auth::user()->apellido}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-item">
                                        <label for="cuit" class="sr-only required">Cuit </label>
                                        <input type="cuit" id="cuit" placeholder="Cuit" required value="{{\Auth::user()->cuit}}" />
                                    </div>
                                    <div class="input-item">
                                        <label for="email" class="sr-only required">Email </label>
                                        <input type="email" id="email" placeholder="Email" value="{{\Auth::user()->email}}" readonly/>
                                    </div>                             

                                    

                                    <div class="input-item">
                                        <label for="street-address" class="sr-only required">Dirección</label>
                                        <input type="text" id="direccion" placeholder="Dirección" required  value="{{\Auth::user()->direccion}}"/>
                                    </div>

                                

                                    <div class="input-item">
                                        <label for="town" class="sr-only required">Ciudad</label>
                                        <input type="text" id="ciudad" placeholder="Ciudad" required value="{{\Auth::user()->ciudad}}"/>
                                    </div>

                                

                                    <div class="input-item">
                                        <label for="postcode" class="sr-only required">Codigo postal</label>
                                        <input type="text" id="codigo_postal" placeholder="Codigo postal" required value="{{\Auth::user()->codigo_postal}}"/>
                                    </div>

                                    <div class="input-item">
                                        <label for="phone" class="sr-only">Telefono</label>
                                        <input type="text" id="telefono" placeholder="telefono" value="{{\Auth::user()->telefono}}" />
                                    </div>

                                    
                                    <div class="input-item">
                                        <label for="ordernote" class="sr-only">Nota</label>
                                        <textarea name="ordernote" id="notas" cols="30" rows="3" placeholder="Notas, por ejemplo datos de envio, retiro de pedido ..."></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-5 ml-auto">
                        <!-- Checkout Page Order Details -->
                        <div class="order-details-area-wrap">
                        <div class="row ">
                            <div class="col-sm-6">
                                <h2>Su Orden</h2>
                            </div>
                            @if(!$isAuthZero)
                            <div class="col-sm-6">
                                <div class="sort-by-wrapper">
                                    <label for="sort" class="sr-only">Sort By</label>
                                    <select class="form-control"name="sort" id="type">
                                        <option value="Lista">Ver precio lista</option>
                                        <option value="Compra">Ver precio compra</option>
                                        <option value="Venta">Ver precio venta</option>
                                    </select>
                                </div>
                            </div>
                                

                            @endif
                            </div>

                            <div class="order-details-table table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Productos</th>
                                            <th>Precio Unit.</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cart as $producto)
                                        <tr class="cart-item">
                                            <td><span class="product-title">{{$producto->codigo}} {{$producto->nombre}}</span> <span
                                            class="product-quantity">&#215; {{$producto->cantidad}}</span></td>
                                            <td>

@if($isAuthZero)
<h6 class="precioLista"><p>${{number_format( $producto->precio,2, ',','.')}}<p></h6> 
                                    
@else
<h6 class="precioLista"><p>${{number_format( $producto->precio*$producto->cantidad,2, ',','.')}}<p></h6> 
                        <h6 class="precioCompra"><p >${{number_format(($producto->precio- ($producto->precio* $porcentaje_compra  / 100)),2, ',','.')}}<p></h6>  
                        <h6 class="precioVenta"><p >${{number_format(($producto->precio- ($producto->precio* $porcentaje_compra  / 100)+( ($producto->precio- ($producto->precio* $porcentaje_compra  / 100)) * $porcentaje_venta  / 100)),2, ',','.')}}<p></h6>    
@endif

                                        </td>
                                            
                                            <td>

    @if($isAuthZero)
    <h6 class="precioLista"><p>${{number_format( $producto->precio*$producto->cantidad,2, ',','.')}}<p></h6> 
                                        
@else
<h6 class="precioLista"><p>${{number_format( $producto->precio*$producto->cantidad,2, ',','.')}}<p></h6> 
                            <h6 class="precioCompra"><p >${{number_format(($producto->precio- ($producto->precio* $porcentaje_compra  / 100))*$producto->cantidad,2, ',','.')}}<p></h6>  
                            <h6 class="precioVenta"><p >${{number_format(($producto->precio- ($producto->precio* $porcentaje_compra  / 100)+( ($producto->precio- ($producto->precio* $porcentaje_compra  / 100)) * $porcentaje_venta  / 100))*$producto->cantidad,2, ',','.')}}<p></h6>    
@endif

                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                    <tfoot>
                                         
                                        <tr class="final-total">
                                            <th>Subtotal </th>
                                            <td></td>
                                            <td>
                                            @if($isAuthZero)
    <h6 class="precioLista"><p>${{number_format( $totalsi*$producto->cantidad,2, ',','.')}}<p></h6> 
                                        
@else
<h6 class="precioLista"><p>${{number_format( $totalsi*$producto->cantidad,2, ',','.')}}<p></h6> 
                            <h6 class="precioCompra"><p >${{number_format(($totalsi- ($totalsi* $porcentaje_compra  / 100))*$producto->cantidad,2, ',','.')}}<p></h6>  
                            <h6 class="precioVenta"><p >${{number_format(($totalsi- ($totalsi* $porcentaje_compra  / 100)+( ($totalsi- ($totalsi* $porcentaje_compra  / 100)) * $porcentaje_venta  / 100))*$producto->cantidad,2, ',','.')}}<p></h6>    
@endif

                                           
                                        </tr>
                                        <tr class="final-total">
                                            <th>IVA 10,5%</th>
                                            <td></td>
                                            <td>
                                            @if($isAuthZero)
    <h6 class="precioLista"><p>${{number_format( $totalid*$producto->cantidad,2, ',','.')}}<p></h6> 
                                        
@else
<h6 class="precioLista"><p>${{number_format( $totalid*$producto->cantidad,2, ',','.')}}<p></h6> 
                            <h6 class="precioCompra"><p >${{number_format(($totalid- ($totalid* $porcentaje_compra  / 100))*$producto->cantidad,2, ',','.')}}<p></h6>  
                            <h6 class="precioVenta"><p >${{number_format(($totalid- ($totalid* $porcentaje_compra  / 100)+( ($totalid- ($totalid* $porcentaje_compra  / 100)) * $porcentaje_venta  / 100))*$producto->cantidad,2, ',','.')}}<p></h6>    
@endif
                                                <span class="total-amount"><b><strong>$</trong> {{number_format($totalid,2, ',','.')}}</b></span>
                                            
                                            </td>
                                        </tr>
                                        <tr class="final-total">
                                            <th>IVA 21%</th>
                                            <td></td>
                                            <td>

                                            @if($isAuthZero)
    <h6 class="precioLista"><p>${{number_format( $totaliv*$producto->cantidad,2, ',','.')}}<p></h6> 
                                        
@else
<h6 class="precioLista"><p>${{number_format( $totaliv*$producto->cantidad,2, ',','.')}}<p></h6> 
                            <h6 class="precioCompra"><p >${{number_format(($totaliv- ($totaliv* $porcentaje_compra  / 100))*$producto->cantidad,2, ',','.')}}<p></h6>  
                            <h6 class="precioVenta"><p >${{number_format(($totaliv- ($totaliv* $porcentaje_compra  / 100)+( ($totaliv- ($totaliv* $porcentaje_compra  / 100)) * $porcentaje_venta  / 100))*$producto->cantidad,2, ',','.')}}<p></h6>    
@endif
                                                <!-- <span class="total-amount"><b><strong>$</trong> {{number_format($totaliv,2, ',','.')}}</b></span> -->
                                            
                                            </td>
                                        </tr>
                                        <tr class="final-total">
                                            <th>Total</th>
                                            <td></td>
                                            <td>
                                            @if($isAuthZero)
    <h6 class="precioLista"><p>${{number_format( $totalci*$producto->cantidad,2, ',','.')}}<p></h6> 
                                        
@else
<h6 class="precioLista"><p>${{number_format( $totalci*$producto->cantidad,2, ',','.')}}<p></h6> 
                            <h6 class="precioCompra"><p >${{number_format(($totalci- ($totalci* $porcentaje_compra  / 100))*$producto->cantidad,2, ',','.')}}<p></h6>  
                            <h6 class="precioVenta"><p >${{number_format(($totalci- ($totalci* $porcentaje_compra  / 100)+( ($totalci- ($totalci* $porcentaje_compra  / 100)) * $porcentaje_venta  / 100))*$producto->cantidad,2, ',','.')}}<p></h6>    
@endif

                                            <!-- <span class="total-amount"><b><strong>$</trong> {{number_format($totalci,2, ',','.')}}</b></span> -->
                                            
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="order-details-footer">
                            

                                <button id="confirmar" class="btn btn-bordered mt-40">Generar Pedido</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== End Page Content Wrapper ==-->






   @endsection


