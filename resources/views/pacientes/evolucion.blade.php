@extends('adminlte::page')
@section('title', 'Inicio')
@section('content_header')
    <h1>Etapas </h1>
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">

        <a href="/home" class="text-dark">
          <div class="info-box shadow">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Etapa 1</span>
              <span class="info-box-number">
                  10<small>%</small>
              </span>
            </div>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/home" class="text-dark">
          <div class="info-box mb-3 shadow">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Etapa 2</span>
                <span class="info-box-number">
                    10<small>%</small>
                </span>
            </div>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/home" class="text-dark">
          <div class="info-box mb-3 shadow">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Etapa 3</span>
                  <span class="info-box-number">
                      10<small>%</small>
                  </span>
              </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>
@stop


@section('css')
@stop

@section('js')
@stop
