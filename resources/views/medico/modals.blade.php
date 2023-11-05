<!-- Modal Restablecer contrasena -->
<div class="modal fade" id="modal_pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Está seguro de restablecer la contraseña del usuario?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Da clic en aceptar para restablecer la contrasena de <b id="name_res_pass"></b>
        <input type="hidden" name="idUsuario" id="id_res_pass">
        @csrf
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="resetPass()">Restablecer</button>
      </div>
    </div>
  </div>
</div>

{{-- Modal Eliminar Medico --}}
<div class="modal fade" id="modal_eliminar_medico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar médico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="idMedico" id="idMedico_eliminar">
        <h5 align="center">¿Está seguro de eliminar al médico?</h5>
        <h5>Medico: <b id="name_medico"></b></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger">Sí, eliminar</button>
      </div>
    </div>
  </div>
</div>
