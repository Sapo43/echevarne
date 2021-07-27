

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
                                 <div class="col-sm-3">
                                 <div class="sort-by-wrapper">
                 
                  
                    {!! Form::select('marca', ['0' => 'Todas']+$marcas, null, array('class' => 'form-control','id'=>'marca')) !!}
                    </div>
                                </div>
                                <div class="col-sm-3">
                                <div class="sort-by-wrapper">
              
                    {!! Form::select('rubro', ['0' => 'Todos']+$rubros, null, array('class' => 'form-control','id'=>'rubro')) !!}
                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="sort-by-wrapper">                 
                                        <input class="form-control" id="equivalencia"name="equivalencia" type="text" placeholder="Equivalencia">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="sort-by-wrapper">                 
                                        <input class="form-control" id="nombre"name="nombre" type="text" placeholder="Descripción">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="sort-by-wrapper">                 
                                    <a href="#" id="search" name="search" class="btn-echevarne3 form-control">
              
              <i class="fa fa-search"></i>  
              </a>
                                    </div>
                                </div>
                                <div class="col-sm-1">
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
                            <div class="col-sm-3">
                                <div class="sort-by-wrapper">
                                    <label for="sort" class="sr-only">Sort By</label>
                                    <select name="sort" id="type">
                                        <option value="Lista">Ver precio lista</option>
                                        <option value="Compra">Ver precio compra</option>
                                        <option value="Venta">Ver precio venta</option>
                                    </select>
                                </div>
                            </div>
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
                       
                        
                    
                            @include('includes.shopgrid')
                          
                           
                  

                    <!-- abro links -->
                    <div id="linksShopContent" >  
                        <div class="action-bar-inner mt-30">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <nav class="pagination-wrap mb-10 mb-sm-0">                                            
                                    {!! $data->links('includes.paginator') !!}                             
                                    </nav>
                                </div>                          
                            </div>
                        </div>
                    </div>
                    <!-- cierro links -->
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade " id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Producto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



     
   
    