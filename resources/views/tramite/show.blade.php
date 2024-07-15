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
    <!--buscar tramite-->
    <div class="search-bar">     
        <form id="form-busqueda">
            <div class="form-group">
                <label for="expediente">Nº Expediente:</label>
                <input type="text" id="expediente" name="expediente">
            </div>
            <div class="form-group">
                <label for="codigoSeguridad">Cod. Seguridad:</label>
                <input type="text" id="codigoSeguridad" name="codigoSeguridad">
            </div>
            <button type="submit" class="btn1 btn-success">Buscar</button>
            <button type="reset" class="btn1 btn-success2">Limpiar...</button>
        </form>
    </div>
    <!--datos del remitente-->
    <div class="info-block">
        <div class="info-column">
            <div class="info-group">
                <label class="info-label">Fecha Hora:</label>
                <span class="info-value fechaHora">{{ $fechaHora ?? 'N/A' }}</span>
            </div>
            <div class="info-group">
                <label class="info-label">Nº Expediente:</label>
                <span class="info-value numeroExpediente">{{ $numeroExpediente ?? 'N/A' }}</span>
            </div>
            <div class="info-group">
                <label class="info-label">Nombres:</label>
                <span class="info-value nombres">{{ $nombres ?? 'N/A' }}</span>
            </div>
            <div class="info-group">
                <label class="info-label">Estado:</label>
                <span class="info-value estado">{{ $estado ?? 'N/A' }}</span>
            </div>
        </div>
        <div class="info-column">
            <div class="info-group">
                <label class="info-label">Tipo Documento:</label>
                <span class="info-value tipoDocumento">{{ $tipoDocumento ?? 'N/A' }}</span>
            </div>
            <div class="info-group">
                <label class="info-label">Asunto:</label>
                <span class="info-value asunto">{{ $asunto ?? 'N/A' }}</span>
            </div>
            <div class="info-group">
                <label class="info-label">Nº Documento:</label>
                <span class="info-value numeroDocumento">{{ $numeroDocumento ?? 'N/A' }}</span>
            </div>
            <div class="info-group">
                <label class="info-label">Folios:</label>
                <span class="info-value folios">{{ $folios ?? 'N/A' }}</span>
            </div>
        </div>
    </div>

    <!--datos-revision-->
    <table class="table-seguimiento">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha Hora</th>
                <th>Descripción</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody id="tbody-seguimiento">
            <!-- Aquí se llenarán las filas dinámicamente -->
        </tbody>
    </table>
 
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
  $(document).ready(function() {
    $('#form-busqueda').on('submit', function(e) {
        e.preventDefault();

        var expediente = $('#expediente').val();
        var codigoSeguridad = $('#codigoSeguridad').val();

        $.ajax({
            url: "{{ route('tramites.buscar') }}",
            method: 'GET',
            data: {
                expediente: expediente,
                codigoSeguridad: codigoSeguridad
            },
            success: function(response) {
                if (response.success) {
                    // Actualizar la vista con los datos obtenidos
                    var tramite = response.data;
                    var formattedDate = moment(tramite.created_at).format('DD/MM/YYYY HH:mm:ss'); // Formatear la fecha

                    $('.fechaHora').text(formattedDate);
                    $('.numeroExpediente').text(tramite.id);
                    $('.nombres').text(tramite.persona.nombre);
                    $('.estado').text(tramite.estado.descripcion);
                    $('.tipoDocumento').text(tramite.tipo_tramite);
                    $('.asunto').text(tramite.asunto);
                    $('.numeroDocumento').text(tramite.persona.numero_documento);
                    $('.folios').text(tramite.folios);

                    // Actualizar la tabla de seguimiento
                    var revisiones = tramite.revisiones;
                    var tbodySeguimiento = $('#tbody-seguimiento');
                    tbodySeguimiento.empty(); // Limpiar la tabla antes de agregar nuevas filas

                    revisiones.forEach(function(revision, index) {
                        var fila = `<tr>
                            <td>${index + 1}</td>
                            <td>${moment(revision.created_at).format('DD/MM/YYYY HH:mm:ss')}</td>
                            <td>${revision.descripcion}</td>
                            <td>${revision.trabajador.nombre}</td> <!-- Cambiado a trabajador -->
                        </tr>`;
                        tbodySeguimiento.append(fila);
                    });
                } else {
                    alert(response.message);
                }
            }
        });
    });
});

</script>
