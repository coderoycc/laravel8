@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')

  <h1>INICIO</h1>
@stop


@section('content')

  <div class="row">
    {{-- @foreach ($users as $user)
      <a href="#">{{ $user->nombres }}</a>
    @endforeach --}}
  </div>
@stop


@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script> console.log('Hi!'); </script>
@stop