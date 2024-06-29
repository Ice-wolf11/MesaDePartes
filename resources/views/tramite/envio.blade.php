@extends('tramite.partials.principal')

@section('content')
    <form action="">
        <div class="containerForm">
            <div class="form-section">
                <h2>Documento</h2>
                @component('tramite.components.documento')@endcomponent
            </div>
            <div class="form-section">
                <h2>Remitente</h2>
                @component('tramite.components.persona')@endcomponent
            </div>
        </div>
        <div class="submit-section">
            <button type="submit">Enviar</button>
        </div>
    </form>
@endsection


