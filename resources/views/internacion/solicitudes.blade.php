@extends('adminlte::page')


@section('title', 'Consultas')

@section('content_header')
  <div class="d-flex m-2 justify-content-between">
    <h1>Solicitudes de internación</h1>
    <button typw="button" class="btn btn-secondary" onclick="history.back()"> Volver</button>
  </div>
@stop


@section('content')
{{-- {{print_r($consultas)}}  --}}
<div class="card">
  <div class="card-body">
    <table id="t_paciente" class="table table-striped">
      <thead>
        <tr align="center">
          <th>CONSULTA</th>
          <th>VALORACIÓN</th>
          <th>OBSERVACIÓN</th>
          <th>PESO</th>
          <th>TALLA</th>
          <th>OPCIONES</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
@stop


@section('css')
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