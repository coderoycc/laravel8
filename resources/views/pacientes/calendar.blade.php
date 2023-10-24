@extends('adminlte::page')
@section('title', 'Calendario')
@section('content_header')
  <h1>Calendario de consultas</h1>
@stop

@section('content')
  <section class="content">
    <input type="hidden" value="{{$idHistorial}}" id="idHistorial">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-body p-0">
          <div id="calendar"></div>
        </div>
      </div>
    </div>
  </section>
@stop


@section('css')
<link rel="stylesheet" href="/vendor/fullcalendar/main.min.css">
@stop

@section('js')
<script src="/vendor/fullcalendar/moment.min.js"></script>
<script src="/vendor/fullcalendar/main.min.js"></script>
<script src="/vendor/fullcalendar/locales/es.js"></script>
  <script>
    $(document).ready(()=>{
      var idHistorial = $("#idHistorial").val();
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventClick: function(info) {
          var eventObj = info.event;

          if (eventObj.url) {
            alert(
              'Clicked ' + eventObj.title + '.\n' +
              'Will open ' + eventObj.url + ' in a new tab'
            );

            window.open(eventObj.url);

            info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
          } else {
            // alert('Clicked ' + eventObj.title);
          }
        },
        themeSystem: 'bootstrap',
        initialView: 'dayGridMonth',
        navLinks: true,
        events: function(info, successCallback, failureCallback){
          $.ajax({
            url: '/api/calendar/paciente?id='+idHistorial,
            method: 'GET',
            dataType: 'json',
            success: function(response){
              successCallback(response)
            },
            error: function(){
              failureCallback()
            }
          })
        }
      });
      calendar.render()
    })
  </script>
@stop
