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
          <th>C.I.</th>
          <th># CARNET S.U.S.</th>
          <th>OPCIONES</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pacientes as $paciente)

        <tr>
          <td>{{$paciente->apellidos}}</td>
          <td>{{$paciente->nombres}}</td>
          <td>{{$paciente->edad($paciente->fechaNac)}}</td>
          <td align="center">{{$paciente->ci }}</td>
          <td align="center">{{$paciente->codSus}}</td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opciones
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#"><i class="fas fa-edit text-primary"></i> Editar</a>
                <a class="dropdown-item" href="#"><i class="fas fa-trash text-danger"></i> Eliminar</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" type="button" href="#" data-toggle="modal" data-target="#modal_pass" data-name="{{$paciente->apellidos.' '.$paciente->nombres}}" data-id="{{$paciente->idUsuario}}">Restablecer contraseña</a>
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