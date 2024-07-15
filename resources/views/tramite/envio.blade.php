@extends('tramite.partials.principal')
@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')
@include('layouts.partials.alert')
    <form action="{{route('tramites.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="containerForm">
            <div class="form-section">
                <h2>Remitente</h2>
                @component('tramite.components.persona')@endcomponent
            </div>
            <div class="form-section">
                <h2>Documento</h2>
                @component('tramite.components.documento')@endcomponent
            </div>
        </div>
        <div class="submit-section">
            <button type="submit">Enviar</button>
        </div>
    </form>
    <script src="{{asset('js/formularios.js')}}" crossorigin="anonymous"></script> 
@endsection
@push('js')
    
@endpush


