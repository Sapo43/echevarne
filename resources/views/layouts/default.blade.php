<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home 2 :: Lukas - Car Parts Store eCommerce HTML Template</title>

    <!--== Favicon ==-->
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon" />

    <!--== Google Fonts ==-->
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500,600,700%7CPoppins:400,400i,500,600&display=swap" rel="stylesheet">

    <!-- build:css /assets/css/app.min.css -->
    <!--== Leaflet Min CSS ==-->
    <link   rel="stylesheet" href="{{URL::asset('/assets/css/leaflet.min.css')}}" />
   

    <!--== Nice Select Min CSS ==-->
    <link href="/assets/css/nice-select.min.css" rel="stylesheet" />
    <!--== Slick Slider Min CSS ==-->
    <link href="/assets/css/slick.min.css" rel="stylesheet" />
    <!--== Magnific Popup Min CSS ==-->
    <link href="/assets/css/magnific-popup.min.css" rel="stylesheet" />
    <!--== Slicknav Min CSS ==-->
    <link href="/assets/css/slicknav.min.css" rel="stylesheet" />
    <!--== Animate Min CSS ==-->
    <link href="/assets/css/animate.min.css" rel="stylesheet" />
    <!--== Ionicons Min CSS ==-->
    <link href="/assets/css/ionicons.min.css" rel="stylesheet" />
    <!--== Font-Awesome Min CSS ==-->
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--== Bootstrap Min CSS ==-->
     <link href="/assets/css/bootstrap.min.css" rel="stylesheet" /> 

    
    

    <!--== Main Style CSS ==-->
    <link href="/assets/css/style.css" rel="stylesheet" />
    <!--== Helper Min CSS ==-->
    <link href="/assets/css/helper.min.css" rel="stylesheet" />
    <!-- endbuild -->

    <!--[if lt IE 9]>
<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style >
@media (min-width: 768px) {
	 .multi-item-carousel .carousel-inner .carousel-item {
		 margin-right: inherit;
	}
	 .multi-item-carousel .carousel-inner .carousel-item.active + .carousel-item, .multi-item-carousel .carousel-inner .carousel-item.active + .carousel-item + .carousel-item {
		 display: block;
	}
	 .multi-item-carousel .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left), .multi-item-carousel .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item, .multi-item-carousel .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item {
		 transition: none;
	}
	 .multi-item-carousel .carousel-inner .carousel-item.active + .carousel-item + .carousel-item + .carousel-item {
		 position: absolute;
		 top: 0;
		 right: -33.333333333333%;
		 z-index: -1;
		 display: block;
		 visibility: visible;
	}
	 .multi-item-carousel .carousel-inner .carousel-item-next, .multi-item-carousel .carousel-inner .carousel-item-prev {
		 position: relative;
		 transform: translate3d(0,0,0);
	}
	 .multi-item-carousel .carousel-inner .carousel-item-prev.carousel-item-right {
		 position: absolute;
		 top: 0;
		 left: 0;
		 z-index: -1;
		 display: block;
		 visibility: visible;
	}
	 .multi-item-carousel .active.carousel-item-left + .carousel-item-next.carousel-item-left, .multi-item-carousel .carousel-item-next.carousel-item-left + .carousel-item, .multi-item-carousel .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item, .multi-item-carousel .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item {
		 position: relative;
		 transform: translate3d(-100%,0,0);
		 visibility: visible;
	}
	 .multi-item-carousel .active.carousel-item-right + .carousel-item-prev.carousel-item-right, .multi-item-carousel .carousel-item-prev.carousel-item-right + .carousel-item, .multi-item-carousel .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item, .multi-item-carousel .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item {
		 position: relative;
		 transform: translate3d(100%,0,0);
		 display: block;
		 visibility: visible;
	}
}
 
</style>


	<!-- CSS dinamicos que llegan desde el controlador -->
	<?php
	if(isset($csss)){
		if(is_array($csss)){
			foreach($csss as $css){
				echo '<link href="'. $css .' "rel="stylesheet" type="text/css">'.PHP_EOL;
			}
		}
	}
	?>
	<!-- fin CSS dinámicos desde controlador -->




</head>

<body>

@if ((\Request::is('login')) || (\Request::is('register'))) 
 <!--== Start Header Area For login/register==-->
 @include('includes.headerarealoginregister')
    <!--== End Header Area For login/register ==-->

@else
 <!--== Start Header Area ==-->
 @include('includes.headerarea')
    <!--== End Header Area ==-->
@endif
   

   @yield('content')




   @if ((\Request::is('login')) || (\Request::is('register'))) 


   <footer class="footer-area">
        <div class="footer-widget-area">
            <div class="container container-wide">
                <div class="row mtn-40">
                  

                   

                </div>
            </div>
        </div>

        <div class="footer-copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="copyright-content">
                            <p>Copyright © 2019 Lukas. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

 
@else
  <!--== Start Footer Area Wrapper ==-->
  @include('includes.footerarea')
    <!--== End Footer Area Wrapper ==-->
@endif

  

    <!-- Scroll Top Button -->
    <button class="btn-scroll-top"><i class="ion-chevron-up"></i></button>



    <!--== Start Responsive Menu Wrapper ==-->
    @include('includes.responsivemenu')
    <!--== End Responsive Menu Wrapper ==-->


    <!--=======================Javascript============================-->
    <!-- build:js /assets/js/app.min.js -->
    <!--=== Modernizr Min Js ===-->
    <script src="/assets/js/modernizr-3.6.0.min.js"></script>
    <!--=== jQuery Min Js ===-->
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <!--=== jQuery Migration Min Js ===-->
    <script src="/assets/js/jquery-migrate-1.2.1.min.js"></script>
    <!--=== Popper Min Js ===-->
    <script src="/assets/js/popper.min.js"></script>
    <!--=== Bootstrap Min Js ===-->
    <script src="/assets/js/bootstrap.min.js"></script>
    <!--=== Slicknav Min Js ===-->
    <script src="/assets/js/jquery.slicknav.min.js"></script>
    <!--=== Magnific Popup Min Js ===-->
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <!--=== Slick Slider Min Js ===-->
    <script src="/assets/js/slick.min.js"></script>
    <!--=== Nice Select Min Js ===-->
    <script src="/assets/js/jquery.nice-select.min.js"></script>
    <!--=== Leaflet Min Js ===-->
    <script src="/assets/js/leaflet.min.js"></script>
    <!--=== Countdown Js ===-->
    <script src="/assets/js/countdown.js"></script>

    <!--=== Active Js ===-->
    <script src="/assets/js/active.js"></script>
    <!-- endbuild -->







<script>

$('.multi-item-carousel').on('slide.bs.carousel', function (e) {
  let $e = $(e.relatedTarget),
      itemsPerSlide = 3,
      totalItems = $('.carousel-item', this).length,
      $itemsContainer = $('.carousel-inner', this),
      it = itemsPerSlide - (totalItems - $e.index());
  if (it > 0) {
    for (var i = 0; i < it; i++) {
      $('.carousel-item', this).eq(e.direction == "left" ? i : 0).
        // append slides to the end/beginning
        appendTo($itemsContainer);
    }
  }
});

</script>


	
<!-- Scripts dinamicos que llegan desde el controlador -->
<?php
		if(isset($scripts)){
			if(is_array($scripts)){
				foreach($scripts as $script){
					echo '<script src="' . $script . '"></script>'.PHP_EOL;
				}
			}
		}
	?>
<!-- fin Scripts dinámicos desde controlador -->

</body>

</html>