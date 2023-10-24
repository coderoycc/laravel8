@extends('adminlte::page')


@section('title', 'Evolución')

@section('content_header')
<div class="d-flex justify-content-between">
  <h1>Evolucion ST JUDE del paciente</h1>
  <button class="btn btn-secondary" onclick="history.back()">Volver</button>
</div>
@stop


@section('content')
{{-- {{print_r($historial)}} --}}
<div class="callout callout-success">
  <h5 class="font-weight-bold">Datos del paciente:</h5>
  <div class="row">
    <div class="col-md-4"><b>Nombre completo:</b> {{$historial->paciente->nombres.' '.$historial->paciente->apellidos}}</div>
    <div class="col-md-4"><b>Edad:</b> {{$historial->paciente->edad($historial->paciente->fechaNac)}}</div>
    <div class="col-md-4"><b>Tipo de cáncer:</b> {{$historial->tipoCancer}}</div>
    <div class="col-md-4"><b>Procedencia: </b> {{$historial->procedencia}}</div>
    <div class="col-md-4"><b>Servicio: </b> {{$historial->servicio}}</div>
    <div class="col-md-4"><b>Etapa del cáncer: </b> {{$historial->etapa}}</div>
  </div>
  <div class="row mt-3">
    <div class="col-12 d-flex justify-content-center">
      <a href="{{route('report', ['idPaciente'=>$historial->idPaciente])}}" target="_blank" class="btn btn-success text-white">Ver Reporte</a>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <nav class="w-100">
      <div class="nav nav-tabs" id="product-tab" role="tablist">
        @if ($mostrarMedicamentos)
        <a class="nav-item nav-link active" id="reg-evolucion-tab" data-toggle="tab" href="#reg-evolucion" role="tab" aria-controls="reg-evolucion" aria-selected="false">Registro de Evolución</a>
        <a class="nav-item nav-link" id="reg-intratecales-tab" data-toggle="tab" href="#reg-intratecales" role="tab" aria-controls="reg-intratecales" aria-selected="false">Intratecales</a>
        @else
        <a class="nav-item nav-link active" id="reg-aplicacion-tab" data-toggle="tab" href="#reg-aplicacion" role="tab" aria-controls="reg-aplicacion" aria-selected="false">Aplicación de medicamentos</a>            
        @endif
      </div>
    </nav>
    <div class="tab-content p-3" id="nav-tabContent">
      @if($mostrarMedicamentos)
      <div class="tab-pane fade show active" id="reg-evolucion" role="tabpanel" aria-labelledby="reg-evolucion-tab">
        <h3>Etapa de Evolución: <b>{{$evolucion->etapaActual->detalle}}</b></h3>
        <form id="form_registro">
          @csrf
          <input type="hidden" name="idTratamiento" value="{{$tratamiento->idTratamiento}}">
          <div class="row">
            <div class="col-md-8">
              <h5>Medicamentos</h5>
              @foreach ([1,2,3,4,5,6] as $item)
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Medicamento {{$item}}</label>
                  <select class="form-control select2" style="width: 100%;padding-bottom:5px;" name="idMedicamento{{$item}}">
                    {!! $html !!}
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Dosis</label>
                  <input type="text" name="dosis{{$item}}" class="form-control">
                </div>
              </div>
              @endforeach
            </div>

            <div class="col-md-4" >
              <br><br>
              <h5>Fechas de inicio del tratamiento </h5>
              <?php
              $hoy = date('Y-m-d');
              $fechaNueva = date('Y-m-d', strtotime($hoy . ' + 20 days'));
              ?>
              <div class="form-group">
                <input type="date" class="form-control" value="{{$hoy}}" id="f_inicio" name="fechaInicio">
              </div>
              <div>
                <h5>Fecha Final de la etpa</h5>
                <input type="date" class="form-control" id="f_final" value="{{$fechaNueva}}" disabled>
              </div>
              <br><br>
              <button type="submit" class="btn btn-success" id="btn_registro">Terminar Registro</button>
            </div>
          </div>
        </form>
      </div>
      <div class="tab-pane fade" id="reg-intratecales" role="tabpanel" aria-labelledby="reg-intratecales-tab">
        <h3>Registre medicamentos <b>Intratecales</b></h3>
        <form id="form_intratecales">
          @csrf
          <input type="hidden" name="idTratamiento" value="{{$tratamiento->idTratamiento}}">
          <div class="row">
            <div class="col-md-8">
              <h5>Intratecales</h5>
              @foreach ([1,2,3] as $item)
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Medicamento Intratecal {{$item}}</label>
                  <select class="form-control select2" style="width: 100%;padding-bottom:5px;" name="idIntra{{$item}}">
                    {!! $html !!}
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Dosis</label>
                  <input type="text" name="dosisIntra{{$item}}" class="form-control">
                </div>
              </div>
              @endforeach
            </div>
            <div class="col-md-4" >
              <br><br>
              <button type="submit" class="btn btn-success" id="btn_intratec">Registrar medicamentos</button>
            </div>
          </div>
        </form>
      </div>
      @else
      <div class="tab-pane fade show active" id="reg-aplicacion" role="tabpanel" aria-labelledby="reg-aplicacion-tab">
        <div class="row d-flex justify-content-between">
          <h4>Registra las próximas fechas de la etapa: <b>{{$evolucion->etapaActual->detalle}}</b></h4>
          <button type="button" class="btn btn-primary" id="btn_changes">REGISTRAR CAMBIOS</button>
        </div>
        <div class="overflow-auto">
          @csrf
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Dosis</th>
                @foreach ($arrFechas as $fecha)
                <th>{{$fecha}}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach ($tratamiento->contenido as $contenido)
                <tr>
                  <td style="text-align:right">{{$contenido->medicamento->descripcion}}</td>
                  <td>{{$contenido->dosis}}</td>
                  @foreach ($contenido->aplicado($arrFechas) as $fecha => $idAplicacion)
                  <td><input type="checkbox" data-idconttrat="{{$contenido->idContenidoTrat}}" data-fecha="{{$fecha}}" {{$idAplicacion != 0 ? 'checked':''}} data-idapptrat="{{$idAplicacion}}"></td>
                  @endforeach
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
@stop


@section('css')
  <style>
    .no-resize {
      resize: none; 
    }
    .linea-baja{
      padding-bottom: 7px;
      border-bottom: 1px solid #b9b9b9; 
    }
    .form-list{
      width: 130px;
      height: calc(2.25rem + 2px);
      padding: .375rem .75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: .25rem;
    }
    .form-list:focus{
      border: 1px solid #80bdff;
    }
    .form-list:active{
      border: 1px solid #80bdff;
    }
    .autocomplete {
      position: relative;
    }

    #sugerencias {
      position: absolute;
      /* top: 100%; */
      left: 0;
      width: 100%;
      border: 1px solid #ccc;
      background-color: #fff;
      list-style: none;
      margin: 0;
      padding: 0;
      z-index: 10;
      display: none; /* Oculta la lista inicialmente */
    }

    #sugerencias li {
      padding: 10px;
      border-bottom: 1px solid #ccc;
      cursor: pointer;
    }

    #sugerencias li:hover {
      background-color: #f5f5f5;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #444;
      line-height: 1rem;
    }
    .select2-container .select2-selection--single {
      height: auto !important;
    }
    thead {
      height: 110px;
    }
    .table thead th{
      vertical-align: middle !important;
    }
    th {
      text-align: center;
      font-size: 14px;
      font-weight: bold;
      transform: rotate(-90deg);
    }
    td{
      text-align: center;
    }
  </style>
@stop

@section('js')
  <script src="/custom/js/main.js"></script>
  <script>
    $('.select2').select2()

    $("#f_inicio").change(()=>{
      const fecha = $("#f_inicio").val();
      const fechaObj = new Date(fecha);
      fechaObj.setDate(fechaObj.getDate() + 20);
      const nuevaFecha = `${fechaObj.getFullYear()}-${(fechaObj.getMonth() + 1) > 9 ? '' : '0'}${fechaObj.getMonth()+1}-${fechaObj.getDate() > 9 ? '':'0'}${fechaObj.getDate()}`
      $('#f_final').val(nuevaFecha);
    })
    $("#form_registro").submit(async (e) => {
      e.preventDefault();
      const data = $("#form_registro").serialize()+'&fechaFinal='+$("#f_final").val()
      const res = await $.ajax({
        url: '/tratamiento/create',
        type: 'POST',
        data,
        dataType: 'json'
      });
      if(res.status === 'success'){
        mensajeToast('Guardado con exito ', 'El tratamiento se ha guardado correctamente', 'success', 2000)
        $("#btn_registro").attr('disabled', 'disabled')
        $("#f_inicio").attr('disabled', 'disabled')
        // setTimeout(() => {
        //   location.reload();
        // }, 2100);
      }else{
        mensajeToast('Ocurrio un error', 'No se pudo registrar los datos', 'danger', 2500);
        console.warn(res)
      }
    })

    $("#form_intratecales").submit(async (e) => {
      e.preventDefault();
      const data = $("#form_intratecales").serialize();
      const res = await $.ajax({
        url: '/tratamiento/create/intratecales',
        type: 'POST',
        data,
        dataType: 'json'
      })
      if(res.status === 'success'){
        mensajeToast('Registro exitoso de intratecales', res.message, 'success', 2200);
        $('#btn_intratec').attr('disabled', 'disabled');
        if($("#btn_registro").attr('disabled') != 'disabled'){
          setTimeout(() => {
            mensajeToast('¡ADVERTENCIA!', 'Por favor, llene los medicamentos para el tratamiento', 'warning', 2600);
          }, 2450);
        }else{
          setTimeout(() => {
            location.reload();
          }, 2500);
        }
      }else{
        mensajeToast('¡Ups! Ocurrió un error', res.message, 'danger', 2500)
      }
    })

    $("#btn_changes").click(async () => {
      $("#btn_changes").attr('disabled', 'disabled');
      let arrChecks = []
      let arrDelete = []
      $("input[type='checkbox']").each((_,e) => {
        if(e.checked){
          if(e.dataset.idapptrat == 0){
            arrChecks.push({
              fechaAplicacion: e.dataset.fecha,
              idContenidoTrat: e.dataset.idconttrat
            })
          }
        }else{
          if(e.dataset.idapptrat != 0){
            arrDelete.push(e.dataset.idapptrat)
          }
        }
      });
      try {
        const res = await $.ajax({
          url: '/evolucion/insertDelete/appTrat',
          type: 'POST',
          data: {data: JSON.stringify(arrChecks), dataDelete: JSON.stringify(arrDelete), _token: $("input[name='_token']").val()},
          dataType: 'JSON'
        });
        if(res.status === 'success'){
          mensajeToast('Se has modificado las fechas', res.message, 'success', 2400)
        }
      } catch (error) {
        console.warn(error)
        mensajeToast('¡Ups! Ocurrió un error', 'Ocurrió un error al intentar guardar los datos', 'warning', 2000)
      }
    })
  </script>
@stop