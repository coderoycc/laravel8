@extends('adminlte::page')


@section('title', 'Medicos')

@section('content_header')
  <div class="d-flex m-2 justify-content-between">
    <h1>Ver Médicos</h1>
    <a href="{{route('medico.create')}}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Nuevo Médico</a>
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
    <table id="t_medico" class="table table-striped">
      <thead>
        <tr align="center">
          <th>APELLIDOS</th>
          <th>NOMBRES</th>
          <th>TELÉFONO/CELULAR</th>
          <th>CORREO E.</th>
          <th>ESPECIALIDAD</th>
          <th>OPCIONES</th>
        </tr>
      </thead>
      <tbody>
        @foreach($medicos as $medico)
        <tr>
          <td>{{$medico->apellidos}}</td>
          <td>{{$medico->nombres}}</td>
          <td align="center">{{$medico->celular}}</td>
          <td>{{$medico->email}}</td>
          <td>{{strtoupper($medico->especialidad) }}</td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opciones
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#"><i class="fas fa-edit text-primary"></i> Editar</a>
                <a class="dropdown-item" href="#"><i class="fas fa-trash text-danger"></i> Eliminar</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Restablecer contraseña</a>
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
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
{{-- <script src="/public/app.js"></script> --}}
<script>
  // hola();
  $(document).ready(function(){
    
    $("#t_medico").DataTable({
    });
  })

</script>
@stop