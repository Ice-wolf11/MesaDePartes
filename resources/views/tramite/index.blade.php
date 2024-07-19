@extends('layouts.template')
@section('title','tramites')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')
@include('layouts.partials.alert')
    <div class="container-fluid px-4"> 
        <h1 class="mt-4 text-center">Tramites</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item" active>Tramites</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Tramites
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>Nombre Remitente</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Documento</th>
                            <th>Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($tramites as $tramite)
                           <tr>
                            
                            <td>{{$tramite->persona->nombre}}</td>
                            <td>{{$tramite->tipo_tramite}}</td>
                            @if ($tramite->estado->id == '1')
                                <td><p  class="badge text-bg-primary">{{$tramite->estado->descripcion}}</p></td>
                            @endif
                            @if ($tramite->estado->id == '2')
                                <td><p  class="badge text-bg-warning">{{$tramite->estado->descripcion}}</p></td>
                            @endif
                            @if ($tramite->estado->id == '3')
                                <td><p  class="badge text-bg-success">{{$tramite->estado->descripcion}}</p></td>
                            @endif
                            @if ($tramite->estado->id == '4')
                                <td><p  class="badge text-bg-danger">{{$tramite->estado->descripcion}}</p></td>
                            @endif
                            <td>{{$tramite->created_at}}</td>
                            <td><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#verModal-{{$tramite->id}}" >Ver</button></td>
                            <td><div class="d-grid gap-2 d-md-block">
                                <!--<form action="{{ route('derivaciones.create', ['tramite' => $tramite->id]) }}" method="GET" class="d-inline">@csrf<button class="btn btn-success" type="submit">Derivar</button></form> -->
                                @can('crear-revision')
                                <form action="{{ route('revisiones.create', ['tramite' => $tramite->id]) }}" method="GET" class="d-inline">@csrf<button class="btn btn-warning" type="submit">Revisar</button></form>
                                @endcan
                                @can('eliminar-tramites')
                                @if ($tramite->estado->id == '2')
                                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$tramite->id}}" disabled>Eliminar</button>
                                @else
                                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$tramite->id}}">Eliminar</button>
                                @endif
                                @endcan
                                
                                 
                                    
                                </div>
                            </td>
                           </tr>
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

                            <!-- Modal eliminar -->
                            <div class="modal fade" id="confirmModal-{{$tramite->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <form action="{{route('tramites.destroy',['tramite'=>$tramite->id])}}" method="POST">
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