@extends('layouts.template')
@section('title','tramites')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')
@include('layouts.partials.alert')
    <div class="container-fluid px-4"> 
        <h1 class="mt-4 text-center">Areas</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item" active>Areas</li>
        </ol>
        @can('editar-areas')
        <div class="mb-4">
            <a href="{{route('areas.create')}}">
                <button type="button" class="btn btn-primary">Añadir nuevo registro</button>
            </a>
        </div>
        @endcan
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Areas
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Area</th>
                            <th>acciones</th> 
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($areas as $area)
                           <tr>
                            <td>{{$area->id}}</td>
                            <td>{{$area->nombre}}</td>
                            <td><div class="d-grid gap-2 d-md-block">
                                @can('editar-areas')
                                <form action="{{route('areas.edit',['area'=>$area])}}" class="d-inline">@csrf<button class="btn btn-success" type="submit">Editar</button></form>
                                @endcan
                                @can('eliminar-areas')
                                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$area->id}}">Eliminar</button>
                                @endcan   
                                </div>
                            </td>
                           </tr>
                           <!-- Modal -->
                            <div class="modal fade" id="confirmModal-{{$area->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <form action="{{route('areas.destroy',['area'=>$area->id])}}" method="POST">
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