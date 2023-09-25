@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
  <div class="d-flex m-2 justify-content-between">
    <h1>Ver Médicos</h1>
    <a href="{{route('medico.create')}}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Nuevo Médico</a>
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
          <th>ESPECIALIDAD</th>
          <th>OPCIONES</th>
        </tr>
      </thead>
      <tbody>
        @foreach($medicos as $medico)
        <tr>
          <td>{{$medico->usuario}}</td>
          <td>{{$medico->apellidos}}</td>
          <td>{{$medico->nombres}}</td>
          <td >{{$medico->especialidad}}</td>
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