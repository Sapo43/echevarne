
<div class="row descargas">
    <div class="col-sm-2 col-md-2 col-wop-l">
        <div class="banner">
            <div class="bannerText">
                <h2>DESCARGAS</h2>
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-10  col-wop-l">  
        <div class="row">
            @foreach ($descargas as $descarga)
            <div class="col-md-6 containerD">
                <div class="imgCont">
                    <a href="{{url('file/'.$descarga->archivo)}}" title="Descargar" target="_blank">
                        {{ HTML::image($descarga->imagen, $descarga->nombre, array('width'=>'100px')) }}
                    </a>
                </div>
                <div class="dataCont">
                    <div class="data">
                        <div class="nombre">{{$descarga->nombre}}</div>
                        <div class="detalles">
                            Versión: {{$descarga->version}} | Archivo: {{$descarga->tipo_archivo}} | Tamaño: {{$descarga->peso}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr>
                <p style="text-align: center;margin-bottom: 0;">
                    Todos los catálogos están en formato PDF. Si usted no tiene Adobe Reader puede descargarlo de forma gratuita, haciendo click sobre el icono
                </p>
            </div>
            <div class="col-md-6 containerD">
                <div class="imgCont">
                    <a href="https://get.adobe.com/es/reader/" title="Descargar Adobe Reader" target="_blank">
                        <img src="{{asset('img/adobe_reader_logo.png')}}" alt="Adobe Reader" style="width: 100px"/>
                    </a>
                </div>
                <div class="dataCont">
                    <div class="data">
                        <div class="nombre">Adobe Reader</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
