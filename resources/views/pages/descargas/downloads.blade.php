<section class="promo-section mt-5 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10">
                    <div class="section-heading mb-5">
                        <span class="text-uppercase color-secondary sub-title">Catalogos</span>
                        <h3 class="mb-3">Descargá los catalogos de nuestros productos.</h3>
                    </div>
                </div>
            </div>
            <div class="row">
               
            @foreach ($descargas as $descarga)
                <div class="col-lg-3 col-sm-6">
                    <div class="card single-promo-card single-promo-hover mb-lg-0" style="margin-top:30px ;">
                        <div class="card-body">
                            <div class="pb-2">
                            <a href="{{url('file/'.$descarga->archivo)}}" title="Descargar" target="_blank">
                        {{ HTML::image($descarga->imagen, $descarga->nombre, array('width'=>'100px')) }}
                    </a>
                                <span class="ti-receipt icon-md color-secondary"></span>
                            </div>
                            <div class="pt-2 pb-3"><h5>{{$descarga->nombre}}</h5>
                                <p class="text-muted mb-0">Versión: {{$descarga->version}} | Archivo: {{$descarga->tipo_archivo}} | Tamaño: {{$descarga->peso}}</p></div>
                        </div>
                    </div>
                </div>
                <br>
                @endforeach
               
            </div>
        </div>
    </section>