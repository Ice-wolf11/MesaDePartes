
    <div class="form-container">
        <div id="documentForm">
            <div class="form-group">
                <label for="tipoDocumento">Tipo de Documento</label>
                <select id="tipoDocumento" name="tipoDocumento">
                    <option value="">Seleccione</option>
                    <option value="solicitud">Solicitud</option>
                    <option value="carta">Carta</option>
                    <option value="oficio">Oficio</option>
                    <option value="otros">Otros</option>
                </select>
                @error('tipoDocumento')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group" id="otroTipoDocumentoGroup" style="display: none;">
                <label for="otroTipoDocumento">Especifique el Tipo de Documento</label>
                <input type="text" id="otroTipoDocumento" name="otroTipoDocumento" value="{{old('otroTipoDocumento')}}" >
                @error('otroTipoDocumento')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="cantidadFolios">Cantidad de Folios</label>
                <input type="number" id="cantidadFolios" name="cantidadFolios" value="{{old('cantidadFolios')}}">
                @error('cantidadFolios')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="asunto">Asunto</label>
                <textarea id="asunto" name="asunto" rows="5" value="{{old('asunto')}}"></textarea>
                @error('asunto')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="adjuntarArchivo">Adjuntar Archivo</label>
                <input type="file" id="adjuntarArchivo" name="adjuntarArchivo">
                @error('adjuntarArchivo')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
        
    </div>

