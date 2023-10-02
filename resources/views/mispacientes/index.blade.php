@extends('adminlte::page')


@section('title', 'Pacientes')

@section('content_header')
  <div class="d-flex m-2 justify-content-between">
    <h1>Mis Pacientes</h1>
  </div>
@stop


@section('content')
{{-- {{print_r($valores)}}  --}}
<div class="card">
  <div class="card-header">
    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>    
      <strong>{{$message}}</strong>
      </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>    
      <strong>{{ $message }}</strong>
    </div>
    @endif
  </div>
  <?php
  function edad($fechaNac){
    date_default_timezone_set("America/La_Paz");
    $f_fin = date_create(date('Y-m-d'));
    $res = date_diff(date_create($fechaNac), $f_fin);
    return $res->format("%y años %m meses %d dias");
  }
  ?>
  <div class="card-body">
    <table id="t_paciente" class="table table-striped">
      <thead>
        <tr align="center">
          <th>APELLIDOS</th>
          <th>NOMBRES</th>
          <th>EDAD</th>
          <th>PROCEDENCIA</th>
          <th>ETAPA CANCER</th>
          <th>PROX. CONSULTA</th>
          <th>OPCIONES</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($valores as $valor)
          <tr>
            <td>{{$valor->nombres}}</td>
            <td>{{$valor->apellidos}}</td>
            <td>{{edad($valor->fechaNac)}}</td>
            <td>{{$valor->procedencia}}</td>
            <td>{{$valor->etapa}}</td>
            <td>{{$valor->fechaProxConsulta}}</td>
            <td>
              <div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Opciones
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('consulta.create', ['idHistorial'=>$valor->idHistorial])}}"><i class="fas fa-plus-square text-primary"></i> Nueva consulta</a>
                  <a class="dropdown-item" href="#"> <i class="fas fa-notes-medical text-info"></i> Todas las consultas</a>
                  <a class="dropdown-item" href="#"><i class="fas fa-vial text-warning"></i> Evolución</a>
                </div>
              </div>
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
      scrollY: '50vh'
    });
  })

</script>
@stop