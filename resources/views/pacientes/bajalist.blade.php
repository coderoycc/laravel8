@extends('adminlte::page')


@section('title', 'Pacientes')

@section('content_header')

  <h1>Pacientes dados de baja</h1>

@stop


@section('content')

  <div class="card">
    <div class="card-header">
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
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
            <th>APELLIDOS</th>
            <th>NOMBRES</th>
            <th>EDAD</th>
            <th>C.I.</th>
            <th># CARNET S.U.S.</th>
            <th>FECHA BAJA</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pacientes as $paciente)
            <tr>
              <td>{{ $paciente->apellidos }}</td>
              <td>{{ $paciente->nombres }}</td>
              <td>{{ $paciente->edad($paciente->fechaNac) }}</td>
              <td align="center">{{ $paciente->ci }}</td>
              <td align="center">{{ $paciente->codSus }}</td>
              <td>{{ $paciente->fechaBaja }}</td>
            </tr>
          @endforeach
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
    $(document).ready(function() {
      $("#t_paciente").DataTable({
        language: lenguaje,
        scrollX: true,
        autoWidth: false,
        scrollY: '50vh'
      });
    })
  </script>
@stop
