@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Panel de Control</div>
                    <div class="panel-body">
                        @if(isset($result))
                            <div class="alert alert-success" role="alert">
                                {{$result->message}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection