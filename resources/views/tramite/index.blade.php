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
                            <th>Folios</th>
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
                            <td>{{$tramite->folios}}</td>
                            <td>{{$tramite->created_at}}</td>
                            <td><a href="{{$tramite->ruta_archivo}}">Abrir</a></td>
                            <td><div class="d-grid gap-2 d-md-block">
                                <form action="{{route('tramite.derivar')}}"><button class="btn btn-success" type="button">Derivar</button></form>
                                <form action=""><button class="btn btn-danger" type="button">Eliminar</button></form>   
                                    
                                </div>
                            </td>
                           </tr>
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