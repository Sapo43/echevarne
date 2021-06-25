<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Echevarne Hermanos</title>

        <meta name="author" content="Federico Raffetto">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link type="text/plain" rel="author" href="{{asset('humans.txt')}}" />
        <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
        <link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">           
        
        <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">        
        <link href="{{ asset('css/admin.min.css?v=2') }}" rel="stylesheet">
        <link href="{{ asset('css/fonts.min.css')}}" rel="stylesheet">    
 

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('styles')
    </head>
    <body>
        <nav class="navbar navbar-default navbar-tdb">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/admin') }}">
                        <img src="{{asset('img/logo.png')}}" alt="Echevarne Hermanos" class="img-responsive"/>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @if (Auth::guard('admin')->check())                          
                        @foreach (Session::get('menu') as $menuItem)                           
                        <li class="dropdown">      
                            @if(trim($menuItem[0]->url) != "")
                            @if( $menuItem[0]->url_type == 'action' )
                            <a href="{{ action($menuItem[0]->url) }}"> 
                                @else
                                <a href="{{ route($menuItem[0]->url) }}"> 
                                    @endif  
                                    {{$menuItem[0]->nombre}}
                                </a>
                                @else    
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{$menuItem[0]->nombre}}
                                </a>    
                                @endif     
                                @if(count($menuItem[1]) > 0)
                                <ul class="dropdown-menu" role="menu">
                                    @foreach ($menuItem[1] as $subMenuItem)
                                    <li>
                                        @if( $subMenuItem->url_type == 'action' )
                                        <a href="{{ action($subMenuItem->url) }}"> 
                                            @else
                                            <a href="{{ route($subMenuItem->url) }}"> 
                                                @endif  
                                                {{$subMenuItem->nombre}}
                                            </a> 
                                    </li>  
                                    @endforeach
                                </ul>
                                @endif                                
                        </li>                             
                        @endforeach
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if (!Auth::guard('admin')->guest())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::guard('admin')->user()->username }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('admin/logout') }}">Cerrar Sesión</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

        {!! HTML::script('js/bootstrap-confirmation.js') !!} 

        <script src="{{ asset('js/floating-wpp.min.js')}}"></script>
        @yield('scripts')        
        @yield('scripts2')        
        @yield('scripts3')        
    </body>
</html>
