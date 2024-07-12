@extends('layouts.template')
@section('title', 'Trámites Revisados')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @include('layouts.partials.alert')

    <div class="container-fluid px-4"> 
        <h1 class="mt-4 text-center">Trámites Revisados</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Trámites Revisados</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Revisados
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre Remitente</th>
                            <th>Nombre del Evaluador</th>
                            <th>Resultado</th>
                            <th>Fecha Modificación</th>
                            <th>Respuesta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($revisiones as $revision)
                            <tr>
                                <td>{{ $revision->tramite->persona->nombre }}</td>
                                <td>{{ $revision->trabajador->nombre.' '.$revision->trabajador->apellido }}</td>
                                @if ($revision->estado_revision == 'Aceptado')
                                    <td><p class="badge text-bg-success">{{ $revision->estado_revision }}</p></td>
                                @elseif ($revision->estado_revision == 'Rechazado')
                                    <td><p class="badge text-bg-danger">{{ $revision->estado_revision }}</p></td>
                                @else
                                    <td>{{ $revision->estado_revision }}</td>
                                @endif
                                <td>{{ $revision->created_at }}</td>
                                <td>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#revisionModal-{{ $revision->id }}">Ver respuesta</button>
                                </td>
                                <td>
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#verModal-{{ $revision->id }}">Ver</button>
                                        <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $revision->id }}">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($revisiones as $revision)
        <!-- Modal ver tramite -->
        <div class="modal fade" id="verModal-{{ $revision->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Remitente</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre del Remitente:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $revision->tramite->persona->nombre }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Correo Electrónico:</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ $revision->tramite->persona->email }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="dni_ruc" class="form-label">N° DNI/RUC:</label>
                                <input type="text" name="dni_ruc" id="dni_ruc" class="form-control" value="{{ $revision->tramite->persona->numero_documento }}" disabled>
                            </div>
                        </div>
                        <iframe src="{{ route('tramites.ver-pdf', $revision->tramite->id) }}" width="100%" height="350px"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal ver respuesta -->
        <div class="modal fade" id="revisionModal-{{ $revision->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Respuesta</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción de la respuesta:</label>
                            <textarea class="form-control" id="descripcion" rows="3" disabled>{{ $revision->descripcion}}</textarea>
                        </div>
                        <iframe src="{{ route('revisiones.ver-pdf', $revision->id) }}" width="100%" height="350px"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal eliminar -->
        <div class="modal fade" id="confirmModal-{{ $revision->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro de esta acción?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('revisiones.destroy', ['revisione' => $revision->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Confirmar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush
