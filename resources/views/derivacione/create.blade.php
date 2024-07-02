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
    </div>
    
    


@endsection