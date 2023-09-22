@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
  <div class="d-flex m-2 justify-content-between">
    <h1>Ver Pacientes</h1>
    <button class="btn btn-success float-right"><i class="fas fa-plus"></i> Nuevo Paciente</button>

  </div>
@stop


@section('content')

<div class="card">
  <div class="card-body">
    <table class="table table-striped">
      <thead>
        <tr align="center">
          <th>USUARIO</th>
          <th>APELLIDOS</th>
          <th>NOMBRES</th>
          <th>EDAD</th>
          <th>GENERO</th>
          <th>OPCIONES</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pacientes as $paciente)

        <tr>
          <td>{{$paciente->usuario}}</td>
          <td>{{$paciente->apellidos}}</td>
          <td>{{$paciente->nombres}}</td>
          <td>{{$paciente->edad($paciente->fechaNac)}}</td>
          <td align="center">{{$paciente->genero == 'F' ? 'FEMENINO' : 'MASCULINO'}}</td>
          <td></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop


@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script> console.log('Hi!'); </script>
@stop