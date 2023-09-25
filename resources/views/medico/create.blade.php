@extends('adminlte::page')


@section('title', 'Crear médico')

@section('content_header')

  <h1>Crear un nuevo médico</h1>
@stop


@section('content')

<div class="card">
  <div class="card-body">
    {!! Form::open(['route'=>'medico.store']) !!}
      <div class="form-row">
        <div class="form-group col-md-6">
          {!! Form::label('nombre', 'Nombre (s)', []) !!}
          {!! Form::text('nombre', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-6">      
          {!! Form::label('appellido', 'Apellidos', []) !!}
          {!! Form::text('apellido', null, ['class'=>'form-control']) !!}
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('ci', 'Nro. Carnet', []) !!}
          {!! Form::text('ci', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('especialidad', 'Especialidad', []) !!}
          {!! Form::text('especialidad', null, ['class'=>'form-control']) !!}
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
  <script>  </script>
@stop