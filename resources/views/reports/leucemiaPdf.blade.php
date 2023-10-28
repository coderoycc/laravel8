<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Protocol ST Jude (Report)</title>
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
    <br>
  </div>
</body>

</html>
