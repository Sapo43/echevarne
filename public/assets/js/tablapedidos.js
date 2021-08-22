



    $(document).on('click', '.pagination a', function(event)    {
        event.preventDefault(); 
        var indexs =$('.pagination li.active').index()
        $('.pagination li.active').removeClass('active');
        var page = $(this).attr('href').split('page=')[1];
        $('.pagination').parent().find(".pagination li").eq(page).addClass('active');
            fetch_data(page);
     });

     function fetch_data(page){
    
         var _token= $('meta[name="csrf-token"]').attr('content');
        $.ajax(
            {
               url: '?page=' + page,  
               type:'post',
                data:{
                    '_token':_token
                } ,   
                datatype: "html"            
            })        
            .done(function(data){
                $('.table').html(data);  
            });
    }