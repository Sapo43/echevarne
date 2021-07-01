
$('#confirmar').click(function(){

   
console.log("y?");
  //  Datos para facturacion
  f_name =$('#f_name').val();
  l_name =$('#l_name').val();
  email = $('#email').val();
  com_name = $('#com-name').val();
  country = $('#country').val();
  street_address = $('#street-address').val();
  town = $('#town').val();
  state = $('#state').val();
  postcode = $('#postcode').val();
  phone = $('#phone').val();
  ordernote = $('#ordernote').val();


 

  //  Datos de envio




    $.ajax
    ({ 
        url: '/checkout/confirmar',
        data: { "_token": "{{ csrf_token() }}",
          "f_name": f_name,
              "l_name": l_name,
              "email": email,
              "com_name":com_name,
              "country":country,
              "postcode":postcode,
              "phone":phone,
              "ordernote":ordernote},
        type: 'post',
        success: function(result)
        {
            alert(result.success);
        }
    });
});
