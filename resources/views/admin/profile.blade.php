@extends('adminlte::page')
@section('title', 'Cuenta')
@section('content_header')
  <h1>Mi Perfil</h1>
@stop

@section('content')
  {{-- {{print_r($variables)}} --}}
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card card-widget widget-user shadow-lg">
            <div class="widget-user-header bg-info">
              <h3 class="widget-user-username">{{ $user->nombres . ' ' . $user->apellidos }}</h3>
              <h5 class="widget-user-desc">{{ $user->rol }}</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle elevation-2" src="{{$user->getUrlImageProfile()}}" alt="User Avatar">
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">CORREO E.</h5>
                    <span>{{ $user->email }}</span>
                  </div>
                </div>
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">CELULAR</h5>
                    <span class="description-text">{{ $user->celular }}</span>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">C.I.</h5>
                    <span class="description-text">{{ $user->ci }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card shadow-lg">
            <div class="card-body m-3">
              <table class="table table-striped">
                <tbody>
                  @if ($user->rol == 'PACIENTE')
                  <tr>
                    <td>Código S.U.S.</td>
                    <td>{{ $user->codSus }}</td>
                  </tr>
                  @else
                    @if ($user->rol == 'MEDICO')
                    <tr>
                      <td>Especialidad</td>
                      <td>{{ $user->especialidad }}</td>
                    </tr>
                    <tr>
                      <td>Mat. profesional</td>
                      <td>{{ $user->matProfesional }}</td>
                    </tr>
                    @else
                    <tr>
                      <td>Administrador</td>
                      <td>{{ $user->rol }}</td>
                    </tr>
                    @endif
                  @endif
                  <tr>
                    <td>Fecha de registro</td>
                    <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                  </tr>
                </tbody>
              </table>
              <div class="d-flex justify-content-center mt-2">
                <button class="btn btn-info" id="btn_profile_image" data-uid="{{ $user->idUsuario }}"><i
                    class="fas fa-upload"></i> Subir foto de perfil</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop


@section('css')
@stop

@section('js')
  <script>
    $("#btn_profile_image").click(async (e) => {
      const id = e.currentTarget.dataset.uid;
      const {
        value: file
      } = await Swal.fire({
        title: 'Seleccione una imagen',
        text: "En formatos jpeg, png o webp",
        input: 'file',
        inputAttributes: {
          'accept': 'image/*',
          'aria-label': 'Upload your profile image'
        }
      })
      if (file) {
        const reader = new FileReader()
        reader.onload = (e) => {
          Swal.fire({
            title: 'Su foto de perfil será',
            imageUrl: e.target.result,
            imageAlt: 'Logo',
            showCancelButton: true,
            confirmButtonText: 'Ok, guardar'
          }).then((result) => {
            if (result.value) {
              console.log('confirmado')
              const formData = new FormData();
              formData.append('profile', file, file.name);
              formData.append('id', id);
              $.ajax({
                url: "/api/profile/image",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function(response) {
                  if (response.status == 'success') {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Imagen guardada',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    setTimeout(() => {
                      location.reload();
                    }, 2000);
                  }
                },
                error: function(error) {
                  console.error('Error al enviar la imagen', error);
                }
              });
            }
          })
        }
        reader.readAsDataURL(file)
      }
    })
  </script>
@stop
