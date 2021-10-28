$(".downloadpdf").on('click', function(){
    console.log('clicking pdf');
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
             url:   '/downloadPdf', //archivo que recibe la peticion
             type:  'post', //método de envio
             xhrFields: {
             responseType: 'blob'
         },
         success: function (response, status, xhr) {

             var filename = "";                   
             var disposition = xhr.getResponseHeader('Content-Disposition');

              if (disposition) {
                 var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                 var matches = filenameRegex.exec(disposition);
                 if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
             } 
             var linkelem = document.createElement('a');
             try {
                                        var blob = new Blob([response], { type: 'application/octet-stream' });                        

                 if (typeof window.navigator.msSaveBlob !== 'undefined') {
                     //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                     window.navigator.msSaveBlob(blob, filename);
                 } else {
                     var URL = window.URL || window.webkitURL;
                     var downloadUrl = URL.createObjectURL(blob);

                     if (filename) { 
                         // use HTML5 a[download] attribute to specify filename
                         var a = document.createElement("a");

                         // safari doesn't support this yet
                         if (typeof a.download === 'undefined') {
                             window.location = downloadUrl;
                         } else {
                             a.href = downloadUrl;
                             a.download = filename;
                             document.body.appendChild(a);
                             a.target = "_blank";
                             a.click();
                         }
                     } else {
                         window.location = downloadUrl;
                     }
                 }   

             } catch (ex) {
                 console.log(ex);
             } 
         }    

      

}); 

}); 