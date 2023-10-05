@extends('adminlte::page')


@section('title', 'Internación')

@section('content_header')
  <div class="d-flex m-2 justify-content-between">
    <h1>Solicitudes de internación</h1>
    <button typw="button" class="btn btn-secondary" onclick="history.back()"> Volver</button>
  </div>
@stop


@section('content')
{{-- {{print_r($consultas)}}  --}}
<div class="card">
  <div class="card-body">
    <table id="t_paciente" class="table table-striped">
      <thead>
        <tr align="center">
          <th>MÉDICO</th>
          <th>PACIENTE</th>
          <th>MOTIVO</th>
          <th>INDICACIONES</th>
          <th>FECHA SOLICITUD</th>
          <th>OPCIONES</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($solicitudes as $solicitud)
        <tr>
          <td>{{$solicitud->medico->apellidos.' '.$solicitud->medico->nombres}}</td>
          <td>{{$solicitud->paciente->apellido.' '.$solicitud->paciente->nombres}}</td>
          <td>{{$solicitud->motivo}}</td>
          <td>{{$solicitud->indicaciones}}</td>
          <td>{{date('d/m/Y', strtotime($solicitud->fechaSolicitud))}}</td>
          <td>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_internar" data-id="{{$solicitud->idInternacion}}"><i class="fas fa-check"></i> Revisar</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="modal fade" id="modal_internar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Internación del paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="content_int" class="m-2">

        </div>
        <form id="form_internacion">
          @csrf
          <input type="hidden" id="idInternacion" name="idInternacion">
          <div class="form-group">
            <label for="">Asignar cama:</label>
            <input type="text" name="cama" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Cerrar</button>
        <button id="enviar" type="button" class="btn btn-primary" onclick="aceptarSol()">Aceptar solicitud</button>
      </div>
    </div>
  </div>
</div>

@stop


@section('css')
@stop

@section('js')
<script src="/custom/js/main.js"></script>
<script>
  $(document).ready(function(){
    $("#t_paciente").DataTable({
      language: lenguaje,
      scrollX: true,
      autoWidth: false,
      scrollY: '50vh',
      ordering: false,
    });
    $("#modal_internar").on('show.bs.modal', async (e) => {
      const idInternacion = e.relatedTarget.dataset.id;
      $("#enviar").before(`<a href="/internacion/formulario/${idInternacion}" id="imprimir" target="_blank" class="btn btn-info d-none">Imprimir</a>`)

      const res = await $.ajax({
        url: `/api/internacion/${idInternacion}`,
        type: 'GET',
        dataType: 'json'
      });
      if(res.status === 'success'){
        $("#idInternacion").val(idInternacion);
        $("#content_int").html(`
        <dl class="row">
          <dt class="col-sm-4">Paciente</dt>
          <dd class="col-sm-8">${res.data.paciente}</dd>
          <dt class="col-sm-4">Médico asignado</dt>
          <dd class="col-sm-8">${res.data.medico}</dd>
          <dt class="col-sm-4">Motivo</dt>
          <dd class="col-sm-8">${res.data.motivo}</dd>
          <dt class="col-sm-4">Indicaciones</dt>
          <dd class="col-sm-8">${res.data.indicaciones}</dd>
          <dt class="col-sm-4">Procedencia paciente</dt>
          <dd class="col-sm-8">${res.data.historial.procedencia}</dd>
          <dt class="col-sm-4">Servicio</dt>
          <dd class="col-sm-8">${res.data.historial.servicio}</dd>
        </dl>`)
      }
    });
    $("#modal_internar").on('hide.bs.modal', async (e) => {
      $("#imprimir").removeClass('d-none')
      $("#imprimir").addClass('d-none');
    })
  })
  async function aceptarSol(){
    $("#enviar").attr('disabled', true);
    const data = $("#form_internacion").serialize();
    const res = await $.ajax({
      url: '/internacion/update',
      dataType:'json',
      type:'PUT',
      data
    })
    if(res.status === 'success'){
      mensajeToast('Operacion exitosa', res.message, 'success', 2500);
      $("#imprimir").removeClass('d-none');
    }else{
      mensajeToast('¡Ups! Ocurrió un error', 'No se pudo revisar la internación', 'danger', 2800);
      $("#modal_internar").modal('hide');
    }
  }
</script>
@stop