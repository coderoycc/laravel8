<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receta médica</title>
    <link rel="stylesheet" href="{{ public_path("/css/receta.css") }}" media="all"/>
</head>
<body>
  {{-- {{print_r($receta)}} --}}
  <div class="container">
    <header>
      <p>HOSPITAL DEL NIÑO DR. OVIDIO ALIAGA</p>
      <p style="float:right">ONCOHEMATOLOGIA</p>
    </header>
    <div class="general">
      <table style="width:100%">
        <tr>
          <td class="h-50 center bold" style="width:50%;">RECETA MEDICA</td>
          <td class="h-50" style="width:50%;"><p class="border p-2">Nº DEL SUS:&nbsp;&nbsp;&nbsp; {{$receta->consulta->historial->paciente->codSus}}</p></td>
        </tr>
        <tr>
          <td colspan="2" align="center"></td>
        </tr>
        <tr>
          <td class="h-150" style="width:50%">
            <div class="border center h-100" style="width: 110px;margin-left:62px;">

            </div>
          </td>
          <td  class="h-150"style="width:50%">
            <?php $fecha = date('d/m/Y');?>
            <div>
              <p class="border p-2 h-20 center">{{$fecha}}</p>
              <p class="center">FECHA</p>
            </div>
            <div class="v-space"></div>
            <div>
              <p class="center">SELLO FARMACÉUTICA (O)</p>
              <p class="border p-2 h-40"></p>
            </div>
          </td>
        </tr>
        <tr><td class="v-space" colspan="2"></td></tr>
        <tr>
          <td class="h-30" colspan="2">
            <p class="h-30 border center" style="width:145px;display:inline-block;line-height:27px;">{{$receta->consulta->historial->paciente->codSus}}</p>
            <p class="h-30 border" style="width:160px;display:inline-block"></p>
            <p class="h-30 border" style="width:164px;display:inline-block"></p>
          </td>
        </tr>
        <tr>
          <td class="h-20" colspan="2">
            <p class="h-20 center f-s-12" style="width:145px;display:inline-block">Nº DEL SUS</p>
            <p class="h-20 center f-s-12" style="width:160px;display:inline-block">CLAVE DE UNIDAD</p>
            <p class="h-20 center f-s-12" style="width:162px;display:inline-block">CLAVE FARMACÉUTICA</p>
          </td>
        </tr>
        <tr><td class="v-space" colspan="2"></td></tr>
        <tr><td class="v-space" colspan="2"></td></tr>
        <tr>
          <td class="h-20" colspan="2">
            <p class="h-20 center f-s-15" style="width:238px;display:inline-block">{{$receta->consulta->historial->paciente->apellidos}}</p>
            <p class="h-20 center f-s-15" style="width:242px;display:inline-block">{{$receta->consulta->historial->paciente->nombres}}</p>
          </td>
        </tr>
        <tr>
          <td class="h-20" colspan="2">
            <p class="h-20 center f-s-12" style="width:238px;display:inline-block">APELLIDOS</p>
            <p class="h-20 center f-s-12" style="width:240px;display:inline-block">NOMBRE (S)</p>
          </td>
        </tr>
        <tr><td class="v-space" colspan="2"></td></tr>
        <tr>
          <td colspan="2" class="f-s-14">DATOS GENERALES DEL PACIENTE: ...................................................................</td>
        </tr>
        <tr><td class="v-space" colspan="2"></td></tr>
        <tr>
          <td colspan="2" class="f-s-14">........................................................................................................................................</td>
        </tr>
        <tr><td class="v-space" colspan="2"></td></tr>
        <tr>
          <td class="f-s-14" colspan="2">
            DIAGNÓSTICO: {{$receta->diagnostico}}
          </td>
        </tr>
      </table>
    </div>
    <div style="height:177px">
      <table style="width:100%;">
        <tr><td class="v-space" colspan="2"></td></tr>
        <tr><td colspan="3" class="f-s-14">MEDICAMENTOS:</td></tr>
        @foreach ($receta->contenido as $contenido)
        <tr>
          <td class="">- {{$contenido->medicamento->descripcion}}</td>
          <td class="">{{$contenido->unidad}}</td>
          <td class=""></td>
        </tr>
        @endforeach
      </table>
    </div>
    <div>
      <p class="f-s-14">INDICACIONES:............................................................................................................</p>
      <p class="v-space"></p>
      <p class="f-s-14">..........................................................................................................................................</p>
      <p class="v-space"></p>
      <p class="f-s-14">DOSIFICACIÓN:</p>
      <p class="v-space"></p><p class="v-space"></p><p class="v-space"></p>
    </div>
    <p class="v-space"></p>
    <p style="height: 9px"></p>
    <p class="h-20 center f-s-14" style="width:235px;display:inline-block">DATOS DEL MÉDICO</p>
    <p class="h-20 center f-s-14" style="width:230px;display:inline-block;border-top:1px solid #000;">SELLO MÉDICO</p>
  </div>
</body>
</html>