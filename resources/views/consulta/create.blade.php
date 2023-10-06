@extends('adminlte::page')


@section('title', 'Crear médico')

@section('content_header')
<div class="d-flex justify-content-between">
  <h1>Nueva consulta para el paciente</h1>
  <button class="btn btn-secondary" onclick="history.back()">Volver</button>
</div>
@stop


@section('content')
{{-- {{print_r($historial)}} --}}
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
      <a href="{{route('report', ['idPaciente'=>$historial->idPaciente])}}" target="_blank" class="btn btn-info text-white">Ver Evolución</a>
    </div>
  </div>
</div>
<div class="card">
  <?php
  if($historial->paciente->tieneEvolucion == null){
    $tratamientoActual = (object) array('tieneMedicamentos' => 'NO', 'idTratamiento' => 0);
  }else{
    $tratamientoActual = $historial->paciente->tieneEvolucion->tratamientoActual();
  }
  ?>
  <div class="card-body">
    <nav class="w-100">
      <div class="nav nav-tabs" id="product-tab" role="tablist">
        <a class="nav-item nav-link active" id="reg-consulta-tab" data-toggle="tab" href="#reg-consulta" role="tab" aria-controls="reg-consulta" aria-selected="true">Registro de nueva consulta</a>
        @if ($tratamientoActual->tieneMedicamentos == 'NO')
        <a class="nav-item nav-link" id="reg-evolucion-tab" data-toggle="tab" href="#reg-evolucion" role="tab" aria-controls="reg-evolucion" aria-selected="false">Registro de Evolución</a>
        @else
        <a class="nav-item nav-link" id="reg-aplicacion-tab" data-toggle="tab" href="#reg-aplicacion" role="tab" aria-controls="reg-aplicacion" aria-selected="false">Aplicación de medicamentos</a>            
        @endif
      </div>
    </nav>
    <div class="tab-content p-3" id="nav-tabContent">
      <div class="tab-pane fade show active" id="reg-consulta" role="tabpanel" aria-labelledby="reg-consulta-tab">
        <form id="form_consulta">
          @csrf
          <input type="hidden" name="idHistorial" value="{{$historial->idHistorial}}">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Valoracion</label>
              <textarea name="valoracion" class="form-control no-resize" rows="2"></textarea>
            </div>
            <div class="form-group col-md-6">
              <label>Observaciones o recomendaciones</label>
              <textarea name="observacion" class="form-control no-resize" rows="2"></textarea>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="peso">Peso [kg]</label>
              <input class="form-control" step="0.01" name="peso" type="number" id="peso">
            </div>
            <div class="form-group col-md-3">
              <label for="talla">Talla [cm]</label>
              <input type="number" step="0.01" name="talla" id="talla" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label for="fechaProx">Fecha prox. consulta</label>
              <input type="date" class="form-control" name="fechaProxConsulta">
            </div>
          </div>
          <h4>Receta médica</h4>
          <div class="form-row">
            <div class="form-group col-md-6 autocomplete">
              <label for="busqueda">Medicamento</label>
              <input class="form-control" type="text" id="busqueda" placeholder="Escribe aquí" autocomplete="off">
              <ul id="sugerencias"></ul>
            </div>
            <div class="form-group col-md-6">
              <div class="callout callout-success" id="medicinas">
                <h4>Lista de medicamentos</h4>
              </div>
            </div>
          </div>
          <div class="form-row mt-2" id="botones">
            <div class="form-group col-md-12">
              <button type="submit" id="btn_submit" class="btn btn-primary float-right">Guardar consulta</button>
            </div>
          </div>
        </form>
      </div>
      @if ($tratamientoActual->tieneMedicamentos == 'NO')
      <div class="tab-pane fade" id="reg-evolucion" role="tabpanel" aria-labelledby="reg-evolucion-tab">
        <h3>Etapa de Evolución: {{$historial->paciente->tieneEvolucion ? $historial->paciente->tieneEvolucion->etapaActual->detalle : ''}}</h3>
        <form id="form_registro">
          @csrf
          <input type="hidden" name="idTratamiento" value="{{$tratamientoActual->idTratamiento}}">
          <div class="row">
            <div class="col-md-8">
              <h5>Medicamentos</h5>
              @foreach ([1,2,3,4,5,6] as $item)
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Medicamento {{$item}}</label>
                  <select class="form-control select2" style="width: 100%;padding-bottom:5px;" name="idMedicamento{{$item}}">
                    {!! $html !!}
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Dosis</label>
                  <input type="text" name="dosis{{$item}}" class="form-control">
                </div>
              </div>
              @endforeach
            </div>

            <div class="col-md-4" >
              <br><br>
              <h5>Fechas de inicio del tratamiento </h5>
              <?php
              $hoy = date('Y-m-d');
              $fechaNueva = date('Y-m-d', strtotime($hoy . ' + 20 days'));
              ?>
              <div class="form-group">
                <input type="date" class="form-control" value="{{$hoy}}" id="f_inicio" name="fechaInicio">
              </div>
              <div>
                <h5>Fecha Final de la etpa</h5>
                <input type="date" class="form-control" id="f_final" value="{{$fechaNueva}}" disabled>
              </div>
              <br><br>
              <button type="submit" class="btn btn-success">Terminar Registro</button>
            </div>
          </div>
        </form>
      </div>
      @else
      <div class="tab-pane fade" id="reg-aplicacion" role="tabpanel" aria-labelledby="reg-aplicacion-tab">
        <h4>Registra las próximas fechas: {{$historial->paciente->tieneEvolucion->etapaActual->detalle}}</h4>
        <div class="row justify-content-center align-items-center">
          <table class="table table-responsive">
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th>{{ $hoy = date('d-m-Y') }}</th>
                @for ($i = 1; $i < 6; $i++)
                  <th>{{date('d-m-Y', strtotime($hoy."+$i days"))}}</th>
                @endfor
              </tr>
            </thead>
            <tbody>
              @foreach ($tratamientoActual->contenido as $contenido)
                <tr>
                  <td>{{$contenido->medicamento->descripcion}}</td>
                  <td>{{$contenido->dosis}}</td>
                  <td><input type="checkbox" name="" id=""></td>
                  <td><input type="checkbox" name="" id=""></td>
                  <td><input type="checkbox" name="" id=""></td>
                  <td><input type="checkbox" name="" id=""></td>
                  <td><input type="checkbox" name="" id=""></td>
                  <td><input type="checkbox" name="" id=""></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <form>
        </form>
      </div>
      @endif
    </div>
  </div>
</div>
@stop


@section('css')
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
      /* top: 100%; */
      left: 0;
      width: 100%;
      border: 1px solid #ccc;
      background-color: #fff;
      list-style: none;
      margin: 0;
      padding: 0;
      z-index: 10;
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
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #444;
      line-height: 1rem;
    }
    .select2-container .select2-selection--single {
      height: auto !important;
    }
    thead {
      height: 110px;
    }
    .table thead th{
      vertical-align: middle !important;
    }
    th {
      text-align: center;
      font-size: 14px;
      font-weight: bold;
      transform: rotate(-90deg);
    }
    td{
      text-align: center;
    }
  </style>
@stop

@section('js')
  <script src="/custom/js/main.js"></script>
  <script>
    $('.select2').select2()
    var busquedaInput = document.getElementById('busqueda');
    var sugerenciasLista = document.getElementById('sugerencias');

    busquedaInput.addEventListener('input', async function() {
      var query = this.value;
      sugerenciasLista.innerHTML = '';
      if(query.length >= 3){
        const res = await $.ajax({
          url: `/api/medicamento/${query}`,
          type: 'GET',
          dataType: 'json',
        });
        if(res.status == 'success'){
          if(res.cant > 0){
            $("#sugerencias").html(res.html);
          }else{
            $("#sugerencias").html('<li align="center">No hay resultados</li>')
          }
          sugerenciasLista.style.display = 'block';
        }else{
          console.log(res)
        }
      } else {
        sugerenciasLista.style.display = 'none';
      }
    });

    sugerenciasLista.addEventListener('click', function(event) {
      if (event.target.tagName === 'LI') {
        const textMed = $(event.target).text();
        if(textMed != 'No hay resultados'){
          const idMedicamento = $(event.target).data('id');
          $("#medicinas").append(`<div class="row d-flex justify-content-between linea-baja mt-2">
              <label for="">${textMed}</label>
              <input type="hidden" name="idMedicamento[]" value="${idMedicamento}" />
              <input type="text" class="form-list" name="dosificacion[]" placeholder="Dosificacion">
            </div>`);
        }
        busquedaInput.value = '';
        sugerenciasLista.style.display = 'none';
      }
    });

    document.addEventListener('click', function(event) {
      if (event.target !== busquedaInput) {
        sugerenciasLista.style.display = 'none';
      }
    });

    $("#form_consulta").submit(async (e)=>{
      e.preventDefault();
      const formData = new FormData(e.target);
      let data = {};
      for (let [key, value] of formData.entries()) {
        if(!key.endsWith('[]')){
          data[key] = value;
        }
      }
      let idsMedicamento = [];
      $('input[name="idMedicamento[]"]').each(function() {
        idsMedicamento.push($(this).val());
      });
      let valoresDosis = [];
      $('input[name="dosificacion[]"]').each(function() {
        valoresDosis.push($(this).val());
      });
      data['idsMedicamento'] = JSON.stringify(idsMedicamento);
      data['valoresDosis'] = JSON.stringify(valoresDosis);
      // console.log(data);
      const res = await $.ajax({
        url: '/consulta/store',
        type: 'POST',
        dataType: 'json',
        data
      });
      if(res.status === 'success'){
        mensajeToast('Consulta registrada', 'La consulta y la receta se han registrado', 'success', 2800)
        if(res.idReceta > 0){
          $("#botones").append(`<div class="form-group col-md-12 mt-3 d-flex justify-content-center">
            <a href="/receta/${res.idReceta}" target="_blank" type="button" class="btn btn-secondary">Imprimir receta</a>
          </div>`);
        }
      }
      $("#btn_submit").prop('disabled', true);
      
    })

    $("#f_inicio").change(()=>{
      const fecha = $("#f_inicio").val();
      const fechaObj = new Date(fecha);
      fechaObj.setDate(fechaObj.getDate() + 20);
      const nuevaFecha = `${fechaObj.getFullYear()}-${(fechaObj.getMonth() + 1) > 9 ? '' : '0'}${fechaObj.getMonth()+1}-${fechaObj.getDate() > 9 ? '':'0'}${fechaObj.getDate()}`
      $('#f_final').val(nuevaFecha);
    })
    $("#form_registro").submit(async (e) => {
      e.preventDefault();
      const data = $("#form_registro").serialize()+'&fechaFinal'+$("#f_final").val()
      const res = await $.ajax({
        url: '/tratamiento/create',
        type: 'POST',
        data,
        dataType: 'json'
      });
      if(res.status === 'success'){
        //recargar la pagina
        location.reload();
      }else{
        mensajeToast('Ocurrio un error', 'No se puedo registrar los datos', 'danger', 2500);
        console.warn(res)
      }
    })
  </script>
@stop