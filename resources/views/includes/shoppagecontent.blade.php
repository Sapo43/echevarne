

<div class="page-content-wrapper sp-y">
        <div class="container container-wide">
            <div class="row">
                <div class="col-lg-3 order-1 order-lg-0">
                
                <!--== Start Page Header Area ==-->
    @include('includes.sidebarshop')
    <!--== End Page Header Area ==-->

                <div class="col-lg-9 order-0 order-lg-1">
                    <div class="action-bar-inner mb-30">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="shop-layout-switcher mb-15 mb-sm-0">
                                    <ul class="layout-switcher nav">
                                        <li data-layout="grid" class="active"><i class="fa fa-th"></i></li>
                                        <li data-layout="list"><i class="fa fa-th-list"></i></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="sort-by-wrapper">
                                    <label for="sort" class="sr-only">Sort By</label>
                                    <select name="sort" id="sort">
                                        <option value="sbp">Sort By Popularity</option>
                                        <option value="sbn">Sort By Newest</option>
                                        <option value="sbt">Sort By Trending</option>
                                        <option value="sbr">Sort By Rating</option>
                                    </select>
                                </div>
                            </div>
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


                        </div>
                    </div>
                    <div class="product-wrapper product-layout layout-grid">
                    <div id="table_data"> 
                       
                        
                    
                            @include('includes.shopgrid')
                          
                            </div>
                            </div>
                  


                    <div class="action-bar-inner mt-30">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <nav class="pagination-wrap mb-10 mb-sm-0">
                                  
                                    {!! $data->links('includes.paginator') !!}
                                </nav>
                            </div>

                            <div class="col-sm-6 text-center text-sm-right">
                                <p>Showing 1–12 of 26 results</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
$(document).ready(function(){

 $(document).on('click', '.pagination a', function(event){
   
  event.preventDefault(); 
  
  
  
  var indexs =$('.pagination li.active').index()
  $('.pagination li.active').removeClass('active');
 



  
 

  var page = $(this).attr('href').split('page=')[1];

  $('.pagination').parent().find(".pagination li").eq(page).addClass('active');
  fetch_data(page);
 });

 function fetch_data(page)
 {
  $.ajax({
   url:"/shop/fetch_data?page="+page,
   success:function(data)
   {
       
   var activeView=$('.layout-switcher li.active').data("layout");
   areaWrap = $(".product-layout");
    $('#table_data').html(data);
   
          

 

    $('.layout-switcher li.active').removeClass('active');
    $('.layout-switcher').find("[data-layout='"+activeView+"']").addClass('active'); 
        console.log("acv "+activeView)
             areaWrap.removeClass('layout-grid layout-list').addClass('layout-' + activeView);
           

  
   }
  });
 }
 
});
</script>