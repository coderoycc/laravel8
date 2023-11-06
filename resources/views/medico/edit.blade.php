@extends('adminlte::page')


@section('title', 'Crear médico')

@section('content_header')
  <h1>Editar médico</h1>
@stop


@section('content')
<div class="card">
  <div class="card-header">
    <button class="btn btn-secondary" onclick="history.back()">Volver</button>
  </div>
  {{-- {{print_r($medico)}} --}}
  <div class="card-body">
    {!! Form::open(['route'=>['medico.update', $medico], 'id'=>'form_med', 'method'=>'put']) !!}
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('nombres', 'Nombre (s)', []) !!}
          {!! Form::text('nombres', $medico->nombres, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">      
          {!! Form::label('appellidos', 'Apellidos', []) !!}
          {!! Form::text('apellidos', $medico->apellidos, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-4">      
          {!! Form::label('ci', 'Nro. Carnet de Identidad (solo números)', []) !!}
          {!! Form::text('ci', $medico->ci, ['class'=>'form-control', 'readonly'=>'readonly']) !!}
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          {!! Form::label('fechaNac', 'Fecha de nacimiento', []) !!}
          {!! Form::text('fechaNac', date('d/m/Y',strtotime($medico->fechaNac)), ['class'=>'form-control form-age', 'readonly'=>'readonly', 'disabled'=>'disabled']) !!}
        </div>
        <div class="form-group col-md-4">
          <label for="genero">Genero</label>
          <select name="genero" class="form-control">
            <option value="F" {{$medico->genero == 'F' ? 'selected':''}} >FEMENINO</option>
            <option value="M" {{$medico->genero == 'M' ? 'selected':''}} >MASCULINO</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="especialidad">Especialidad</label>
          <select name="especialidad" class="form-control">
            <option value="ONCOLOGÍA" {{$medico->especialidad == 'ONCOLOGÍA' ? 'selected' : ''}}>ONCOLOGÍA</option>
            <option value="HEMATOLOGÍA" {{$medico->especialidad == 'HEMATOLOGÍA' ? 'selected' : ''}}>HEMATOLOGÍA</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('celular', 'Teléfono o Celular', []) !!}
          {!! Form::text('celular', $medico->celular, ['class'=>'form-control form-movil-phone']) !!}
          <div  class="invalid-feedback">
            Agrege un teléfono o celular válido
          </div>
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('matProfesional', 'Matrícula profesional', []) !!}
          {!! Form::text('matProfesional', $medico->matProfesional, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('email', 'Correo electrónico', []) !!}
          {!! Form::email('email', $medico->email, ['class'=>'form-control form-email']) !!}
          <div  class="invalid-feedback">
            Ingrese un correo electrónico válido
          </div>
        </div>
      </div>
      <div class="form-row mt-2">
        <div class="form-group col-md-12">
          {!! Form::submit('Guardar Médico', ['class' => 'btn btn-primary float-right', 'id' => 'btn_form']) !!}
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop

@section('js')
<script src="/custom/js/main.js"></script>
<script src="/custom/js/formValidator.js"></script>
<script>
  validator('btn_form', 'form_med');
  validator_age_range(21,70);
</script>
@stop