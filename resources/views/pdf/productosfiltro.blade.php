<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<style>

.page-break {
        page-break-after: always;
    }

    table{
      position:absolute;
      left:0px;
      top:150.00px; 
      font-size:12.5px; 
      font-family:verdana;
}



    </style>

</head><body>

  <img style="position:absolute;left:0.00px;top:0.00px" src="{{ public_path('/img/logo.jpg') }}" height="100px" width="200px">

  <img style="position:absolute;left:10.0px;top:100.00px ; color:black" src="{{ public_path('/img/separador.jpg') }}" height="6px" width="690px">
  <h1 style="position:absolute;left:250.00px;top:0.00px">{{ $heading}}</h1>
  <h5 style="position:absolute;left:600.00px;top:20.00px">{{date('d-m-Y')}}</h5>
  <p style="position:absolute;left:110px;top:750">{{$pie1}}</p>  
  <p style="position:absolute;left:150px;top:760">{{$pie2}}</p>
  <table  class="table">

    <tr>
   
   
        <th>Código</th>
        <th>Producto</th>
        <th>Rubro</th>
        <th>Marca</th>
        <th>Precio Lista </th>
        <th>Precio Venta </th>
        <th>Precio Compra </th>

        </tr>
       
     
@foreach ($productos as $index =>$producto)   
          <tr>
         
          <td>{{$producto->codigo}}</td>
          <td>{{$producto->nombre}}</td>
          <td>{{$producto->rubro->nombre}}</td>
          <td>{{$producto->marca->nombre}}</td>
          <td align="center">$ {{$producto->precio}}</td>
          <td align="center">${{number_format(($producto->precio- ($producto->precio* $porcentaje_compra  / 100))+( ($producto->precio- ($producto->precio* $porcentaje_compra  / 100)) * $porcentaje_venta  / 100),2,',','.') }}</td>
           <td align="center">$ {{number_format($producto->precio- ($producto->precio* $porcentaje_compra  / 100),2,',','.')}}</td>
            </tr>
  @if( ($index+1)%30 == 0 )
            
              </table>
  

              <div class="page-break"></div>
              <style>

.page-break {
        page-break-after: always;
    }

    table{
      position:absolute;
      left:0px;
      top:150.00px; 
      font-size:12.5px; 
      font-family:verdana;
}


    </style>
              <img style="position:absolute;left:0.00px;top:0.00px" src="{{ public_path('/img/logo.jpg') }}" height="100px" width="200px">
<img style="position:absolute;left:10.0px;top:100.00px ; color:black" src="{{ public_path('/img/separador.jpg') }}" height="6px" width="690px">
<h1 style="position:absolute;left:250.00px;top:0.00px">{{ $heading}}</h1>
<h5 style="position:absolute;left:600.00px;top:20.00px">{{date('d-m-Y')}}</h5>

<table   class="table">

	      
	    	          <tr>
                      <th>Código</th>
                      <th>Producto</th>
                      <th>Rubro</th>
                      <th>Marca</th>
                      <th>Precio Lista </th>
                      <th>Precio Venta </th>
                      <th>Precio Compra </th>
		              </tr>  
                  
                
        @endif


   




            @endforeach

</table>
<p style="position:absolute;left:110px;top:750">{{$pie1}}</p>  
<p style="position:absolute;left:150px;top:760">{{$pie2}}</p>  
</body></html>