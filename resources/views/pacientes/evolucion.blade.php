@extends('adminlte::page')
@section('title', 'Inicio')
@section('content_header')
    <h1>Etapas </h1>
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      @foreach ($etapas as $etapa)
      <div class="col-12 col-sm-6 col-md-3">
        @php
          $url = $etapa->idTratamiento ? '/report/'.$idPaciente.'/show' : '#';
          $classA = $etapa->idTratamiento ? '' : 'non-active'
        @endphp
        <a href="{{$url}}" target="_blank" class="text-dark {{$classA}}">
          <div class="info-box mb-3 shadow">
            <span class="info-box-icon elevation-1 text-white" style="background-color:{{ $utils[$etapa->idEtapa][0] }};"><i class="fas {{ $utils[$etapa->idEtapa][1] }}"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">{{$etapa->detalle}}</span>
                <span class="info-box-number">
                  Inicio: 
                  @if ($etapa->fechaInicio)
                  {{date('d-m-Y', strtotime($etapa->fechaInicio))}}
                  @else
                    {{'Sin definir'}}
                  @endif
                </span>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>
@stop


@section('css')
<style>
  .non-active{
    pointer-events: none;
    cursor: not-allowed;
  }
</style>
@stop

@section('js')
@stop
