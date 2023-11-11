@extends('adminlte::page')


@section('title', 'Medicos')

@section('content_header')
  <div class="d-flex m-2 justify-content-between">
    <h1>Ver Médicos</h1>
    <a href="{{ route('medico.create') }}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Nuevo Médico</a>
  </div>
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
            <th>OPCIONES</th>
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
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Opciones
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('medico.edit', $medico->idUsuario) }}"><i
                        class="fas fa-edit text-primary"></i> Editar</a>
                    <a class="dropdown-item" href="#" type="button" data-toggle="modal"
                      data-target="#modal_eliminar_medico" data-name="{{ $medico->apellidos . ' ' . $medico->nombres }}"
                      data-id="{{ $medico->idUsuario }}"><i class="fas fa-chevron-circle-down text-danger"></i> Dar de
                      baja</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" type="button" href="#" data-toggle="modal" data-target="#modal_pass"
                      data-name="{{ $medico->apellidos . ' ' . $medico->nombres }}"
                      data-id="{{ $medico->idUsuario }}">Restablecer contraseña</a>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @include('medico.modals')
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
    $("#modal_pass").on('show.bs.modal', (e) => {
      $('#name_res_pass').html(e.relatedTarget.dataset.name);
      $('#id_res_pass').val(e.relatedTarget.dataset.id);
    });
    async function resetPass() {
      const res = await $.ajax({
        url: '/admin/password/reset',
        type: 'PUT',
        data: {
          idUsuario: $('#id_res_pass').val(),
          _token: $('input[name="_token"]').val()
        },
        dataType: 'json'
      });
      if (res.status === 'success') {
        mensajeToast('Contraseña restablecida', res.message, 'success', 2000)
      } else {
        mensajeToast('Ups! Ocurrió un error', res.message, 'danger', 2000)
      }
      $('#name_res_pass').html('')
      $('#id_res_pass').val('');
    }

    $("#modal_eliminar_medico").on('show.bs.modal', (e) => {
      const id = e.relatedTarget.dataset.id;
      const nombre = e.relatedTarget.dataset.name;
      $("#name_medico").html(nombre);
      $("#idMedico_eliminar").val(id);
    })

    async function eliminarMedico() {
      const id = $("#idMedico_eliminar").val();
      const res = await $.ajax({
        url: '/medico/baja/status',
        type: 'PUT',
        data: {
          idMedico: id,
          _token: $('input[name="_token"]').val()
        },
        dataType: 'json'
      });
      console.log(res)
      if (res.status == 'success') {
        mensajeToast('[Operación exitosa MÉDICO]', 'Se dió de baja al médico seleccionado', 'success', 1900);
        setTimeout(() => {
          location.reload();
        }, 2000);
      } else {
        mensajeToast('[Operación fallida MÉDICO]', 'No se pudo dar de baja', 'danger', 2000);
      }
    }
  </script>
@stop
