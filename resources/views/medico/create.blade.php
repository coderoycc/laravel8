@extends('adminlte::page')


@section('title', 'Crear médico')

@section('content_header')

  <h1>Crear un nuevo médico</h1>
@stop


@section('content')

<div class="card">
  <div class="card-header">
    <button class="btn btn-secondary" onclick="history.back()">Volver</button>
  </div>
  <div class="card-body">
    {!! Form::open(['route'=>'medico.store']) !!}
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('nombres', 'Nombre (s)', []) !!}
          {!! Form::text('nombres', null, ['class'=>'form-control', 'placeholder'=>'Escriba su nombre']) !!}
        </div>
        <div class="form-group col-md-4">      
          {!! Form::label('appellidos', 'Apellidos', []) !!}
          {!! Form::text('apellidos', null, ['class'=>'form-control', 'placeholder'=>'Ingrese Apellidos']) !!}
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
          {!! Form::label('genero', 'Género.', []) !!}
          {!! Form::select('genero', ['F'=>'FEMENINO', 'M'=>'MASCULINO'],null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('edad', 'Edad', []) !!}
          {!! Form::text('edad', null, ['class'=>'form-control', 'disabled'=>true, 'id'=>'edad']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('especialidad', 'Especialidad', []) !!}
          {!! Form::select('especialidad', ['ONCOLOGÍA'=>'ONCOLOGÍA', 'HEMATOLOGÍA'=>'HEMATOLOGÍA'], null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('celular', 'Teléfono o Celular', []) !!}
          {!! Form::text('celular', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('matProfesional', 'Matrícula profesional', []) !!}
          {!! Form::text('matProfesional', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('email', 'Correo electrónico', []) !!}
          {!! Form::email('email', null, ['class'=>'form-control']) !!}
        </div>
      </div>
      <div class="form-row mt-2">
        <div class="form-group col-md-12">
          {!! Form::submit('Guardar Médico', ['class' => 'btn btn-primary float-right']) !!}
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
@stop