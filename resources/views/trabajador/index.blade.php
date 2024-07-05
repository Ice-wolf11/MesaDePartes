@extends('template')
@section('title','Usuarios')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')
@include('layouts.partials.alert')
    <div class="container-fluid px-4"> 
        <h1 class="mt-4 text-center">Usuarios</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item" active>Usuarios</li>
        </ol>
        <div class="mb-4">
            <a href="{{route('trabajadores.create')}}">
                <button type="button" class="btn btn-primary">Añadir nuevo registro</button>
            </a>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Usuarios
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>nombre</th>
                            <th>apellido</th>
                            <th>area</th>
                            <th>rol</th>
                            <th>acciones</th>
                             
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($trabajadores as $trabajador)
                        <tr>
                            
                            <td>{{$trabajador->nombre}}</td>
                            <td>{{$trabajador->apellido}}</td>
                            <td>{{$trabajador->area->nombre}}</td>
                            <td></td>
                            <td><div class="d-grid gap-2 d-md-block">
                                <form action="{{route('trabajadores.edit',['trabajadore' => $trabajador])}}" class="d-inline" method="GET">
                                @csrf
                                    <button class="btn btn-success" type="submit">Editar</button>
                                </form>
                                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$trabajador->id}}">Eliminar</button>   
                                </div>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="confirmModal-{{$trabajador->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <form action="{{route('trabajadores.destroy',['trabajadore'=>$trabajador->id])}}" method="POST">
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