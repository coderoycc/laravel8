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
                <a class="dropdown-item" href="{{route('paciente.edit', $paciente->idUsuario)}}"><i class="fas fa-edit text-primary"></i> Editar</a>
                <a class="dropdown-item" href="#" type="button" data-toggle="modal" data-target="#modal_eliminar_paciente" data-name="{{$paciente->apellidos.' '.$paciente->nombres}}" data-id="{{$paciente->idUsuario}}"><i class="fas fa-trash text-danger"></i> Eliminar</a>
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

@include('pacientes.modals')
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

  $("#modal_eliminar_paciente").on('show.bs.modal', (e) => {
    const id = e.relatedTarget.dataset.id;
    const nombre = e.relatedTarget.dataset.name;
    $("#name_paciente").html(nombre);
    $("#idPaciente_eliminar").val(id);
  })

  async function eliminarPaciente(){
    const id = $("#idPaciente_eliminar").val();
    mensajeToast('[Operación exitosa paciente]', 'Se eliminó al paciente de manera exitosa', 'success', 2200);
    console.log(id);
  }
</script>
@stop