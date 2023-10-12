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
          <th>MATRÍCULA P.</th>
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
          <td>{{ $medico->especialidad }}</td>
          <td>{{ $medico->matProfesional }}</td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opciones
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#"><i class="fas fa-edit text-primary"></i> Editar</a>
                <a class="dropdown-item" href="#"><i class="fas fa-trash text-danger"></i> Eliminar</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" type="button" href="#" data-toggle="modal" data-target="#modal_pass" data-name="{{$medico->apellidos.' '.$medico->nombres}}" data-id="{{$medico->idUsuario}}">Restablecer contraseña</a>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!-- Modal Restablecer contrasena -->
<div class="modal fade" id="modal_pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Está seguro de restablecer la contraseña del usuario?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Da clic en aceptar para restablecer la contrasena de <b id="name_res_pass"></b>
        <input type="hidden" name="idUsuario" id="id_res_pass">
        @csrf
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="resetPass()">Restablecer</button>
      </div>
    </div>
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
  // hola();
  $(document).ready(function(){
    
    $("#t_medico").DataTable({
      language: lenguaje,
      scrollX: true,
      autoWidth: false,
      scrollY: '50vh'
    });
  })
  $("#modal_pass").on('show.bs.modal', (e) => {
    console.log(e.relatedTarget)
    $('#name_res_pass').html(e.relatedTarget.dataset.name);
    $('#id_res_pass').val(e.relatedTarget.dataset.id);
  });
  async function resetPass(){
    const res = await $.ajax({
      url: '/admin/password/reset',
      type: 'PUT',
      data: {idUsuario: $('#id_res_pass').val(), _token: $('input[name="_token"]').val()},
      dataType: 'json'
    });
    if(res.status === 'success'){
      mensajeToast('Contraseña restablecida', res.message, 'success', 2000)
    }else{
      mensajeToast('Ups! Ocurrió un error', res.message, 'danger', 2000)
    }
    $('#name_res_pass').html('')
    $('#id_res_pass').val('');
  }
</script>
@stop