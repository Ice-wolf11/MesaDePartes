<div class="search-bar">
    <form id="form-busqueda">
        <div class="form-group">
            <label for="expediente">Nº Expediente:</label>
            <input type="text" id="expediente" name="expediente">
        </div>
        <div class="form-group">
            <label for="codigoSeguridad">Cod. Seguridad:</label>
            <input type="text" id="codigoSeguridad" name="codigoSeguridad">
        </div>
        <button type="submit" class="btn1 btn-success">Buscar</button>
        <button type="reset" class="btn1 btn-success2">Limpiar...</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    // Actualizar la vista con los datos obtenidos
                    var tramite = response.data;
                    $('.info-value.fechaHora').text(tramite.created_at);
                    $('.info-value.numeroExpediente').text(tramite.id);
                    $('.info-value.nombres').text(tramite.persona.nombre);
                    $('.info-value.estado').text(tramite.estado.descripcion);
                    $('.info-value.tipoDocumento').text(tramite.tipo_tramite);
                    $('.info-value.asunto').text(tramite.asunto);
                    $('.info-value.numeroDocumento').text(tramite.persona.numero_documento);
                    $('.info-value.folios').text(tramite.folios);
                } else {
                    alert(response.message);
                }
            }
        });
    });
});
</script>
