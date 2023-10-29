<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reporte Pacientes Leucemia</title>
  <link rel="stylesheet" href="{{ public_path('/css/internacion.css') }}" media="all" />
</head>

<body>
  <div class="container">
    <header>
      <p>HOSPITAL DEL NIÑO DR. OVIDIO ALIAGA</p>
      <p class="right">ONCOHEMATOLOGIA</p>
    </header>
    <br>
    @php
      $year = date('Y');
    @endphp
    <h3 class="center sub">REPORTE PACIENTES CON LEUCEMIA {{$year}}</h3>
    <br>
    <div class="mt-2">
      <h4 style="margin-left:30px;">Diferentes tipos de leucemia (CIE)</h4>
    </div>
    <div class="mt-2" style="width:500px;margin-left:118px;">
      <img src="{{$cadUrlDonut}}" width="500px" alt="Chart Donut">
    </div>


    <div class="mt-3">
      <h4 class="ml-2 mb-2">Tabla de detalles</h4>
      <table border="1" class="table table-striped">
        <tr class="tr-head">
          <td class="h-40">CÓDIGO</td>
          <td>DESCRIPCIÓN</td>
          <td>VARONES</td>
          <td>MUJERES</td>
          <td>TOTAL</td>
        </tr>
        @php $total = 0; @endphp
        @foreach ($valores as $key => $valor)
        <tr>
          <td class="h-40 center">{{$key}}</td>
          <td class="h-40 pl-1">{{$valor['descripcion']}}</td>
          <td class="center">{{$valor['M']}}</td>
          <td class="center">{{$valor['F']}}</td>
          <td class="center">{{$valor['total']}}</td>
        </tr>
        @php $total += $valor['total'] @endphp
        @endforeach
        <tr class="font-weight-bold table-active">
          <td colspan="4" class="right-align pr-2">TOTAL:  </td>
          <td class="center">{{$total}}</td>
        </tr>
      </table>
    </div>
  </div>
</body>

</html>
