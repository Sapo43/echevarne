$(".downloadexcel").on('click', function(){
    console.log('Clicking ex');
    var rubro = $('#rubro').val();
    var marca = $('#marca').val();
    var codigo = $('#codigo').val();
    var nombre = $('#nombre').val();
    var equiv = $('#equivalencia').val();
    var _token= $('meta[name="csrf-token"]').attr('content')
         
  

 $.ajax({
             data:  {'rubro':rubro,
                      'marca':marca,   
                     'codigo':codigo,
                     'nombre':nombre,
                     '_token':_token
             }, //datos que se envian a traves de ajax
             url:   '/downloadexcel', //archivo que recibe la peticion
             type:  'post', //método de envio
             xhrFields: {
                responseType: 'blob',
            },
         success: function (result, status, xhr) {
            var disposition = xhr.getResponseHeader('content-disposition');
            var matches = /"([^"]*)"/.exec(disposition);
            var filename = (matches != null && matches[1] ? matches[1] : 'salary.xlsx');
    
            // The actual download
            var blob = new Blob([result], {
                type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            });
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = filename;
    
            document.body.appendChild(link);
    
            link.click();
            document.body.removeChild(link);
    
            
         }    

      

}); 

}); 