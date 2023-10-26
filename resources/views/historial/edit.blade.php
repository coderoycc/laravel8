@extends('adminlte::page')
@section('title', 'Historial')

@section('content_header')
  <h1>Primera consulta del paciente</h1>
@stop

@section('content')
<div class="card">
  <div class="card-header">
    <button class="btn btn-secondary" onclick="history.back()">Volver</button>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['historial.update', $historial->idHistorial], 'method' => 'PUT', 'id'=>'form_historial']) !!}
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('nombres', 'Nombre (s)', []) !!}
          {!! Form::text('nombres', $historial->paciente->nombres,['class'=>'form-control', 'disabled'=>true]) !!}
        </div>
        <div class="form-group col-md-4">      
          {!! Form::label('appellidos', 'Apellidos', []) !!}
          {!! Form::text('apellidos', $historial->paciente->apellidos, ['class'=>'form-control', 'disabled'=>true]) !!}
        </div>
        <div class="form-group col-md-4">      
          {!! Form::label('ci', 'Carnet de Identidad', []) !!}
          {!! Form::text('ci', $historial->paciente->ci, ['class'=>'form-control', 'disabled'=>true]) !!}
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('procedencia', 'Procedecia', []) !!}
          {!! Form::text('procedencia', $historial->procedencia, ['class'=>'form-control', 'disabled'=>true]) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('servicio', 'Servicio', []) !!}
          {!! Form::text('servicio', $historial->servicio , ['class'=>'form-control', 'disabled'=>true]) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('edad', 'Edad', []) !!}
          {!! Form::text('edad', $historial->paciente->edad($historial->paciente->fechaNac), ['class'=>'form-control', 'disabled'=>true]) !!}
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-3">
          {!! Form::label('tipoCancer', 'Seleccione un tipo de cancer', []) !!}
          {!! Form::select('tipoCancer', 
          [ 'Leucemia'=>'Leucemia','Tumores cerebrales'=>'Tumor cerebral','Neuroblastoma'=>'Neuroblastoma',
            'Linfoma'=>'Linfoma','Cáncer de sarcoma'=>'Cáncer de sarcoma', 'Tumor sólido'=>'Tumor Sólido'], null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-3">
          {!! Form::label('etapa', 'Etapa del cáncer', []) !!}
          {!! Form::select('etapa', ['BAJO'=>'BAJO', 'MEDIO'=>'MEDIO', 'ALTO'=>'ALTO'], null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-3">
          {!! Form::label('peso', 'Peso [kg.]', []) !!}
          {!! Form::number('peso', null, ['class'=>'form-control', 'step' => '0.01']) !!}
        </div>
        <div class="form-group col-md-3">
          {!! Form::label('talla', 'Talla [cm.]', []) !!}
          {!! Form::number('talla', null, ['class'=>'form-control', 'step' => '0.01']) !!}
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('valoracion', 'Valoracion', []) !!}
          {!! Form::textarea('valoracion', '', ['class'=>'form-control no-resize', 'rows'=>4, 'id'=>'valoracion']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('observacion', 'Observaciones (opcional)', []) !!}
          {!! Form::textarea('observacion', '', ['class'=>'form-control no-resize', 'rows'=>4, 'id'=>'obs']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('diagnostico', 'Diagnóstico (s)', []) !!}
          <select class="select2" multiple="multiple" data-placeholder="Selecione uno o varios" id="diag" style="width: 100%;">
            @foreach ($diagnosticoscie as $diag)
            <option value="{{$diag->codigo_cie}}"> {{$diag->descripcion}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('fechaProxConsulta', 'Fecha de la próxima consulta', []) !!}
          {!! Form::date('fechaProxConsulta', null, ['class'=>'form-control form-today']) !!}
          <div  class="invalid-feedback">
            La fecha debe ser mayor al día de hoy
          </div>
        </div>
      </div>
        
      <div class="form-row mt-2">
        <div class="form-group col-md-12 d-flex justify-content-center">
          {!! Form::button('¿Requiere internación?', ['class' => 'btn btn-warning', 'type' => 'button', 'data-toggle'=>'modal', 'data-target'=>'#modal_internacion', 'id'=>'botonSolicitud']) !!}
        </div>
      </div>
      <input name="diagnosticos" type="hidden" id="listDiag" value="">
      <div class="form-row mt-2">
        <div class="form-group col-md-12">
          {!! Form::submit('Guardar Paciente', ['class' => 'btn btn-primary float-right', 'id'=>'btn_enviar', 'disabled']) !!}
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop

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
          <input type="hidden" name="idPaciente" value="{{$historial->idPaciente}}">
          <input type="hidden" name="idMedico" value="{{$historial->idMedico}}">
          <div class="form-group">
            <label>Nombre del paciente</label>
            <input type="text" class="form-control" value="{{$historial->paciente->nombres}} {{$historial->paciente->apellidos}}" disabled>
          </div>
          <div class="form-group">
            <label>Fecha de solicitud</label>
            <input type="date" class="form-control" id="fechaSol" name="fechaSolicitud" disabled>
          </div>
          <div class="form-group">
            <label for="motivo">Motivo </label>
            <textarea class="form-control no-resize" name="motivo" id="motivo" rows="2"></textarea>
          </div>
          <div class="form-group">
            <label>Indicaciones a seguir </label>
            <input type="text" class="form-control" name="indicaciones" placeholder="Indicaciones para la internación">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button"  class="btn btn-primary" data-dismiss="modal" onclick="solicitarInternacion()">Solicitar internación</button>
      </div>
    </div>
  </div>
</div>
@section('css')
<style>
  .no-resize {
    resize: none; 
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice{
    background-color:#0069d9;
  }
</style>
@stop

@section('js')
  <script src="/custom/js/main.js"></script>
  <script src="/custom/js/formValidator.js"></script>
  <script>
    validator('btn_enviar', 'form_historial')
    $('.select2').select2()
    $("#modal_internacion").on('show.bs.modal', ()=>{
      $("#motivo").val($("#valoracion").val());
      var fechaPorDefecto = new Date();
      var dia = fechaPorDefecto.getDate();
      var mes = fechaPorDefecto.getMonth() + 1;
      var anio = fechaPorDefecto.getFullYear();
      $("#fechaSol").val(`${anio}-${mes>9?'':'0'}${mes}-${dia>9?'':'0'}${dia}`);
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
    $("#diag").on('change', ()=>{
      $("#listDiag").val(JSON.stringify($("#diag").val()))
      // console.log($("#listDiag").val())
    })
  </script>
@stop