
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
        
        
          
          const cartButtons = document.querySelectorAll('.cart-button');        
          cartButtons.forEach(button => {
               button.addEventListener('click', cartClick);
          });
        
          var proQty = $(".pro-qty");
        proQty.append('<a href="#" class="inc qty-btn">+</a>');
        proQty.append('<a href="#" class= "dec qty-btn">-</a>');
        $('.qty-btn').on('click', function(e) {
            e.preventDefault();
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $button.parent().find('input').val(newVal);
        });
        
       
      }
    });
  }



  function cartClick() {
    setTimeout(function() {
      $('#basicModal').modal('hide');
 }, 1000);
   
  }