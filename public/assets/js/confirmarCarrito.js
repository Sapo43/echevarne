$("#confirmar").on('click',function (e){
    // var textarea=$("#notas").val();
    var _token= $('meta[name="csrf-token"]').attr('content')
    $.ajax({
	url: '/confirmarCarrito',
  type : 'POST',
  data:{
    //   'notas':textarea,
        '_token':_token},
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