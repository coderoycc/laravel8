@extends('adminlte::page')


@section('title', 'Consultas')

@section('content_header')
  <div class="d-flex m-2 justify-content-between">
    <h1>{{$historial->paciente->apellidos.' '.$historial->paciente->nombres}}</h1>
    <button typw="button" class="btn btn-secondary" onclick="history.back()"> Volver</button>
  </div>
@stop


@section('content')
{{-- {{print_r($consultas)}}  --}}
<div class="card">
  <div class="card-header">
    <div class="row m-2">
      <div class="col-md-3"><b>Procedencia:</b> {{$historial->procedencia}}</div>
      <div class="col-md-3"><b>Servicio:</b> {{$historial->servicio}} </div>
      <div class="col-md-3"><b>Fecha de registro:</b> {{ date('d/m/Y', strtotime($historial->fechaRegistro)) }} </div>
      <div class="col-md-3"><b>Etapa cáncer:</b> {{$historial->etapa}} </div>
    </div>
  </div>
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
        @foreach ($historial->consultas as $consulta)
            <tr>
              <td>{{date('d/m/Y', strtotime($consulta->fechaConsulta))}}</td>
              <td>{{$consulta->valoracion}}</td>
              <td>{{$consulta->observaciones}}</td>
              <td>{{$consulta->peso}}</td>
              <td>{{$consulta->talla}}</td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Opciones
                  </button>
                  <div class="dropdown-menu">
                    @if (isset($consulta->receta->idReceta) )
                    <a class="dropdown-item" target="_blank" href="{{route('receta.show', ['idReceta'=>$consulta->receta->idReceta])}}"> <i class="fas fa-notes-medical text-info"></i> Ver receta médica</a>
                    @endif
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
      scrollY: '50vh',
      ordering: false,
    });
  })

</script>
@stop