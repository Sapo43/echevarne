
  function loadModal(e){

    $.ajax({
      url: '/productoDetail/'+$(e).data('id'),
      beforeSend: function(data){
          $('.modal-body').html('Cargando...')
      }
  
      ,
      success: function(response){ 
        // Add response in Modal body
        $('.modal-body').html(response);
  
       
      }
    });
  }



