$(document).ready(function(){


    if (sessionStorage.Tipo==undefined){
        var type = document.getElementById("type");      
    var type_selected = type.options[type.selectedIndex].value;
    sessionStorage.Tipo = type_selected;
    }else{
        let tipo = document.getElementById("type");
            tipo.value = sessionStorage.Tipo;
    }

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
        }) 

$('body').on('change','#type', function() {      
    console.log("Session en el cliente"+sessionStorage.Tipo);
        var type = document.getElementById("type");      
        var type_selected = type.options[type.selectedIndex].value;
        sessionStorage.Tipo=type_selected;
        console.log("Session en el cliente 2"+sessionStorage.Tipo);
            if(type_selected=='Compra'){
                $('.precioVenta').css('display', 'none');
                $('.precioLista').css('display', 'none');
                $('.precioCompra').css('display', 'block');
            } 
            if(type_selected=='Venta'){
                $('.precioCompra').css('display', 'none');
                $('.precioLista').css('display', 'none');
                $('.precioVenta').css('display', 'block');
                
            } 
            if(type_selected=='Lista'){
                $('.precioVenta').css('display', 'none');
                $('.precioCompra').css('display', 'none');
                $('.precioLista').css('display', 'block');
            } 
           
    
        })


