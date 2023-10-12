@extends('adminlte::page')
@section('title', 'Inicio')
@section('content_header')
  <h1>Bandeja de Inicio</h1>
@stop

@section('content')
<section class="content">
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
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      @can('admin')
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$variables['cantidadMedicos']}}</h3>
            <p>Todos los médicos</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{route('medico.index')}}" class="small-box-footer">Ver <i class="fas fa-eye"></i> </a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{$variables['todosPacientes']}}</h3>
            <p>Todos los pacientes</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{route('paciente.index')}}" class="small-box-footer">Ver <i class="fas fa-eye"></i> </a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>+</h3>
            <p>Agregar nuevo paciente</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{route('paciente.create')}}" class="small-box-footer">Agregar nuevo <i class="fas fa-plus"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>{{$variables['solicitudesInternacion']}}</h3>
            <p>Ver solicitudes de internación</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{route('internacion.solicitud')}}" class="small-box-footer">Ver <i class="fas fa-eye"></i> </a>
        </div>
      </div>
      @endcan
      @can('medico')
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$variables['nuevos']}}</h3>
            <p>Pacientes nuevos</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{route('mispacientes.nuevos')}}" class="small-box-footer">Ver listado <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$variables['misPacientes']}}</h3>
            <p>Todos mis pacientes</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{route('mispacientes.index')}}" class="small-box-footer">Ver listado <i class="fas fa-eye"></i> </a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>#</h3>
            <p>Consultas programadas</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">Ver <i class="fas fa-eye"></i> </a>
        </div>
      </div>
      @endcan
    </div>
  </div>
</section>
@stop


@section('css')
@stop

@section('js')
@stop