function selectByName(slug,cantidad) { 
    
  cantidad = (typeof cantidad !== 'undefined') ?  cantidad : 1
  


 

 $.ajax({
   url: '/cart/add/'+slug+'/'+cantidad,
 type : 'GET',
   success: function(respuesta) {

  
     iziToast.show({
   title: 'Ok',
   color: 'green', 
   message: respuesta.msg,
   timeout: 2000,
});

if($('#qtyCart').html()=='') {
  $('#qtyCart').html('1');
}else{
  $('#qtyCart').html(parseInt($('#qtyCart').html())+parseInt(respuesta.cantidad));
}


var a=document.getElementById('btn-mini-cart');
if(a.getAttribute("href")=='/shop'){
  a.href="/cart";
  document.getElementById('qtyCart').style.display = 'block';
}
   

  getminicart();
 
   },
   error: function() {
       console.log("No se ha podido obtener la información");
   }
});
 
}




