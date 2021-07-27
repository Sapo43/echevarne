<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta description -->
    <meta name="description"
          content="AppCo app landing page template or product landing page template helps you easily create websites for your app or product,  landing page template form promotion and many more.">
    <meta name="author" content="ThemeTags">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content=""/> <!-- website name -->
    <meta property="og:site" content=""/> <!-- website link -->
    <meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
    <meta property="og:description" content=""/> <!-- description shown in the actual shared post -->
    <meta property="og:image" content=""/> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content=""/> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article"/>

    <!--title-->
    <title>AppCo App Landing Page Template</title>

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

</head>
<body>

<!--body content wrap start-->
<div class="main">

    <!--hero section start-->
    <section class="hero-section full-screen gray-light-bg">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">

                <div class="col-12 col-md-7 col-lg-6 col-xl-8 d-none d-lg-block">

                    <!-- Image -->
                    <div class="bg-cover vh-100 ml-n3 background-img" style="background-image: url(img/hero-bg-2.jpg);">
                        <div class="position-absolute login-signup-content">
                            <div class="position-relative text-white col-md-12 col-lg-7">
                                <h2 class="text-white">Create Your Account</h2>
                                <p class="lead">Keep your face always toward the sunshine - and shadows will fall behind you. Continually pursue fully researched niches whereas timely platforms. Credibly parallel task optimal catalysts for change after focused catalysts for change.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-5 col-lg-6 col-xl-4 px-lg-6 my-5">
                    <div class="login-signup-wrap px-4 px-lg-5 my-5">
                        <!-- Heading -->
                        <h1 class="text-center mb-1">
                            Signup
                        </h1>

                        <!-- Subheading -->
                        <p class="text-muted text-center mb-5">
                            Free access to our dashboard.
                        </p>

                        <!-- Form -->
                        <form class="login-signup-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <!-- Label -->
                                <label class="pb-1">
                                    Usuario
                                </label>
                                <!-- Input group -->
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-user color-primary"></span>
                                    </div>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- Label -->
                                <label class="pb-1">
                                    Nombre
                                </label>
                                <!-- Input group -->
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-user color-primary"></span>
                                    </div>
                              
                                    <input id="nombre" type="text" class="form-control" name="nombre" required autocomplete="nombre">   
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- Label -->
                                <label class="pb-1">
                                   Apellido
                                </label>
                                <!-- Input group -->
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-user color-primary"></span>
                                    </div>
                                    <input id="apellido" type="text" class="form-control" name="apellido" required autocomplete="apellido">
                                   
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- Label -->
                                <label class="pb-1">
                                    Email Address
                                </label>
                                <!-- Input group -->
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-email color-primary"></span>
                                    </div>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <!-- Label -->
                                <label class="pb-1">
                                    Password
                                </label>
                                <!-- Input group -->
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-lock color-primary"></span>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                              <!-- Password -->
                              <div class="form-group">
                                <!-- Label -->
                                <label class="pb-1">
                                    Password-confirmation
                                </label>
                                <!-- Input group -->
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-lock color-primary"></span>
                                    </div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                  
                                </div>
                            </div>

                            <!-- <div class="form-check d-flex align-items-center text-center">
                                <input type="checkbox" class="form-check-input mt-0 mr-3" id="exampleCheck1">
                                <label class="form-check-label small" for="exampleCheck1">I agree your <a href="#">terms and conditions</a></label>
                            </div> -->

                            <!-- Submit -->
                            <button  type="submit"  class="btn btn-lg btn-block solid-btn border-radius mt-4 mb-3">
                                Sign up
                            </button>

                            <!-- Link -->
                            <div class="text-center">
                                <small class="text-muted text-center">
                                    Already have an account? <a href="/login">Log in</a>.
                                </small>
                            </div>

                        </form>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div>
    </section>
    <!--hero section end-->

</div>
<!--body content wrap end-->

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
</body>
</html>