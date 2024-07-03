
<div class="form-container">
    <div class="form-group">
        <label for="tipoPersona">Tipo de Persona</label>
        <select id="tipoPersona" name="tipoPersona">
            <option value="">Seleccione</option>
            <option value="natural">Persona Natural</option>
            <option value="juridica">Persona Jurídica</option>
        </select>
        @error('tipoPersona')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="nombre">Nombres y Apellidos/Nombre de la Entidad</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
        @error('nombre')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="dniRuc">DNI/RUC</label>
        <input type="text" id="dniRuc" name="dniRuc" value="{{ old('dniRuc') }}">
        @error('dniRuc')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="telefono">Teléfono <span class="optional">(opcional)</span></label>
        <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}">
        @error('telefono')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    
</div>