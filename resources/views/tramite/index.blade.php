@extends('template')
@section('title','tramites')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush
@section('content')
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
                            <th>id</th>
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
                            <td>{{$tramite->id}}</td>
                            <td>{{$tramite->persona->nombre}}</td>
                            <td>{{$tramite->tipo_tramite}}</td>
                            <td><p  class="badge text-bg-primary">{{$tramite->estado->descripcion}}</p></td>
                            <td>{{$tramite->created_at}}</td>
                            <td><a href="{{ route('tramites.ver-pdf', $tramite->id) }}">Abrir</a></td>
                            <td><div class="d-grid gap-2 d-md-block">
                                <form action="{{route('derivaciones.create')}}" class="d-inline">@csrf<button class="btn btn-success" type="submit">Derivar</button></form>
                                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$tramite->id}}">Eliminar</button>   
                                    
                                </div>
                            </td>
                           </tr>
                            <!-- Modal -->
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