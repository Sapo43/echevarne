

 $(document).on('click', '.pagination a', function(event)
{

  
   
  event.preventDefault(); 
  
  
  
  var indexs =$('.pagination li.active').index()
  $('.pagination li.active').removeClass('active');
 



  
 

  var page = $(this).attr('href').split('page=')[1];

  $('.pagination').parent().find(".pagination li").eq(page).addClass('active');
  fetch_data(page);
 });

 function fetch_data(page)
 {
    var type_selected="";
    if(document.getElementById("type")==null){
        type_selected = "Lista"
        sessionStorage.Tipo = type_selected; 
    }else{
        if (sessionStorage.Tipo==undefined){
            var type = document.getElementById("type");   
            type_selected = type.options[type.selectedIndex].value;
            sessionStorage.Tipo =  type.options[type.selectedIndex].value;
            
        }else{                 
            let tipo = document.getElementById("type");                      
                tipo.value = sessionStorage.Tipo;
                type_selected = sessionStorage.Tipo; 

        }
        
    }


    

   var type = document.getElementById("type");      
   var rubro = $('#rubro').val();
   var marca = $('#marca').val();
   var equivalencia = $('#equivalencia').val();
   var nombre = $('#nombre').val();

    if (rubro==0&marca==0&equivalencia==""&nombre==""){
            busqueda=false;
    }else{busqueda=true;}

    $.ajax(
    {
        url: '?page=' + page,
        data: {
            type:type_selected, 
            'rubro':rubro,
                     'marca':marca,   
                    'equivalencia':equivalencia,
                    'nombre':nombre,
                    
             
        },
      
        datatype: "html"
    }).done(function(data){
        var activeView=$('.layout-switcher li.active').data("layout");
        areaWrap = $(".product-layout");
         $('#table_data').html(data);
         $('.countBusqueda').css('display', 'block');   
         if(sessionStorage.Tipo=='Compra'){
            $('.precioVenta').css('display', 'none');
            $('.precioLista').css('display', 'none');
            $('.precioCompra').css('display', 'block');
            
           
        } 
        if(sessionStorage.Tipo=='Venta'){
            $('.precioCompra').css('display', 'none');
            $('.precioLista').css('display', 'none');
            $('.precioVenta').css('display', 'block');
           
        } 
        if(sessionStorage.Tipo=='Lista'){
            $('.precioVenta').css('display', 'none');
            $('.precioCompra').css('display', 'none');
            $('.precioLista').css('display', 'block');
           
        }
     
         if(busqueda){
            $('#linksShopContent').css('display', 'none');
            $('#linksShopGrid').css('display', 'block');
         }else{
            $('#linksShopContent').css('display', 'block');
         }
         
               
     
      
     
         $('.layout-switcher li.active').removeClass('active');
         $('.layout-switcher').find("[data-layout='"+activeView+"']").addClass('active'); 
          
                  areaWrap.removeClass('layout-grid layout-list').addClass('layout-' + activeView);


                
     
    })



 }
 
