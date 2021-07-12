$('#basicModal').on('shown.bs.modal', function (e) {

    $.ajax({
    url: '/productoDetail/'+$('#amodal').data('id'),
    beforeSend: function(data){
        $('.modal-body').html('Cargando...')
    }

    ,
    success: function(response){ 
      // Add response in Modal body
      $('.modal-body').html(response);

     
    }
  });

});
