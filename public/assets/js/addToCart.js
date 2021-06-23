
var cartButtons = document.querySelectorAll('.cart-button');
var card_value = document.querySelector(".added");

var cartvalue = 0;

cartButtons.forEach(button => {
  button.addEventListener('click', cartClick);
});
function cartClick() {
  let button = this;
  button.classList.add('clicked');
    card_value.textContent = cartvalue += 1;
}


function selectByName(slug) { 
    



 
 $('#cantidadCarrito').removeClass('aumentoCarrito')
 $.ajax({
   url: '/cart/add/'+slug,
 type : 'GET',
   success: function(respuesta) {
console.log(respuesta)
   if(respuesta.cantidad==1){
     iziToast.show({
   title: 'Ok',
   color: 'green', 
   message: respuesta.msg,
   timeout: 2000,
});
$('#cantidadCarrito').html(parseInt($('#cantidadCarrito').html())+respuesta.cantidad);
$('#cantidadCarrito').addClass('aumentoCarrito')
   }else {
     iziToast.show({
   title: 'Error',
   color: 'red',
   message: respuesta.msg,
   timeout: 2000,
});
   }


 
   },
   error: function() {
       console.log("No se ha podido obtener la información");
   }
});
 
}




