@extends('adminlte::page')


@section('title', 'Crear Medico')

@section('content_header')
  <h1>Crear un nuevo paciente</h1>
@stop


@section('content')
<div class="card">
  <div class="card-header">
    <button class="btn btn-secondary" onclick="history.back()">Volver</button>
  </div>
  <div class="card-body">
    {!! Form::open(['route'=>'paciente.store']) !!}
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('nombres', 'Nombre (s)', []) !!}
          {!! Form::text('nombres', null, ['class'=>'form-control', 'placeholder'=>'Ingrese nombres del paciente']) !!}
        </div>
        <div class="form-group col-md-4">      
          {!! Form::label('appellidos', 'Apellidos', []) !!}
          {!! Form::text('apellidos', null, ['class'=>'form-control', 'placeholder'=>'Apellidos del paciente']) !!}
        </div>
        <div class="form-group col-md-4">      
          {!! Form::label('ci', 'Carnet de Identidad (solo números)', []) !!}
          {!! Form::text('ci', null, ['class'=>'form-control', 'placeholder'=>'1231345', 'id'=>'ci']) !!}
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('fechaNac', 'Fecha de nacimiento', []) !!}
          {!! Form::date('fechaNac', null, ['class'=>'form-control','onchange'=>'calcularEdad()', 'id'=>'fechaNac']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('genero', 'Genero.', []) !!}
          {!! Form::select('genero', ['F'=>'FEMENINO', 'M'=>'MASCULINO'],null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('edad', 'Edad', []) !!}
          {!! Form::text('edad', null, ['class'=>'form-control', 'disabled'=>true, 'id'=>'edad']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('codPaciente', 'Código del paciente', []) !!}
          {!! Form::text('codPaciente', null, ['class'=>'form-control', 'id'=>'codPaciente']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('celular', 'Teléfono o Celular', []) !!}
          {!! Form::text('celular', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('email', 'Correo electrónico', []) !!}
          {!! Form::email('email', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('procedencia', 'Procedencia para atención', []) !!}
          {!! Form::select('procedencia', ['Interconsulta'=>'Interconsulta', 'Externo'=>'Externo'], null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('tipo', 'Seleccione una especialidad', []) !!}
          {!! Form::select('tipo', ['EMERGENCIA'=>'EMERGENCIA', 'ONCOLOGÍA'=>'ONCOLOGÍA', 'HEMATOLOGÍA'=>'HEMATOLOGÍA'], null, ['class'=>'form-control', 'id'=>'tipo']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('idMedico', 'Seleccione un médico', []) !!}
          {!! Form::select('idMedico', $arrMedic, null, ['class'=>'form-control', 'id'=>'medicoSelect']) !!}
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('codSus', 'Código de S.U.S.', []) !!}
          {!! Form::text('codSus', null, ['class'=>'form-control', 'placeholder'=>'Identificador del seguro']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('fechaConsulta', 'Día que hará la consulta (fecha)', []) !!}
          {!! Form::date('fechaConsulta', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4"></div>
      </div>
      <div class="form-row mt-2">
        <div class="form-group col-md-12">
          {!! Form::submit('Guardar Paciente', ['class' => 'btn btn-primary float-right']) !!}
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop


@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script src="/custom/js/main.js"></script>
  <script> 
    $('#ci').on('change', () => {
      $('#codPaciente').val($('#ci').val())
    })
    $("#tipo").on('change', async () => {
      console.log('Cambio: '+$("#tipo").val())
      try {
        const res = await $.ajax({
          url: '/api/medico/'+$("#tipo").val(),
          type: 'GET',
          dataType: 'json'
        });
        if(res.status === 'success'){
          $("#medicoSelect").html(res.html);
        }else{
          console.log(res.html)
        }
      } catch (error) {
        console.log(error)
      }
    })
  </script>
@stop