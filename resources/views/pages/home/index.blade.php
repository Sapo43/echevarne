@extends('layouts.default')


@section('content')

 <!--== Start Slider Area Wrapper ==-->
 @include('includes.sliderarea')
    <!--== End Slider Area Wrapper ==-->

    <!--== Start Banner Area Wrapper ==-->
    @include('includes.bannerarea')
    <!--== End Banner Area Wrapper ==-->

    <!--== Start Best Seller Products Area ==-->
    @include('includes.bestsellerarea')
    <!--== End Best Seller Products Area ==-->

    <!--== Start Flash Deals Area ==-->
    @include('includes.flashdealsarea')
    <!--== End Flash Deals Area ==-->

    <!--== Start Call to Action Area ==-->
    @include('includes.callarea')
    <!--== End Call to Action Area ==-->

    <!--== Start Promotion Code Banner Area ==-->
    @include('includes.promotioncodearea')
    <!--== End Promotion Code Banner Area ==-->

    <!--== Start Products Area Wrapper ==-->
    @include('includes.productarea')
    <!--== End Products Area Wrapper ==-->

    <!--== Start Call to action Wrapper ==-->
    @include('includes.calltoactionarea')
    <!--== End Call to action Wrapper ==-->

    <!--== Start Newsletter Area ==-->
    @include('includes.newsletterarea')
    <!--== End Newsletter Area ==-->

    <!--== Start Brand Logo Area Wrapper ==-->
    @include('includes.brandlogoarea')
    <!--== End Brand Logo Area Wrapper ==-->


    @endsection
