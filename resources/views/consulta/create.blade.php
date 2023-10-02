@extends('adminlte::page')


@section('title', 'Crear médico')

@section('content_header')
<div class="d-flex justify-content-between">
  <h1>Nueva consulta para el paciente</h1>
  <button class="btn btn-secondary" onclick="history.back()">Volver</button>
</div>
@stop


@section('content')
<div class="callout callout-info">
  <h5 class="font-weight-bold">Datos del paciente:</h5>
  <div class="row">
    <div class="col-md-4"><b>Nombre completo:</b> {{$historial->paciente->nombres.' '.$historial->paciente->apellidos}}</div>
    <div class="col-md-4"><b>Edad:</b> {{$historial->paciente->edad($historial->paciente->fechaNac)}}</div>
    <div class="col-md-4"><b>Tipo de cáncer:</b> {{$historial->tipoCancer}}</div>
    <div class="col-md-4"><b>Procedencia: </b> {{$historial->procedencia}}</div>
    <div class="col-md-4"><b>Servicio: </b> {{$historial->servicio}}</div>
    <div class="col-md-4"><b>Etapa del cáncer: </b> {{$historial->etapa}}</div>
  </div>
  <div class="row mt-3">
    <div class="col-12 d-flex justify-content-center">
      <button type="button" class="btn btn-info">Ver Evolución</button>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-body">
    {!! Form::open(['route'=>'consulta.store']) !!}
    <input type="hidden" name="idHistorial" value="{{$historial->idHistorial}}">
      <div class="form-row">
        <div class="form-group col-md-6">
          {!! Form::label('valoracion', 'Valoracion', []) !!}
          {!! Form::textarea('valoracion', '', ['class'=>'form-control no-resize', 'rows'=>2]) !!}
        </div>
        <div class="form-group col-md-6">
          {!! Form::label('observacion', 'Observaciones o recomendaciones', []) !!}
          {!! Form::textarea('observacion', '', ['class'=>'form-control no-resize', 'rows'=>2]) !!}
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-3">
          {!! Form::label('peso', 'Peso [kg.]', []) !!}
          {!! Form::number('peso', null, ['class'=>'form-control', 'step' => '0.01']) !!}
        </div>
        <div class="form-group col-md-3">
          {!! Form::label('talla', 'Talla [cm.]', []) !!}
          {!! Form::number('talla', null, ['class'=>'form-control', 'step' => '0.01']) !!}
        </div>
        <div class="form-group col-md-4">
          {!! Form::label('fechaProxConsulta', 'Fecha prox. consulta', []) !!}
          {!! Form::date('fechaProxConsulta', null, ['class'=>'form-control']) !!}
        </div>
      </div>
      <h4>Receta médica</h4>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="busqueda">Medicamento</label>
          <input class="form-control" type="text" id="busqueda" placeholder="Escribe aquí">
          <ul id="sugerencias"></ul>
        </div>
        <div class="form-group col-md-6">
          <div class="callout callout-success" id="medicinas">
            <h4>Lista de medicamentos</h4>
            <div class="row d-flex justify-content-between linea-baja mt-2">
              <label for="">Paracetamol 500mg</label>
              <input type="text" class="form-list" placeholder="Dosificacion">
            </div>
            <div class="row d-flex justify-content-between linea-baja mt-2">
              <label for="">Paracetamol 500mg</label>
              <input type="text" class="form-list" placeholder="Dosificacion">
            </div>
          </div>
        </div>
      </div>
      <div class="form-row mt-2">
        <div class="form-group col-md-12">
          {!! Form::submit('Guardar Datos', ['class' => 'btn btn-primary float-right']) !!}
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop


@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  <style>
    .no-resize {
      resize: none; 
    }
    .linea-baja{
      padding-bottom: 7px;
      border-bottom: 1px solid #b9b9b9; 
    }
    .form-list{
      width: 130px;
      height: calc(2.25rem + 2px);
      padding: .375rem .75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: .25rem;
    }
    .form-list:focus{
      border: 1px solid #80bdff;
    }
    .form-list:active{
      border: 1px solid #80bdff;
    }
    .autocomplete {
      position: relative;
    }

#sugerencias {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    border: 1px solid #ccc;
    background-color: #fff;
    list-style: none;
    margin: 0;
    padding: 0;
    display: none; /* Oculta la lista inicialmente */
}

#sugerencias li {
    padding: 10px;
    border-bottom: 1px solid #ccc;
    cursor: pointer;
}

#sugerencias li:hover {
    background-color: #f5f5f5;
}

  </style>
@stop

@section('js')
  <script src="/custom/js/main.js"></script>
  <script>
    var busquedaInput = document.getElementById('busqueda');
    var sugerenciasLista = document.getElementById('sugerencias');

    busquedaInput.addEventListener('input', function() {
        var query = this.value;

        // Realiza una solicitud AJAX al servidor para obtener las sugerencias
        // y actualiza la lista de sugerencias debajo del input.
        // Puedes implementar la lógica AJAX aquí para obtener las sugerencias.
        // Ejemplo de cómo agregar sugerencias ficticias a la lista:
        sugerenciasLista.innerHTML = ''; // Limpia la lista actual
        if (query.length > 0) {
            for (var i = 0; i < 5; i++) {
              var sugerencia = document.createElement('li');
              sugerencia.textContent = 'Sugerencia ' + i;
              sugerenciasLista.appendChild(sugerencia);
            }
            sugerenciasLista.style.display = 'block'; // Muestra la lista
        } else {
          sugerenciasLista.style.display = 'none'; // Oculta la lista si no hay entrada   
        }
    });
    sugerenciasLista.addEventListener('click', function(event) {
      if (event.target.tagName === 'LI') {
        busquedaInput.value = event.target.textContent;
        sugerenciasLista.style.display = 'none'; // Oculta la lista al hacer clic
      }
    });

    document.addEventListener('click', function(event) {
      if (event.target !== busquedaInput) {
        sugerenciasLista.style.display = 'none'; // Oculta la lista al hacer clic en otro lugar
      }
    });
</script>

@stop