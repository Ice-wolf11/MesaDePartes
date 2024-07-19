@extends('layouts.template')
@section('title','Mis tramites pendientes')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')
@include('layouts.partials.alert')
    <div class="container-fluid px-4"> 
        <h1 class="mt-4 text-center">Tramites Pendientes</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item" active>Tramites pendientes</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Derivaciones pendientes
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>Nombre Remitente</th>
                            <th>Nombre del Destinatario</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($derivaciones as $derivacion)
                           <tr>
                            <td>{{$derivacion->tramite->persona->nombre}}</td>
                            <td>{{$derivacion->trabajador->nombre.' '.$derivacion->trabajador->apellido}}</td>
                            @if ($derivacion->tramite->estado->id == '1')
                                <td><p  class="badge text-bg-primary">{{$derivacion->tramite->estado->descripcion}}</p></td>
                            @endif
                            @if ($derivacion->tramite->estado->id == '2')
                                <td><p  class="badge text-bg-warning">{{$derivacion->tramite->estado->descripcion}}</p></td>
                            @endif
                            @if ($derivacion->tramite->estado->id == '3')
                                <td><p  class="badge text-bg-success">{{$derivacion->tramite->estado->descripcion}}</p></td>
                            @endif
                            @if ($derivacion->tramite->estado->id == '4')
                                <td><p  class="badge text-bg-danger">{{$derivacion->tramite->estado->descripcion}}</p></td>
                            @endif
                            <td>{{$derivacion->created_at}}</td>
                            <td>
                                <div class="d-grid gap-2 d-md-block">
                                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#verModal-{{$derivacion->id}}" >Ver</button> 
                                    @can('crear-revision')
                                    <form action="{{ route('revisiones.create', ['tramite' => $derivacion->tramite->id]) }}" method="GET" class="d-inline">@csrf<button class="btn btn-warning" type="submit">Revisar</button></form>
                                    @endcan 
                                    @can('eliminar-derivacion')
                                    @if ($derivacion->tramite->estado->id == '2')
                                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$derivacion->id}}"  disabled>Eliminar</button>
                                    @else
                                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$derivacion->id}}"  >Eliminar</button>
                                    @endif
                                    @endcan
                                    
                                </div>
                            </td>
                           </tr>

                            <!-- Modal ver tramite -->
                            <div class="modal fade" id="verModal-{{$derivacion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            
                                            <div class="row g-3">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Remitente</h1>
                                                <div class="col-md-6">
                                                    <label for="nombre" class="form-label">Nombre del Remitente:</label>
                                                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $derivacion->tramite->persona->nombre }}" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Correo Electronico:</label>
                                                    <input type="text" name="email" id="email" class="form-control" value="{{ $derivacion->tramite->persona->email }}" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="dni_ruc" class="form-label">N° DNI/RUC:</label>
                                                    <input type="text" name="dni_ruc" id="dni_ruc" class="form-control" value="{{ $derivacion->tramite->persona->numero_documento }}" disabled>  
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="{{ route('derivaciones.ver-pdf', $derivacion->id) }}" width="100%" height="350px"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--modal para eliminar derivacion-->
                             <!-- Modal eliminar -->
                             <div class="modal fade" id="confirmModal-{{$derivacion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                    ¿Esta seguro de esta acción?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{route('derivaciones.destroy',['derivacione'=>$derivacion->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                    </form>
                                    
                                    </div>
                                </div>
                                </div>
                            </div>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush
