@extends('layouts.template')
@section('title', 'Derivar Tramites')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Derivar Tramites</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tramites.index') }}">Listar Tramites</a></li>
        <li class="breadcrumb-item active">Derivar Tramite</li>
    </ol>
    
    <form action="{{ route('derivaciones.store')}}" method="POST">
        @csrf

        <!-- Datos del remitente -->
        <input type="hidden" id="tramite_id" name="tramite_id" value="{{ $tramite->id }}">
        <div class="container w-100 border border-3 corder-primary rounded p-4 mt-3">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre del Remitente:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $tramite->persona->nombre }}" disabled>
                    
                </div>
                <div class="col-md-6">
                    <label for="asunto" class="form-label">Asunto:</label>
                    <input type="text" name="asunto" id="asunto" class="form-control" value="{{ $tramite->asunto }}" disabled>
                    
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo Electronico:</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ $tramite->persona->email }}" disabled>
                    
                </div>
                <div class="col-md-6">
                    <label for="folios" class="form-label">Folios:</label>
                    <input type="text" name="folios" id="folios" class="form-control" value="{{ $tramite->folios }}" disabled>
                    
                </div>
                <div class="col-md-6">
                    <label for="dni_ruc" class="form-label">N° DNI/RUC:</label>
                    <input type="text" name="dni_ruc" id="dni_ruc" class="form-control" value="{{ $tramite->persona->numero_documento }}" disabled>
                    
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#verModal-{{$tramite->id}}" >Ver Documento</button>
                </div>
            </div>
        </div>

        <!-- Selección de área y trabajador -->
        <div class="container w-100 border border-3 corder-primary rounded p-4 mt-3">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="area" class="form-label">Area:</label>
                    <select id="area" name="area" class="form-select" aria-label="Default select example">
                        <option selected>Seleccione...</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                        @endforeach
                    </select>
                    @error('area')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="trabajador" class="form-label">Trabajador:</label>
                    <select id="trabajador" name="trabajador" class="form-select" aria-label="Default select example">
                        <option selected>Seleccione...</option>
                    </select>
                    @error('trabajador')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary mt-4">Enviar</button>
        </div>
        <!-- Modal ver tramite -->
        <div class="modal fade" id="verModal-{{$tramite->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <H1>Documento</H1>
                    </div>
                    <div class="modal-body">
                        <iframe src="{{ route('tramites.ver-pdf', $tramite->id) }}" width="100%" height="500px"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>  
    </form>
</div>

@push('js')
<script>
    document.getElementById('area').addEventListener('change', function () {
        var areaId = this.value;

        // Limpia el select de trabajador
        var trabajadorSelect = document.getElementById('trabajador');
        trabajadorSelect.innerHTML = '<option selected>Seleccione...</option>';

        if (areaId) {
            fetch('/areas/' + areaId + '/trabajadores')
                .then(response => response.json())
                .then(data => {
                    data.forEach(trabajador => {
                        var option = document.createElement('option');
                        var nombre = trabajador.nombre+" "+trabajador.apellido;
                        option.value = trabajador.id;
                        option.text = nombre;
                        trabajadorSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>
@endpush

@endsection
