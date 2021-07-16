$(function() {
  getminicart();
});




function getminicart(){

    $.ajax({
      url: '/getminicart',
      success: function(response){ 
        // Add response in Modal body
        $('#minicart').html(response);
  
       
      }
    });
  }
