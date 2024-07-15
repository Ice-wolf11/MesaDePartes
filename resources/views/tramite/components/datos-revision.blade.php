<!-- resources/views/datos/revision.blade.php -->

<div class="seguimiento-expediente">
    <h2>Seguimiento del Expediente</h2>
    <table class="table-seguimiento">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha Hora</th>
                <th>Descripción</th>
                <th>Adjunto</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody id="tbody-seguimiento">
            <!-- Las filas serán generadas dinámicamente con JavaScript -->
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="revisionModal" tabindex="-1" role="dialog" aria-labelledby="revisionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="revisionModalLabel">Detalle de la Revisión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea id="descripcion" class="form-control" rows="5" readonly></textarea>
        <br>
        <iframe id="pdfFrame" src="" width="100%" height="400px"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

