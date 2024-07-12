<!-- tramite/confirmacion.blade.php -->
@extends('tramite.partials.principal')
@section('content')
    <div class="container">
        <h2>Confirmación de Envío</h2>
        <p>El trámite ha sido enviado correctamente con los siguientes detalles:</p>
        <ul>
            <li>Tipo de Persona: {{$tramite->persona->tipo_persona}}</li>
            <li>Nombre: {{ $tramite->persona->nombre }}</li>
            <li>DNI/RUC:{{ $tramite->persona->numero_documento}} </li>
            <li>Correo: {{$tramite->persona->email}}</li>
            <li>Tipo de Trámite: {{ $tramite->tipo_tramite }}</li>
            <li>N° Documento: {{ $tramite->id}}</li>
            <li>Codigo Confirmación : {{ $tramite->cod_seguridad }}</li>

            <!-- Agrega más detalles según sea necesario -->
            <H5>Nota: por favor guarde su numero de documento y el codigo de confirmación para poder hacerle seguimiento a su tramite</H2>
        </ul>
        <a href="{{ route('tramites.create') }}" class="btn btn-primary">Enviar otro trámite</a>
    </div>
@endsection
