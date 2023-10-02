const lenguaje = {
  processing: 'Procesando...',
  search: 'Buscar en la tabla',
  lengthMenu: "Mostrar _MENU_ registros",
  infoFiltered: "(filtrado de un total de _MAX_ registros)",
  info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
  infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
  paginate: {
    first: 'Primero',
    previous: 'Ant.',
    next: 'Sig.',
    last: 'Último'
  },
  emptyTable: 'No hay registros...',
  infoEmpty: 'No hay resultados',
  zeroRecords: 'No hay registros...',
}
function calcularEdad(){
  const fechaNac = $('#fechaNac').val();
  const today = new Date();
  const ageInMillis = today.getTime() - new Date(fechaNac).getTime();
  const ageYears = Math.floor(ageInMillis / (365.25 * 24 * 60 * 60 * 1000));
  const ageMonths = Math.floor((ageInMillis % (365.25 * 24 * 60 * 60 * 1000)) / (30.436875 * 24 * 60 * 60 * 1000));
  const ageDays = Math.floor((ageInMillis % (30.436875 * 24 * 60 * 60 * 1000)) / (24 * 60 * 60 * 1000));
  $("#edad").val(`${ageYears} años ${ageMonths} meses ${ageDays} días`); 
}

function mensajeToast(titulo, mensaje, fondo, tiempo){
  let icono = fondo == 'success' ? 'fa-check' : 'fa-exclamation-triangle';
  $(document).Toasts('create', {
    title: titulo,
    autohide: true,
    icon: 'fas '+icono,
    delay: tiempo,
    class:'bg-'+fondo,
    body: mensaje
  })
}