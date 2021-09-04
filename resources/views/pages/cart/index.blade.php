@extends('layouts.default')

@section('content')


    <!--== Start Page Content Wrapper ==-->
    @include('pages.cart.cart')
    <!--== End Page Content Wrapper ==-->
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