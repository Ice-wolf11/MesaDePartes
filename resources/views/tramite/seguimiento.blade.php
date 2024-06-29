@extends('tramite.partials.principal')
@push('css')
    <style>
        /* Barra de búsqueda */
        .search-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto; /* Centramos horizontalmente la barra de búsqueda */
            max-width: 1200px; /* Ajustamos el ancho máximo */
        }

        .search-bar form {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Aseguramos el espacio entre los elementos */
            width: 100%;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-right: 20px;
            margin-bottom: 0; /* Establecemos el margin-bottom en 0 */
        }

        .form-group label {
            margin-right: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 225px; /* Aumentamos el ancho del input */
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn1 {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            max-width: 200px;/* Reducimos el ancho de los botones */
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success2 {
            background-color: #a72828;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-link {
            background-color: transparent;
            color: #007bff;
            text-decoration: none;
            padding: 5px 10px;
        }

        .btn-link:hover {
            text-decoration: underline;
        }
        /*componente informacion cliente*/
        .info-block {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 1200px; /* Ajuste el ancho máximo para centrar */
        }

        .info-column {
            display: flex;
            flex-direction: column;
        }

        .info-group {
            display: flex;
            flex-direction: row;
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: bold;
            margin-right: 5px;
        }

        .info-value {
            color: #333;
        }

        @media (max-width: 768px) {
            .info-block {
                grid-template-columns: 1fr;
            }
        }

        /*datos revision*/
        .seguimiento-expediente {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .seguimiento-expediente h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        .table-seguimiento {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-seguimiento th,
        .table-seguimiento td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table-seguimiento th {
            background-color: #007bff;
            color: white;
        }

        .table-seguimiento tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-seguimiento tr:hover {
            background-color: #ddd;
        }

        .table-seguimiento th, 
        .table-seguimiento td {
            text-align: left;
            padding: 8px;
        }

        .table-seguimiento th {
            background-color: #007bff;
            color: white;
        }



    </style>

@endpush

@section('content')
    @component('tramite.components.buscar')@endcomponent
    @component('tramite.components.datos-remitente')@endcomponent
    @component('tramite.components.datos-revision')@endcomponent
@endsection