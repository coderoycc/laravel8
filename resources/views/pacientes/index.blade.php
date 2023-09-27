@extends('adminlte::page')


@section('title', 'Pacientes')

@section('content_header')
  <div class="d-flex m-2 justify-content-between">
    <h1>Ver Pacientes</h1>
    <a class="btn btn-success float-right" href="{{route('paciente.create')}}"><i class="fas fa-plus"></i> Nuevo Paciente</a>

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
          <td>{{$paciente->apellidos}}</td>
          <td>{{$paciente->nombres}}</td>
          <td>{{$paciente->edad($paciente->fechaNac)}}</td>
          <td align="center">{{$paciente->genero == 'F' ? 'FEMENINO' : 'MASCULINO'}}</td>
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
    
    $("#t_paciente").DataTable({
    });
  })

</script>
@stop