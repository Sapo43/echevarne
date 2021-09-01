$("#confirmar").on('click',function (e){
  
 
  console.log();

     var notas=$("#notas").val();
     var telefono=$("#telefono").val();
     var codigo_postal=$("#codigo_postal").val();
     var direccion=$("#direccion").val();
     var ciudad=$("#ciudad").val();
     var nombre=$("#nombre").val();
     var apellido=$("#apellido").val();
     var email=$("#email").val();
     var cuit=$("#cuit").val();
    var _token= $('meta[name="csrf-token"]').attr('content');
    var enNombre_id= $('#custom_field1_datalist [value="' + $('#custom_field1').val() + '"]').data('value')|| '';
    $.ajax({
	url: '/confirmarCarrito',
  type : 'POST',
  data:{
        'telefono':telefono,
        'codigo_postal':codigo_postal,
        'email':email,
        'direccion':direccion,
        'ciudad':ciudad,
        'nombre':nombre,
        'apellido':apellido,
        'notas':notas,
        'cuit':cuit,
        'enNombre_id':enNombre_id,
        '_token':_token
        },

	success: function(data) {
    
    if($.isEmptyObject(data.error)){
     
      iziToast.show({
        
    title:"Ok",
    color: 'green',
    message: data.success,
    timeout: 2000,
    onClosing: function(){
      
       window.location.href='/shop';
    }
    })

                        
                    }else{
                      iziToast.show({
    title: "Error",
    color: 'red',
    message: data.error,
    timeout: 2000,
    
    })
                    }
    
    

	},
	error: function(e) {
        console.log(e);
    }
});

       
  });