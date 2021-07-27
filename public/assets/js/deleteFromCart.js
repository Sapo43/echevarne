
function deleteFromCart(slug){
console.log("deleeeee");
    $.ajax({
      url: "/cart/delete/"+slug,
      success: function(response){ 
        // Add response in Modal body
        getminicart();
  
       
      }
    });
  }
