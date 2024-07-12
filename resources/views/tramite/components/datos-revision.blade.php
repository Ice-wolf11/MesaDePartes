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

<script>
$(document).ready(function() {
    $('#form-busqueda').on('submit', function(e) {
        e.preventDefault();

        var expediente = $('#expediente').val();
        var codigoSeguridad = $('#codigoSeguridad').val();

        $.ajax({
            url: "{{ route('tramites.buscar') }}",
            method: 'GET',
            data: {
                expediente: expediente,
                codigoSeguridad: codigoSeguridad
            },
            success: function(response) {
                if (response.success) {
                    var tramite = response.data;

                    // Actualizar la vista con los datos del trámite
                    $('.info-value.fechaHora').text(tramite.created_at);
                    $('.info-value.numeroExpediente').text(tramite.id);
                    $('.info-value.nombres').text(tramite.persona.nombre);
                    $('.info-value.estado').text(tramite.estado.nombre);
                    $('.info-value.tipoDocumento').text(tramite.tipo_tramite);
                    $('.info-value.asunto').text(tramite.asunto);
                    $('.info-value.numeroDocumento').text(tramite.persona.numero_documento);
                    $('.info-value.folios').text(tramite.folios);

                    // Limpiar el tbody de la tabla de seguimiento
                    $('#tbody-seguimiento').empty();

                    // Iterar sobre las revisiones y agregarlas a la tabla
                    tramite.revisiones.forEach(function(revision, index) {
                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + revision.created_at + '</td>' +
                            '<td><a href="#" class="revision-descripcion" data-descripcion="' + revision.descripcion + '">Ver Descripción</a></td>' +
                            '<td>' + (revision.adjunto ? '<a href="#" class="revision-adjunto" data-adjunto="/storage/revisiones/' + revision.adjunto + '">Ver Adjunto</a>' : 'N/A') + '</td>' +
                            '<td>' + (revision.user ? revision.user.name : 'N/A') + '</td>' +
                            '</tr>';
                     
