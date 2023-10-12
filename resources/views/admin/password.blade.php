@extends('adminlte::page')
@section('title', 'Cuenta')
@section('content_header')
    <h1>Cambiar de contraseña</h1>
@stop

@section('content')
    {{-- {{print_r($variables)}} --}}
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-6">
              <div class="card card-widget widget-user shadow-lg">
                  <div class="widget-user-header bg-info">
                      <h3 class="widget-user-username">{{$user->nombres.' '.$user->apellidos}}</h3>
                      <h5 class="widget-user-desc">{{$user->rol}}</h5>
                  </div>
                  <div class="widget-user-image">
                      <img class="img-circle elevation-2" src="/vendor/images/user.png" alt="User Avatar">
                  </div>
                  <div class="card-footer">
                      <div class="row">
                          <div class="col-sm-4 border-right">
                              <div class="description-block">
                                  <h5 class="description-header">CORREO E.</h5>
                                  <span>{{$user->email}}</span>
                              </div>
                          </div>
                          <div class="col-sm-4 border-right">
                              <div class="description-block">
                                  <h5 class="description-header">CELULAR</h5>
                                  <span class="description-text">{{$user->celular}}</span>
                              </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="description-block">
                                  <h5 class="description-header">C.I.</h5>
                                  <span class="description-text">{{$user->ci}}</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card shadow-lg">
                <div class="card-body m-3">
                  <form id="form_pass">
                    @csrf
                      <div class="form-group">
                        <label for="">Su contraseña anterior:</label>
                        <input type="password" name="anterior" class="form-control" value=""
                           id="anterior" />
                        <span class="fas fa-fw fa-eye password-icon show-password" data-br="anterior"></span>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label for="departamento">Nueva contraseña:</label>
                        <input type="password" name="nuevo" class="form-control" value=""
                            id="nuevo" />
                        <span class="fas fa-fw fa-eye password-icon show-password" data-br="nuevo"></span>
                        <small id="passNew" class="form-text text-danger d-none">La contraseña debe ser como minimo de 6 caracteres</small>
                      </div>
                      <div class="form-group">
                        <label for="departamento">Repita su nueva contraseña:</label>
                        <input type="password" name="nuevo2" class="form-control" value=""
                            id="nuevo2"/>
                        <small id="passHelp" class="form-text text-danger d-none">Las contraseñas deben coincidir</small>
                      </div>
                      <br>
                      <button type="submit" class="btn btn-info float-right">CAMBIAR</button>
                  </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>
@stop


@section('css')
<link rel="stylesheet" href="/vendor/sweetalert2/sweetalert2.min.css">
<style>
  .password-icon {
    float: right;
    position: relative;
    margin: -25px 10px 0 0;
    cursor: pointer;
  }
</style>
@stop

@section('js')
<script src="/vendor/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener("load", function() {

      $(".show-password").click((e) => {
        const current = $(`#${e.target.dataset.br}`); 
        if(current.attr('type') == 'text'){
          current.attr('type', 'password');
          e.target.classList.remove('fa-eye-slash');
        }else{
          current.attr('type', 'text');
          e.target.classList.toggle("fa-eye-slash");
        }
      })
    });
    $("#nuevo").on('input', ()=>{
      if($("#nuevo2").val().length > 3){
        if($("#nuevo").val() != $("#nuevo2").val()){
          $("#passHelp").removeClass('d-none');
        }else{
          $("#passHelp").addClass('d-none');
        }
      }
      if($("#nuevo").val().length >= 6){
        $("#passNew").addClass('d-none');
      }else{
        $('#passNew').removeClass('d-none')
      }
    });
    $("#nuevo2").on('input', ()=>{
      if($("#nuevo").val() != $("#nuevo2").val()){
        $("#passHelp").removeClass('d-none');
      }else{
        $("#passHelp").addClass('d-none');
      }
    });

    

    $("#form_pass").submit(async (e) => {
      e.preventDefault();
      const data = $('#form_pass').serialize();
      const res = await $.ajax({
        url: '/admin/password/change',
        data,
        type: 'PUT',
        dataType: 'json'
      });
      if(res.status === 'success'){
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: res.message,
          showConfirmButton: false,
          timer: 1500
        })
        setTimeout(() => {
          window.location.href = '/home';
        }, 1800);
      }else{
        Swal.fire({
          icon: 'error',
          title: 'Ups...',
          text: res.message,
        })
      }
    })
</script>
@stop
