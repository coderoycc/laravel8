@extends('adminlte::page')


@section('title', 'Medicos')

@section('content_header')
  <h1>Médicos dados de baja</h1>

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
      <table id="t_medico" class="table table-striped">
        <thead>
          <tr align="center">
            <th>APELLIDOS</th>
            <th>NOMBRES</th>
            <th>TELÉFONO/CELULAR</th>
            <th>CORREO E.</th>
            <th>ESPECIALIDAD</th>
            <th>MATRÍCULA P.</th>
            <th>FECHA BAJA</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($medicos as $medico)
            <tr>
              <td>{{ $medico->apellidos }}</td>
              <td>{{ $medico->nombres }}</td>
              <td align="center">{{ $medico->celular }}</td>
              <td>{{ $medico->email }}</td>
              <td>{{ $medico->especialidad }}</td>
              <td>{{ $medico->matProfesional }}</td>
              <td>{{ $medico->fechaBaja }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop

@section('js')
  <script src="/custom/js/main.js"></script>
  <script>
    // hola();
    $(document).ready(function() {
      $("#t_medico").DataTable({
        language: lenguaje,
        scrollX: true,
        autoWidth: false,
        scrollY: '50vh'
      });
    })
  </script>
@stop
