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
    <h4>Campos con {{'(*)'}} requeridos </h4>
    {!! Form::open(['route'=>'paciente.store', 'id'=>'form_pac']) !!}
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('nombres', '* Nombre (s)', []) !!}
          {!! Form::text('nombres', null, ['class'=>'form-control form-cad-3', 'placeholder'=>'Ingrese nombres del paciente', 'required']) !!}
          <div  class="invalid-feedback">
            Debe tener un minimo de 3 caracteres
          </div>
        </div>
        <div class="form-group col-md-4">      
          {!! Form::label('appellidos', '* Apellidos', []) !!}
          {!! Form::text('apellidos', null, ['class'=>'form-control form-cad-3', 'placeholder'=>'Apellidos del paciente', 'required']) !!}
          <div  class="invalid-feedback">
            Debe tener un minimo de 3 caracteres
          </div>
        </div>
        <div class="form-group col-md-4">      
          {!! Form::label('ci', '* Carnet de Identidad (solo números)', []) !!}
          {!! Form::text('ci', null, ['class'=>'form-control form-number', 'placeholder'=>'1231345', 'id'=>'ci', 'required']) !!}
          <div  class="invalid-feedback">
            Por favor, ingrese solo los números 
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('fechaNac', '* Fecha de nacimiento', []) !!}
          {!! Form::date('fechaNac', null, ['class'=>'form-control form-age','onchange'=>'calcularEdad()', 'id'=>'fechaNac', 'required']) !!}
          <div  class="invalid-feedback">
            Fuera del rango permitido
          </div>
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
          {!! Form::label('codPaciente', '* Código del paciente', []) !!}
          {!! Form::text('codPaciente', null, ['class'=>'form-control', 'id'=>'codPaciente', 'required']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('celular', 'Teléfono o Celular', []) !!}
          {!! Form::text('celular', null, ['class'=>'form-control form-movil-phone']) !!}
          <div  class="invalid-feedback">
            Agrege un teléfono o celular válido
          </div>
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('email', '* Correo electrónico', []) !!}
          {!! Form::email('email', null, ['class'=>'form-control form-email', 'required']) !!}
          <div  class="invalid-feedback">
            Ingrese un correo electrónico válido
          </div>
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('procedencia', '* Procedencia para atención', []) !!}
          {!! Form::select('procedencia', ['Interconsulta'=>'Interconsulta', 'Externo'=>'Externo'], null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('tipo', '* Seleccione una especialidad', []) !!}
          {!! Form::select('tipo', ['EMERGENCIA'=>'EMERGENCIA', 'ONCOLOGÍA'=>'ONCOLOGÍA', 'HEMATOLOGÍA'=>'HEMATOLOGÍA'], null, ['class'=>'form-control', 'id'=>'tipo', 'required']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('idMedico', '* Seleccione un médico', []) !!}
          {!! Form::select('idMedico', $arrMedic, null, ['class'=>'form-control', 'id'=>'medicoSelect', 'required']) !!}
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('codSus', '* Código de S.U.S.', []) !!}
          {!! Form::text('codSus', null, ['class'=>'form-control', 'placeholder'=>'Identificador del seguro', 'required']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('fechaConsulta', '* Día que hará la consulta (fecha)', []) !!}
          {!! Form::date('fechaConsulta', null, ['class'=>'form-control form-today', 'required']) !!}
          <div  class="invalid-feedback">
            La fecha debe ser mayor al día de hoy
          </div>
        </div>
        <div class="form-group col-md-4"></div>
      </div>
      <div class="form-row mt-2">
        <div class="form-group col-md-12">
          {!! Form::submit('Guardar Paciente', ['class' => 'btn btn-primary float-right', 'id' => 'btn_form', 'disabled']) !!}
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop


@section('css')

@stop

@section('js')
  <script src="/custom/js/main.js"></script>
  <script src="/custom/js/formValidator.js"></script>
  <script>
    validator('btn_form', 'form_pac');
    validator_age_range(0,18);
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