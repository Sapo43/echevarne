@extends('layouts.app')

@section('content')
  

<div class="container">
   
    <div class="panel panel-primary">
      <div class="panel-heading"><h2>Creación de mensaje de inicio</h2></div>
      <div class="panel-body">
   
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        <img src="images/{{ Session::get('image') }}">
        @endif
  
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Algun problema con la entrada
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
  
        <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
        
        <div class="row">
            {{ csrf_field() }}
                <div class="col-md-6">
                    <input type="file" name="image" class="form-control">                    
                </div>        
                <div class="col-md-6">
                    <label for="desde">Desde:</label>
                    <input type="date" id="desde" name="desde">
              &nbsp
                    <label for="hasta">Hasta:</label>
                    <input type="date"  id="hasta" name="hasta">
                </div>

                </div>
                <div class="row">
                <div class="col-md-5">
                </div>
                <div class="col-md-6">
                <button type="submit" class="btn btn-success">Subir</button>
                </div>

           </div>
        </form>
  
      </div>
    </div>
</div>
@endsection