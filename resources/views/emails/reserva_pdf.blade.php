<!DOCTYPE html>
<html>
<head>
    <title>Reserva Confirmada</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f3f4f6;
            padding: 16px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-lg {
            font-size: 1.125rem;
        }
        .font-bold {
            font-weight: 700;
        }
        .text-gray-600 {
            color: #4b5563;
        }
        .mb-2 {
            margin-bottom: 8px;
        }
        .mb-4 {
            margin-bottom: 16px;
        }
        .mt-2 {
            margin-top: 8px;
        }
        .mt-4 {
            margin-top: 16px;
        }
        .p-2 {
            padding: 8px;
        }
        .border {
            border: 1px solid #e5e7eb;
        }
        .bg-blue-900 {
            background-color: #1e3a8a;
        }
        .text-white {
            color: #ffffff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #e5e7eb;
        }
        .align-top {
            vertical-align: top;
        }
        .total-section {
            margin-top: 24px;
            text-align: right;
            font-size: 1.25rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Logo y nombre del hotel -->
    <div class="text-center mb-4">
        <img src="img/logo.jpeg" alt="Logo del Hotel" style="max-width: 100px; height: auto; margin-bottom: 16px;">
    </div>

    <!-- Información de contacto -->
    <div class="text-center mb-4">
        <p class="text-gray-600"><i class="fas fa-map-marker-alt"></i> Calle 31 81,97510 Temax, Yucatán, México</p>
        <p class="text-gray-600"><i class="fas fa-phone"></i> +52 9999 932 551</p>
        <p class="text-gray-600"><i class="fas fa-envelope"></i> Ismaeltinalmoguel@gmail.com</p>
    </div>
    <hr class="mb-4">

    <!-- Detalles de la reserva -->
    <div class="mb-4">
        <h2 class="text-lg font-bold mb-2">Detalles de la reserva</h2>
        <table>
            <tr>
                <td class="align-top">
                    <p><strong>Check-in</strong></p>
                    <p>{{ $fecha_entrada }}</p>
                    <p class="mt-2"><strong>Check-out</strong></p>
                    <p>{{ $fecha_salida }}</p>
                </td>
                <td class="align-top text-right">
                    <p><strong>Reservado por</strong></p>
                    <p>{{ $huesped->nombre }} {{ $huesped->apellido }}</p>
                    <p>{{ $correo }}</p>
                </td>
            </tr>
        </table>
    </div>

    <!-- Detalles de la reserva -->
    <div class="mb-4">
        <h2 class="text-lg font-bold mb-2">Reserva</h2>
        <table>
            <tr>
                <td>
                    <p><strong>Reserva #</strong></p>
                    <p>{{ $reserva }}</p>
                </td>
                <td>
                    <p><strong>Fecha de reserva</strong></p>
                    <p>{{ $fecha }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><strong>Estado</strong></p>
                    <p>Confirmado</p>
                </td>
                <td>
                    <p><strong>Cantidad de noches</strong></p>
                    <p>{{ $cantidad_noches }}</p>
                </td>
            </tr>
        </table>
    </div>

    <!-- Tabla de habitaciones -->
    <div class="mb-4">
        <table>
            <thead>
                <tr class="bg-blue-900 text-white">
                    <th class="p-2 border">Cantidad Noches</th>
                    <th class="p-2 border">Número de habitación</th>
                    <th class="p-2 border">Tipo de habitación</th>
                    <th class="p-2 border">Cantidad de huéspedes</th>
                    <th class="p-2 border">Subtotal</th>
                    <th class="p-2 border">Impuestos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($habitaciones as $habitacion)
                    <tr>
                        <td class="p-2 border">{{ $cantidad_noches }}</td>
                        <td class="p-2 border">{{ $habitacion['numero_cuarto'] }}</td>
                        <td class="p-2 border">{{ $habitacion['tipo'] }}</td>
                        <td class="p-2 border">{{ $habitacion['cantidad_huespedes'] }}</td>
                        <td class="p-2 border">{{ number_format($habitacion['subtotal'], 2) }} MXN</td>
                        <td class="p-2 border">{{ number_format($impuesto, 2) }} MXN</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Total -->
    <div class="total-section">
        <p>Total {{ number_format($total, 2) }} MXN</p>
    </div>

    <!-- Información adicional -->
    <div class="mt-4">
        <h2 class="text-lg font-bold mb-2">Información adicional</h2>
        <p>Check-in desde la 1 PM, check-out hasta las 12 AM.</p>
        <p>Estacionamiento gratuito en el lugar.</p>
    </div>
</div>
</body>
</html>