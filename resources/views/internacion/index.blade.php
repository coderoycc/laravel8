@extends('adminlte::page')


@section('title', 'Pacientes Internados')

@section('content_header')
  <div class="d-flex m-2 justify-content-between">
    <h1>Pacientes Internados</h1>
    <a href="{{route('internacion.solicitud')}}" class="btn btn-warning" > Solicitudes de internación</a>
    <button type="button" class="btn btn-secondary" onclick="history.back()"> Volver</button>
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
          <th>INDICACIONES</th>
          <th>CAMA</th>
          <th>OPCIONES</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($internaciones as $internacion)
        <tr>
          <td>{{$internacion->medico->apellidos.' '.$internacion->medico->nombres}}</td>
          <td>{{$internacion->paciente->apellido.' '.$internacion->paciente->nombres}}</td>
          <td>{{$internacion->indicaciones}}</td>
          <td></td>
          <td>
            <a href="{{route('internacion.formulario', ['idInternacion'=>$internacion->idInternacion])}}" type="button" target="_blank" class="btn btn-secondary"><i class="fas fa-print"></i> Imprimir solicitud</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop


@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
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
  })

</script>
@stop