<div class="form-container">
    <div id="documentForm">
        <div class="form-group">
            <label for="tipoDocumento">Tipo de Documento</label>
            <select id="tipoDocumento" name="tipoDocumento" required>
                <option value="">Seleccione</option>
                <option value="solicitud">Solicitud</option>
                <option value="carta">Carta</option>
                <option value="oficio">Oficio</option>
                <option value="otros">Otros</option>
            </select>
        </div>
        <div class="form-group" id="otroTipoDocumentoGroup" style="display: none;">
            <label for="otroTipoDocumento">Especifique el Tipo de Documento</label>
            <input type="text" id="otroTipoDocumento" name="otroTipoDocumento" required>
        </div>
        
        <div class="form-group">
            <label for="cantidadFolios">Cantidad de Folios</label>
            <input type="number" id="cantidadFolios" name="cantidadFolios" required>
        </div>
        <div class="form-group">
            <label for="asunto">Asunto</label>
            <textarea id="asunto" name="asunto" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="adjuntarArchivo">Adjuntar Archivo</label>
            <input type="file" id="adjuntarArchivo" name="adjuntarArchivo">
        </div>
        
    </div>
</div>

