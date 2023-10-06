@extends('adminlte::page')


@section('title', 'Pacientes')

@section('content_header')
  <div class="d-flex m-2 justify-content-between">
    <h1>Mis pacientes nuevos</h1>
  </div>
@stop


@section('content')
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
  <div class="card-body">
    <table id="t_paciente" class="table table-striped">
      <thead>
        <tr align="center">
          <th>NOMBRE COMPLETO</th>
          <th>EDAD</th>
          <th># CARNET S.U.S.</th>
          <th>FECHA DE REGISTRO</th>
          <th>CONSULTA PROGRAMADA</th>
          <th>ATENDER</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($historiales as $historial)
          <?php $fecha1 = date_create($historial->fechaRegistro);
          $fecha2 = date_create($historial->fechaConsulta)?>
          <tr>
            <td>{{$historial->paciente->apellidos.' '.$historial->paciente->nombres}}</td>
            <td>{{$historial->paciente->edad($historial->paciente->fechaNac)}}</td>
            <td>{{$historial->paciente->codSus}}</td>
            <td>{{$fecha1->format('d/m/Y')}}</td>
            <td>{{$fecha2->format('d/m/Y')}}</td>
            <td><a href="{{ route('historial.edit', $historial->idHistorial) }}" class="btn btn-success"><i class="fas fa-notes-medical"></i> Atender</a></td>
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
      ordering: false,
      scrollY: '50vh'
    });
  })

</script>
@stop