<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Formulario Internacion</title>
  <link rel="stylesheet" href="{{ public_path("/css/internacion.css") }}" media="all"/>
</head>
<body>
  {{-- {{print_r($internacion)}} --}}
  <div class="container">
    <header>
      <p>HOSPITAL DEL NIÑO DR. OVIDIO ALIAGA</p>
      <p class="right">ONCOHEMATOLOGIA</p>
    </header>
    <br>
    <h2 class="center">FORMULARIO DE INTERNACIÓN</h2>
    <br>
    <br>
    <table border="0" style="width: 100%">
      <tr>
        <td colspan="8"><b>NOMBRE:</b> {{$internacion->paciente->nombres.' '.$internacion->paciente->apellidos}}</td>
        <td colspan="2" class="right-align"><b>NUM. DEL SUS.:</b> {{$internacion->paciente->codSus}}</td>
      </tr>
      <tr ><td colspan="10" class="v-space"></td></tr>
      <tr ><td colspan="10" class="v-space"></td></tr>
    </table>
    <table style="width:100%">
      <tr class="center">
        <td colspan="2">{{$internacion->paciente->historialPaciente->servicio}}</td>
        <td colspan="1"></td>
        <td colspan="3">{{$internacion->paciente->edad($internacion->paciente->fechaNac)}}</td>
        <td colspan="2">{{$internacion->paciente->genero == 'F' ? 'FEMENINO' : 'MASCULINO'}}</td>
        <td colspan="1"></td>
        <td colspan="1">{{$internacion->paciente->historialPaciente->procedencia}}</td>
      </tr>
      <tr class="center f-s-12" >
        <td colspan="2"><span style="border-top:1px dashed #000;padding:3px 20px;">SERVICIO</span></td>
        <td colspan="1"><span style="border-top:1px dashed #000;padding:3px 15px;">CAMA</span></td>
        <td colspan="3"><span style="border-top:1px dashed #000;padding:3px 20px;">EDAD</span></td>
        <td colspan="2"><span style="border-top:1px dashed #000;padding:3px 20px;">GENERO</span></td>
        <td colspan="1"></td>
        <td  colspan="1"><span style="border-top:1px dashed #000;padding:3px 0px;">PROCEDENCIA</span></td>
      </tr>
    </table>
    <br>
    <table border="0" style="width:300px">
      <tr class="f-s-12">
        <td colspan="2" style="width:50px;">FECHA DE INGRESO</td>
        <td class="h-20 border"></td>
        <td class="h-20 border"></td>
        <td class="h-20 border"></td>
      </tr>
      <tr class="f-s-12 center">
        <td colspan="2"></td>
        <td>DÍA</td>
        <td>MES</td>
        <td>AÑO</td>
      </tr>
    </table>
    <br>
    <div>
      <p>DATOS CLÍNICOS: {{$internacion->paciente->historialPaciente->valoracion}}</p>
      <p>{{$internacion->paciente->historialPaciente->observacion}}</p>
    </div>
    <br><br><br>
    <div>
      <p>DIAGNÓSTICOS DE ADMINISIÓN:</p>
      <ul style="margin-left:50px">
      @foreach ($internacion->paciente->historialPaciente->diagnosticos as $diag)
        <li>{{print_r($diag->nombre()->descripcion)}}</li>
      @endforeach
      </ul>
    </div>
    <div>
      <p>DIAGNÓSTICO DE INGRESO: ANATÓMICO, ETIOLÓGICO, FUNCIONAL</p>
      <p style="width:100%;line-height:2;word-wrap: break-word;" class="f-s-14">CONDICIONES DE INGRESO: ........................................................................................................................................................</p>
    </div>
    <div>
      <table style="width:100%">
        <tr>
          <td class="center f-s-14" colspan="5">{{'1)'}} INVARIABLE ( )</td>
          <td class="center f-s-14" colspan="5">{{'2)'}} EN ESTUDIO ( )</td>
        </tr>
        <tr><td colspan="10" class="v-space"></td></tr>
        <tr>
          <td></td>
          <td class="center" colspan="2">CAUSAS DE INGRESO: </td>
          <td class="center" colspan="2">ONCOLOGÍA {{$internacion->paciente->historialPaciente->servicio == 'ONCOLOGÍA' ? '( X )' : '( )'}}</td>
          <td class="center" colspan="2">HEMATOLOGÍA {{$internacion->paciente->historialPaciente->servicio == 'HEMATOLOGÍA' ? '( X )' : '( )'}}</td>
          <td class="center" colspan="2">EMERGENCIA {{$internacion->paciente->historialPaciente->servicio == 'EMERGENCIA' ? '( X )' : '( )'}}</td>
          <td></td>
        </tr>
      </table>
    </div>
    <br>
    <div>
      <p class="f-s-14">EXÁMENES COMPLEMENTARIOS DE DIAGNÓSTICOS REALIZADOS:...................................................................................</p>
      <p style="width:100%;line-height:1.5;word-wrap: break-word;" class="f-s-14">TRATAMIENTO: .................................................................................................................................................................................. ................................................................................................................................................................................................................</p>
      <p style="width:100%;line-height:1.5;word-wrap: break-word;" class="f-s-14">TRATAMIENTO QUIRÚRGICO: ........................................................................................................................................................ .................................................................................................................................................................................................................</p>
      <p style="width:100%;line-height:1.5;word-wrap: break-word;" class="f-s-14">TRATAMIENTO MÉDICO: ................................................................................................................................................................. ..................................................................................................................................................................................................................</p>
      <p class="f-s-14"> COMPLICACIONES:.............................................................................................................................................................................</p>
      <p class="f-s-14">PRONÓSTICO VITAL:.........................................................................................................................................................................</p>
      <p class="f-s-14">PRONÓSTICO FUNCIONAL:..............................................................................................................................................................</p>
      <p class="f-s-14">CONTROL Y TRATAMIENTO A SEGUIR:.......................................................................................................................................</p>
      <br><br>
      <p class="f-s-14">
        RECOMENDACIONES:............................................................................................................................................................... ........................................................................................................................................................................................................
      </p>
      <br>
      <p class="f-s-14">FECHA: ...........................................</p>
    </div>
    <br><br>
    <p style="width:100%;" class="center f-s-14">_______________________________________________________________</p>
    <p style="width:100%;" class="center f-s-14">FIRMA DEL MEDICO TRATANTE MATRICULA MPSSP</p>
  </div>
</body>
</html>