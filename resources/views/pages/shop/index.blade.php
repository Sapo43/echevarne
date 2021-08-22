@extends('layouts.default')

@section('content')

    <!--== Start Page Header Area ==-->
    @include('includes.pageheaderarea')
    <!--== End Page Header Area ==-->

    <!--== Start Page Content Wrapper ==-->
    @include('includes.shoppagecontent')
    <!--== End Page Content Wrapper ==-->

   
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection

  