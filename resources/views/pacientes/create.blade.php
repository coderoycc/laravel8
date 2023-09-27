@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
  <h1>Crear un nuevo paciente</h1>
@stop


@section('content')
<div class="card">
 
  <div class="card-body">
    {!! Form::open(['route'=>'paciente.store']) !!}
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('nombres', 'Nombre (s)', []) !!}
          {!! Form::text('nombres', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">      
          {!! Form::label('appellidos', 'Apellidos', []) !!}
          {!! Form::text('apellidos', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">      
          {!! Form::label('ci', 'Nro. Carnet de Identidad (solo números)', []) !!}
          {!! Form::text('ci', null, ['class'=>'form-control', 'placeholder'=>'12312345']) !!}
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
          {!! Form::text('codPaciente', null, ['class'=>'form-control']) !!}
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
          {!! Form::label('idMedico', 'Seleccione un médico', []) !!}
          {!! Form::select('idMedico', $arrMedic, null, ['class'=>'form-control']) !!}
        </div>
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
  <script> 
    function calcularEdad(){
      const fechaNac = $('#fechaNac').val();
      const today = new Date();
      const ageInMillis = today.getTime() - new Date(fechaNac).getTime();
      const ageYears = Math.floor(ageInMillis / (365.25 * 24 * 60 * 60 * 1000));
      const ageMonths = Math.floor((ageInMillis % (365.25 * 24 * 60 * 60 * 1000)) / (30.436875 * 24 * 60 * 60 * 1000));
      const ageDays = Math.floor((ageInMillis % (30.436875 * 24 * 60 * 60 * 1000)) / (24 * 60 * 60 * 1000));
      $("#edad").val(`${ageYears} años ${ageMonths} meses ${ageDays} días`); 
    }
  </script>
@stop