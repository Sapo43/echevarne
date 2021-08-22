
function deleteFromCart(slug,id){
  
     $.ajax({
       url: "/cart/delete/"+slug,
       success: function(response){ 
         getminicart();
          if(id=='rmc'){
            window.location.href='/cart'
          }
       
       }
     });
  }
