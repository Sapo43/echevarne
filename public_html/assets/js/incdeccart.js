
$(function() {
  
 
    var userSelection = document.getElementsByClassName('qty-btn');

for(let i = 0; i < userSelection.length; i++) {
   userSelection[i].addEventListener("click", function() {
     findTotal()
   })
 }
});
      

function findTotal(){


    var arr = document.getElementsByName('qty');
        var subtotal=document.getElementsByName('subtotal');
        var scale = document.getElementsByName('num');
        var spanTotalSinIva = document.getElementById('totSinIva');
        

        for(var i=0;i<arr.length;i++){
            var tot = 0;
            if(arr[i].value != "" && scale[i].value != ""){

             
                
                tot += parseFloat(( (scale[i].innerHTML).replace('.','')).replace(',','.')) * parseInt(arr[i].value);              
                subtotal[i].innerHTML = new Intl.NumberFormat(["ban", "id"]).format(tot);
                
            }
        }
        var totSinIva=0;
        for(var i=0;i<subtotal.length;i++){
            totSinIva+=(parseFloat(( (subtotal[i].innerHTML).replace('.','')).replace(',','.')));
        }
        
        spanTotalSinIva.innerHTML =new Intl.NumberFormat(["ban", "id"]).format(totSinIva);
}


function update(toCheck){

swal.fire({
    title: "",
    text: "Por favor espere.",
    imageUrl: "../../loading.gif",
    showConfirmButton: false
});

    var _token= $('meta[name="csrf-token"]').attr('content')
    var array = document.getElementsByName('qty');
    var envios=0;

    //array de promesas
    let promises= [];

    //itero sobre los inputs de cantidades
    array.forEach(valor => {

    
      
        promises.push(

            //promises fetch to controller
            new Promise((resolve, reject) => {
                
                return fetch('/cart/update', {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": _token
                        },
                    method: 'post',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        id:  (valor.id).replace("product_",''),
                        cantidad: valor.value
                    })
                })
              
                .then((response) => {
                 
                  if (response.ok) {
                    
                     resolve(response.json())
                   } else {
                     reject(new Error('error'))
                   }
                 }, error => {
                   reject(new Error(error.message))
                 })
              })
        )
      
 

    });


    Promise.all(promises)
    .then((resp) => resp)
    .then(function(data) {
        i=0;
        data.forEach(element => {
                if(element.result==false){
                    console.log("result false");
                    swal.close();
                    swal.fire({
                        title: "Error al actualizar carrito",
                       
                        showConfirmButton: true
                    }).then(function (result) {
                        if (result.value) {
                            window.location = "/cart";
                        }
                    });
                }
                i++;
        });
    
        if(i==data.length){
            swal.close();
                    swal.fire({
                        title: "Carrito actualizado",
                        
                        showConfirmButton: true
                    }).then(function (result) {
                        
                        if (result.value) {
                                console.log(toCheck);
                           
                                if(toCheck)
                                {
                                    window.location="/checkout"; 
                                }else{
                                    window.location = "/cart";
                                }
                             
                         
                        }
                    });
        }
    }).catch((error) => {
        console.log(error);
        swal.close();
        swal.fire({
            title: "Error al actualizar ",
            text: "Please wait.",
            showConfirmButton: true
        })
    });
       
  


    }
      


    


