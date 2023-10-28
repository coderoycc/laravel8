@extends('adminlte::page')
@section('title', 'Reportes')
@section('content_header')
  <div class="d-flex justify-content-between">
    <h1><i class="fas fa-chart-pie"></i> Reporte pacientes con leucemia</h1>
    <a href="{{route('reports.leucemia.pdf')}}" target="_blank" class="btn btn-primary shadow"><i class="fas fa-file-pdf"></i> Generar PDF</a>
  </div>
@stop

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <!-- DONUT CHART -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Tipos de leucemia</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            <table class="table table-striped table-responsive">
              <thead>
                <tr align="center">
                  <th>CÓDIGO</th>
                  <th>DESCRIPCIÓN</th>
                  <th>VARONES</th>
                  <th>MUJERES</th>
                  <th>TOTAL</th>
                </tr>
              </thead>
              <tbody>
                @php $total = 0; @endphp
                @foreach ($valores as $key => $valor)
                  <tr>
                    <td>{{$key}}</td>
                    <td>{{$valor['descripcion']}}</td>
                    <td align="center">{{$valor['M']}}</td>
                    <td align="center">{{$valor['F']}}</td>
                    <td align="center">{{$valor['total']}}</td>
                  </tr>
                  @php $total += $valor['total'] @endphp
                @endforeach
              </tbody>
              <tfoot>
                <tr class="font-weight-bold table-active">
                  <td colspan="4" align="right">TOTAL:  </td>
                  <td align="center">{{$total}}</td>
                </tr>
              </tfoot>
            </table>
          </div>
          
        </div>
      </div>
      <div class="col-md-6">
        <!-- BAR CHART -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Pacientes con Leucemia registrados (Enero - Junio)</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>

        <!-- BAR CHART -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Pacientes con Leucemia registrados (Julio - Diciembre)</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </section>
@stop

@section('js')
  <script>
    var colors = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#ea546c','#0e7b90','#a68102', '#47da2c', '#528d84', '#005d00', '#765e8c', '#ffbcfe', '#00ffe8', ' #ffaa1d', '#874e44', '#c94000', '#cf57ff']
    var datarea = @json($valores);
    let labels = Object.keys(datarea);
    let data = [];
    labels.forEach(key => {
      data.push(datarea[key]['total'])
    });
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData = {
      labels: labels,
      datasets: [{
        data: data,
        backgroundColor: colors.slice(0,labels.lenght),
      }]
    }
    var donutOptions = {
      maintainAspectRatio: false,
      responsive: true,
    }
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    var meses = @json($meses);
    console.log(meses)
    let dataMeses = {f:[0,0,0,0,0,0,0,0,0,0,0,0], m:[0,0,0,0,0,0,0,0,0,0,0,0]};
    for(const key of Object.keys(meses)){
      console.log(key)
      dataMeses['f'][key-1] = meses[key]['F'];
      dataMeses['m'][key-1] = meses[key]['M'];
    }
    var areaChartDataEJ = {
      labels  : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
      datasets: [
        {
          label               : 'VARONES',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : dataMeses['m'].slice(0,6)
        },
        {
          label               : 'MUJERES',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : dataMeses['f'].slice(0,6)
        },
      ]
    }
    var areaChartDataJD = {
      labels  : ['Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      datasets: [
        {
          label               : 'VARONES',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : dataMeses['m'].slice(6,12)
        },
        {
          label               : 'MUJERES',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : dataMeses['f'].slice(6,12)
        },
      ]
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartDataEJ)
    var temp0 = areaChartDataEJ.datasets[0]
    var temp1 = areaChartDataEJ.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0
    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      options: {
        scales: {
          y: {
            beginAtZero: true,
          }
        },
      },
    }
    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })


    var barChartCanvas = $('#barChart2').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartDataJD)
    var temp0 = areaChartDataJD.datasets[0]
    var temp1 = areaChartDataJD.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      options: {
        scales: {
          y: {
            beginAtZero: true,
          }
        },
      },

    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
  </script>
@stop
