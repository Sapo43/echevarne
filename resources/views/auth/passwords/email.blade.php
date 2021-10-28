<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!--title-->
    <title>Echevarne hermanos</title>

    <!--favicon icon-->
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">

    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700%7COpen+Sans&display=swap"
          rel="stylesheet">

    <!--Bootstrap css-->
    <link rel="stylesheet" href="/assets/login/css/bootstrap.min.css">
    <!--Magnific popup css-->
    <link rel="stylesheet" href="/assets/login/css/magnific-popup.css">
    <!--Themify icon css-->
    <link rel="stylesheet" href="/assets/login/css/themify-icons.css">
    <!--animated css-->
    <link rel="stylesheet" href="/assets/login/css/animate.min.css">

    <!--Owl carousel css-->
    <link rel="stylesheet" href="/assets/login/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/login/css/owl.theme.default.min.css">
    <!--custom css-->
    <link rel="stylesheet" href="/assets/login/css/style.css">
    <!--responsive css-->
    <link rel="stylesheet" href="/assets/login/css/responsive.css">
    <link rel="stylesheet" href="/assets/css/spinnerloading.css">
    <link rel="stylesheet" href="/assets/css/iziToast.css">
    

</head>
<body>
<div class="loading" style="display: none;">Loading&#8230;</div>
 <!--body content wrap start-->
<div class="main">

    <!--hero section start-->
    <section class="hero-section full-screen gray-light-bg">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">

                <div class="col-12 col-md-7 col-lg-6 col-xl-8 d-none d-lg-block">
                    <!-- Image -->
                    <div class="bg-cover vh-100 ml-n3 background-img" style="background-image: url(/img/hero-bg-1.jpg);">
                        <div class="position-absolute login-signup-content">
                            <div class="position-relative text-white col-md-12 col-lg-7">
                                <h2 class="text-white"></h2>
                                <!-- <p class="lead">Keep your face always toward the sunshine - and shadows will fall behind you. Continually pursue fully researched niches whereas timely platforms. Credibly parallel task optimal catalysts for change after focused catalysts for change.</p> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="login-signup-wrap px-4 px-lg-5 my-5">
                        <!-- Heading -->
                        <h1 class="text-center mb-1">
                            Recuperar Contraseña
                        </h1>
                        <p class="text-center mb-5">
                       
                        </p>

                        <!-- form-->
                        <form id="formRecover" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <button  type="submit" class="btn btn-lg btn-block solid-btn border-radius mt-4 mb-3">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div>
    </section>
    <!--hero section end-->

</div>
<!--body content wrap end

<!--jQuery-->
<script src="/assets/login/js/jquery-3.5.0.min.js"></script>
<!--Popper js-->
<script src="/assets/login/js/popper.min.js"></script>
<!--Bootstrap js-->
<script src="/assets/login/js/bootstrap.min.js"></script>
<!--Magnific popup js-->
<script src="/assets/login/js/jquery.magnific-popup.min.js"></script>
<!--jquery easing js-->
<script src="/assets/login/js/jquery.easing.min.js"></script>

<!--wow js-->
<script src="/assets/login/js/wow.min.js"></script>
<!--owl carousel js-->
<script src="/assets/login/js/owl.carousel.min.js"></script>
<!--countdown js-->
<script src="/assets/login/js/jquery.countdown.min.js"></script>
<!--custom js-->
<script src="/assets/login/js/scripts.js"></script>
<script src="/assets/js/iziToast.min.js"></script>

<script>
$("#formRecover").submit(function(event) {
/* stop form from submitting normally */
event.preventDefault();
/* get the action attribute from the <form action=""> element */
var $form = $(this),
  url = $form.attr('action');
$.ajax({
            type: "post",
            url: url,
            data: $form.serialize(),
            contentType: "application/x-www-form-urlencoded",
            beforeSend:function(){
                $('.loading').show();
            },
            success: function(responseData, textStatus, jqXHR) { 
                console.log(responseData.search("We can"));  
         
                if(responseData.search("Please wait before retrying")==4024){
                    iziToast.show({
   title: 'Error',
   color: 'red', 
   message:'Intentelo de nuevo, mas tarde.',
   timeout: 2000,
});


                }; 
                if((responseData.search("We can")>400)&&(responseData.search("We can")!=4024) &&(responseData.search("We can")<4100)){
                    iziToast.show({
   title: 'Error',
   color: 'red', 
   message:'Email incorrecto, por favor ingrese nuevamente.',
   timeout: 2000,
});


                }; 
                
                

                $('.loading').hide();
            },
            error: function(responseData, textStatus, jqXHR) {
                console.log(responseData,textStatus, jqXHR)
            }
            
        })
});
    
</script>
</body>
</html>