@extends('template')
@section('title','tramites')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="container-fluid px-4"> 
        <h1 class="mt-4 text-center">Derivar Tramites</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('tramites.index')}}">Listar Tramites</a></li>
            <li class="breadcrumb-item" active>DerivarTramite</li>
        </ol>
        <div class="container w-100 border border-3 corder-primary rounded p-4 mt-3">
            <form action="{{route('tramites.update',['area'=>$area])}}" method="post">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre',$area->nombre)}}">
                        @error('nombre')
                            <small class="text-danger">{{'*'.$message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary mt-4">Guardar</button>
                    <button type="reset" class="btn btn-secondary mt-4">Reiniciar</button>
                </div>
            </form>
        </div>
    </div>
    

    


@endsection