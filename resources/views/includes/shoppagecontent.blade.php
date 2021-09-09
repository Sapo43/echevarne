
 {{ request()->cookie('nombre') }}
<div class="page-content-wrapper sp-y">
        <div class="container container-wide">
            <div class="row">
                <div class="col-lg-3 order-1 order-lg-0">
                
                <!--== Start Page Header Area ==-->
    @include('includes.sidebarshop')
    <!--== End Page Header Area ==-->

                <div class="col-lg-9 order-0 order-lg-1">
              
                    <div class="action-bar-inner mb-30">
                         <!-- Abre row  de filtros--> 
                

                    <div class="row align-items-center">
                        @if(!isset($novedad))
                        <div class="col-sm-3">
                        <label >Marcas :</label>
                                <div class="sort-by-wrapper">                         
                                {!! Form::select('marca', ['0' => 'Todas']+$marcas, null, array('class' => 'form-control','id'=>'marca')) !!}
                                </div>
                        </div>
                        <div class="col-sm-3">
                        <label >Rubros :</label>
                            <div class="sort-by-wrapper">              
                                {!! Form::select('rubro', ['0' => 'Todos']+$rubros, null, array('class' => 'form-control','id'=>'rubro')) !!}
                            </div>
                        </div>
                        <div class="col-sm-2">
                        <label >Codigo :</label>
                                    <div class="sort-by-wrapper">                 
                                        <input class="form-control" id="equivalencia"name="equivalencia" type="text" placeholder="Codigo">
                                    </div>
                        </div>
                        @else
                        @if($marca==0)    
                        <div class="col-sm-3">
                        <label >Marcas :</label>
                                <div class="sort-by-wrapper">                         
                                {!! Form::select('marca', ['0' => 'Todas']+$marcas, null, array('class' => 'form-control','id'=>'marca')) !!}
                                </div>
                        </div>
                        @else
                        <div class="col-sm-3">
                        <label >Marcas :</label>
                                <div class="sort-by-wrapper">                         
                                {!! Form::select('marca', [$marca => $marcatxt]+['0' => 'Todas']+$marcas, null, array('class' => 'form-control','id'=>'marca')) !!}
                                </div>
                        </div>
                        @endif
                        @if($rubro==0)
                        <div class="col-sm-3">
                        <label >Rubros :</label>
                            <div class="sort-by-wrapper">              
                                {!! Form::select('rubro', ['0' => 'Todos']+$rubros, null, array('class' => 'form-control','id'=>'rubro')) !!}
                            </div>
                        </div>

                        @else
                       
                        <div class="col-sm-3">
                        <label >Rubros :</label>
                            <div class="sort-by-wrapper">              
                                {!! Form::select('rubro', [$rubro => $rubrotxt]+['0' => 'Todos']+$rubros, null, array('class' => 'form-control','id'=>'rubro')) !!}
                            </div>
                        </div>
                        @endif
                 
                        @if($codigo=='')
                        <div class="col-sm-2">
                        <label >Codigo :</label>
                                    <div class="sort-by-wrapper">                 
                                        <input class="form-control" id="equivalencia"name="equivalencia" type="text" placeholder="Codigo">
                                    </div>
                        </div>
                        @else
                        <div class="col-sm-2">
                        <label >Codigo :</label>
                                    <div class="sort-by-wrapper">                 
                                        <input class="form-control" id="equivalencia"name="equivalencia" type="text" placeholder="Codigo" value='{{$codigo}}'>
                                    </div>
                        </div>
                        @endif



                        @endif
                        
                        <div class="col-sm-2">
                        <label >Descripción :</label>
                                    <div class="sort-by-wrapper">                 
                                        <input class="form-control" id="nombre"name="nombre" type="text" placeholder="Descripción">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                <label ></label>
                                    <div class="sort-by-wrapper">                 
                                    <a onclick="f()"href="#" id="search" name="search" class="btn-echevarne3 form-control">
              
              <i class="fa fa-search"></i>  
              </a>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                <label ></label>
                                    <div class="sort-by-wrapper">                 
                                    <a href="#" id="clear" name="clear" class="btn-echevarne3 form-control">
              
              <i class="fa fa-times" style="font-size:20px;"></i>  
              </a>
                                    </div>
                                </div>
                        </div>

                            <!-- Cierro row -->
                        <div class="row align-items-center">
                        <div class="col-sm-6">
                        </div>
                            @if(\Auth::check())
                            @if(\Auth::user()->porcentaje_compra>0 || \Auth::user()->porcentaje_venta>0)  
                            <div class="col-sm-3">
                                <div class="sort-by-wrapper">
                                    <label for="sort" class="sr-only">Sort By</label>
                                    <select name="sort" id="type" class="form-control">
                                        <option value="Lista">Ver precio lista</option>
                                        <option value="Compra">Ver precio compra</option>
                                        <option value="Venta">Ver precio venta</option>
                                    </select>
                                </div>
                            </div>
                               @else       
                               <div class="col-sm-3"></div>
                          
                         @endif
                         @else       
                               <div class="col-sm-3"></div>
                          
                         @endif
                         <br>
                         <div class="col-sm-3">
                                <div class="row align-items-center">
                                    <div class="shop-layout-switcher mb-30 mb-sm-0">
                                        <ul class="layout-switcher nav" style="margin-left:15px">
                                        <li data-layout="grid" class="active"><i class="fa fa-th"></i></li>
                                        <li data-layout="list"><i class="fa fa-th-list"></i></li>                                     
                                        </ul>                                  
                                    </div>
                                    <br>
                                    <br>
                                    <div class="">
                                        <ul class="nav" style="margin-left:15px">
                                            <li><i class="fa fa-download downloadpdf"></i></li>                                                                      
                                        </ul>                                  
                                    </div>
                           
                                </div>
                                
                            </div>

                         </div>
    



                    </div>


                    <div class="product-wrapper product-layout layout-grid">
                    <div id="table_data"> 
                       
                    <div class="index" >
                    @if($count>1)
<h5>Se encontraron {{$count}} productos</h5>
@else
<h5>Se encontro {{$count}} producto</h5>
@endif
                    </div>
                    <br>
                    
                            @include('includes.shopgrid')
                          
                           
                  

                    <!-- abro links -->
                    <div id="linksShopContent" >  
                        <div class="shop-page-action-bar mt-30">
                            <div class="container container-wide">
                                <div class="action-bar-inner">
                                    <div class="row align-items-center">
                                        <div class="col-sm-3 col-md-3">

                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <nav class="pagination-wrap mb-10 mb-sm-0">                                            
                                             {!! $data->links('includes.paginator') !!}                             
                                            </nav>
                                        </div>  
                                        <div class="col-sm-3 col-md-3">
                                            </div>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- cierro links -->
                </div>
            </div>
        </div>
    </div>


   



     
   
    