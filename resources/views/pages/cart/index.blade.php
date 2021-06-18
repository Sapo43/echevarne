@extends('layouts.default')

@section('content')

    <!--== Start Page Header Area ==-->
    @include('includes.pageheaderarea')
    <!--== End Page Header Area ==-->

    <!--== Start Page Content Wrapper ==-->
    @include('pages.cart.cart')
    <!--== End Page Content Wrapper ==-->
@endsection
