@extends('layouts.template')
@section('title','tramites')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush
@section('content')

    <div class="container-fluid px-4"> 
        <h1 class="mt-4 text-center">Crear Usuario</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('trabajadores.index')}}">Usuarios</a></li>
            <li class="breadcrumb-item" active>Crear Usuario</li>
        </ol>

        <div class="container w-100 border border-3 corder-primary rounded p-4 mt-3">
            <form action="{{route('trabajadores.store')}}" method="POST">
                @csrf
                <div class="row g-3">
                    <h3>Datos del Trabajador</h3>
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombres:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre')}}">
                        @error('nombre')
                            <small class="text-danger">{{'*'.$message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellidos:</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" value="{{old('apellido')}}">
                        @error('apellido')
                            <small class="text-danger">{{'*'.$message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo Electronico:</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                        @error('email')
                            <small class="text-danger">{{'*'.$message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Contraseña:</label>
                        <input type="password" name="password" id="password" class="form-control" value="{{old('password')}}">
                        @error('password')
                            <small class="text-danger">{{'*'.$message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="area" class="form-label">Area:</label>
                        <select id="area" name="area" class="form-select" aria-label="Default select example">
                            <option selected>Seleccione...</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                            @endforeach
                        </select>
                        @error('area')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="">
                        @error('password_confirmation')
                            <small class="text-danger">{{'*'.$message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="rol" class="form-label">Rol:</label>
                        <select id="role" name="role" class="form-select" aria-label="Default select example">
                            <option selected disabled>Seleccione...</option>
                            @foreach ($roles as $item)
                            <option value="{{$item->name}}" @selected(old('role')==$item->name)>{{$item->name}}</option>
                            @endforeach
                            
                        </select>
                        @error('rol')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary mt-4">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>  
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush