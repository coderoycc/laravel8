@extends('adminlte::page')


@section('title', 'Pacientes')

@section('content_header')
  <div class="d-flex m-2 justify-content-between">
    <h1>Mis Pacientes</h1>
  </div>
@stop


@section('content')
{{-- {{print_r($valores)}}  --}}
<div class="card">
  <div class="card-header">
    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>    
      <strong>{{$message}}</strong>
      </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>    
      <strong>{{ $message }}</strong>
    </div>
    @endif
  </div>
  <?php
  function edad($fechaNac){
    date_default_timezone_set("America/La_Paz");
    $f_fin = date_create(date('Y-m-d'));
    $res = date_diff(date_create($fechaNac), $f_fin);
    return $res->format("%y años %m meses %d dias");
  }
  ?>
  <div class="card-body">
    <table id="t_paciente" class="table table-striped">
      <thead>
        <tr align="center">
          <th>APELLIDOS</th>
          <th>NOMBRES</th>
          <th>EDAD</th>
          <th>PROCEDENCIA</th>
          <th>ETAPA CANCER</th>
          <th>PROX. CONSULTA</th>
          <th>OPCIONES</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($valores as $valor)
          <tr>
            <td>{{$valor->nombres}}</td>
            <td>{{$valor->apellidos}}</td>
            <td>{{edad($valor->fechaNac)}}</td>
            <td>{{$valor->procedencia}}</td>
            <td>{{$valor->etapa}}</td>
            <td>{{$valor->fechaProxConsulta}}</td>
            <td>
              <div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Opciones
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('consulta.create', ['idHistorial'=>$valor->idHistorial])}}"><i class="fas fa-plus-square text-primary"></i> Nueva consulta</a>
                  <a class="dropdown-item" href="{{route('consulta.list', ['idHistorial'=>$valor->idHistorial])}}"> <i class="fas fa-notes-medical text-info"></i> Todas las consultas</a>
                  <a class="dropdown-item" href="{{route('evolucion.show', ['idHistorial'=>$valor->idHistorial])}}"><i class="fas fa-vial text-secondary"></i> Seguir Evolución</a>
                  @if ($valor->estado == 'INTERNADO' || $valor->estado == 'SOLICITUD')
                  <a class="dropdown-item" href="#" type="button" data-toggle="modal" data-target="#modal_alta" data-idinternacion="{{$valor->idInternacion}}" data-fullName="{{$valor->nombres.' '.$valor->apellidos}}"><i class="fas fa-check text-success"></i> Dar de alta</a>
                  @else
                  <a class="dropdown-item" href="#" type="button" data-toggle="modal" data-target="#modal_internacion" data-idMedic="{{$valor->idMedico}}" data-idPaciente="{{$valor->idUsuario}}" data-fullName="{{$valor->nombres.' '.$valor->apellidos}}"><i class="fas fa-file-medical text-warning" ></i> Solicitar Internación</a>
                  @endif
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
{{-- Modal Internacion --}}
<div class="modal fade" id="modal_internacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Formulario de internación </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form onsubmit="return false" id="form_internacion">
          @csrf
          <input type="hidden" id="idPaciente" name="idPaciente" value="">
          <input type="hidden" name="idMedico" id="idMedico" value="">
          <div class="form-group">
            <label>Nombre del paciente</label>
            <input type="text" class="form-control" value="" id="nombre" disabled>
          </div>
          <div class="form-group">
            <label>Fecha de solicitud</label>
            <input type="date" class="form-control" id="fechaSol" name="fechaSolicitud" disabled>
          </div>
          <div class="form-group">
            <label for="motivo">Motivo </label>
            <textarea class="form-control no-resize" name="motivo" rows="2"></textarea>
          </div>
          <div class="form-group">
            <label>Indicaciones a seguir </label>
            <input type="text" class="form-control" name="indicaciones" placeholder="Indicaciones para la internación">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button"  class="btn btn-primary" data-dismiss="modal" id="botonSolicitud" onclick="solicitarInternacion()">Solicitar internación</button>
      </div>
    </div>
  </div>
</div>

{{-- Modal Alta medica --}}
<div class="modal fade" id="modal_alta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Formulario de alta médica </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form onsubmit="return false" id="form_alta">
          @csrf
          <input type="hidden" name="idInternacion" id="idinternacion_alta">
          <div class="form-group">
            <label>Nombre del paciente</label>
            <input type="text" class="form-control" value="" id="nombre_alta" disabled>
          </div>
          <div class="form-group">
            <label>Fecha de solicitud</label>
            <input type="date" class="form-control" id="fecha_alta" disabled>
          </div>
          <div class="form-group">
            <label for="motivo">Motivo </label>
            <div class="d-flex justify-content-around">
              <div class="form-check">
                <input class="form-check-input" type="radio" value="ALTA MEDICA" name="motivo_alta" id="r_am">
                <label class="form-check-label" for="r_am">
                  Alta médica
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" value="ALTA CONSOLIDADA" name="motivo_alta" id="r_ac">
                <label class="form-check-label" for="r_ac">
                  Alta consolidada
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" value="FUGA" name="motivo_alta" id="r_af">
                <label class="form-check-label" for="r_af">
                  Fuga
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Observaciones </label>
            <input type="text" class="form-control" name="observaciones" placeholder="Observaciones de estado de egreso">
          </div>
        </form>
      </div>
      <div class="modal-footer" id="btns_alta">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button"  class="btn btn-primary" id="btn_alta" onclick="darAlta()">Dar de alta</button>
      </div>
    </div>
  </div>
</div>
@stop


@section('css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  <style>
  .no-resize {
    resize: none; 
  }
  </style>
@stop

@section('js')
<script src="/custom/js/main.js"></script>
<script>
  $(document).ready(function(){
    $("#t_paciente").DataTable({
      language: lenguaje,
      scrollX: true,
      autoWidth: false,
      scrollY: '50vh'
    });
  })
  $("#modal_internacion").on('show.bs.modal', async (e)=>{
    $("#botonSolicitud").attr('disabled', false)
    var fechaPorDefecto = new Date();
    var dia = fechaPorDefecto.getDate();
    var mes = fechaPorDefecto.getMonth() + 1;
    var anio = fechaPorDefecto.getFullYear();
    $("#fechaSol").val(`${anio}-${mes>9?'':'0'}${mes}-${dia>9?'':'0'}${dia}`);
    $("#idPaciente").val(e.relatedTarget.dataset.idpaciente);
    $("#idMedico").val(e.relatedTarget.dataset.idmedic);
    $("#nombre").val(e.relatedTarget.dataset.fullname)   
  })
  $("#modal_internacion").on('hide.bs.modal', ()=>{
    setTimeout(() => {
      $("#fechaSol").val('');
      $("#idPaciente").val('');
      $("#idMedico").val('');
      $("#nombre").val('')   
    }, 1200);
  })
  async function solicitarInternacion(){
    const data = $("#form_internacion").serialize();
    const res = await $.ajax({
      url: '/internacion/create',
      type: 'POST',
      data: data,
      dataType: 'json'
    });
    if(res.status == 'success'){
      mensajeToast('Operacion exitosa', res.message, 'success', 2800);
      $("#botonSolicitud").attr('disabled', true);
    }
  }

  $("#modal_alta").on('show.bs.modal', async (e)=>{
    $("#btn_alta").attr('disabled', false)
    var fechaPorDefecto = new Date();
    var dia = fechaPorDefecto.getDate();
    var mes = fechaPorDefecto.getMonth() + 1;
    var anio = fechaPorDefecto.getFullYear();
    $("#fecha_alta").val(`${anio}-${mes>9?'':'0'}${mes}-${dia>9?'':'0'}${dia}`);
    $("#idinternacion_alta").val(e.relatedTarget.dataset.idinternacion);
    $("#nombre_alta").val(e.relatedTarget.dataset.fullname)   
  })

  $("#modal_alta").on('hide.bs.modal', async ()=>{
    setTimeout(() => {
      $("#fecha_alta").val('');
      $("#idinternacion_alta").val('');
      $("#nombre_alta").val('')
    }, 1200);
  })

  async function darAlta(){
    const data = $("#form_alta").serialize();
    console.log(data)
    const res = await $.ajax({
      url: '/altamedica/internacion/update',
      type: 'PUT',
      data: data,
      dataType: 'json'
    });
    if(res.status == 'success'){
      mensajeToast('Alta médica registrada', 'Paciente dado de alta con éxito', 'success', 2800);
      $("#btn_alta").attr('disabled', true);
      $("#btns_alta").append(`
        <button type="button" target="_blank" data-dismiss="modal" class="btn btn-info" onclick="formAlta(${res.idInternacion})"><i class="fas fa-print"></i> Imprimir formulario</button>
      `)
    }else{
      mensajeToast('Ocurrió un error al dar de alta', 'No se pudo dar de alta al paciente', 'error', 2800);
      $("#modal_alta").modal('hide');
    }
  }
  function formAlta(id){
    window.open(window.location.origin+'/altamedica/formulario/'+id);
  }
</script>
@stop