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
    <!-- @include('includes.promotioncodearea') -->
    <!--== End Promotion Code Banner Area ==-->

    <!--== Start Products Area Wrapper ==-->
   
    <!--== End Products Area Wrapper ==-->

    <!--== Start Call to action Wrapper ==-->
    @include('includes.calltoactionarea')
    <!--== End Call to action Wrapper ==-->

    <!--== Start Newsletter Area ==-->
    <!-- @include('includes.newsletterarea') -->
    <!--== End Newsletter Area ==-->

    <!--== Start Brand Logo Area Wrapper ==-->
    @include('includes.brandlogoarea')
    <!--== End Brand Logo Area Wrapper ==-->


    @endsection

    <div class="modal fade " id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Producto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      
    </div>
  </div>
</div>  