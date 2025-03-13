@extends('administrador.layout.app')
@section('titulo', 'Reservaciones')
@section('content')
<style>
    .envio-status {
        font-weight: bold;
    }

    .color-green {
        color: green;
    }

    .color-orange {
        color: orange;
    }
</style>

<div class="container-fluid">
<div class="form-group">
    <label for="searchInput">Buscar por Número de Reserva:</label>
    <input type="text" class="form-control" id="searchInput" placeholder="Ingrese el No. Reserva">
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="checkEnviados" value="ENVIADO">
    <label class="form-check-label" for="checkEnviados">Ocupados</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="checkPendientes" value="PENDIENTE">
    <label class="form-check-label" for="checkPendientes">Pendientes</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="checkCancelados" value="PENDIENTE">
    <label class="form-check-label" for="checkCancelados">Cancelados</label>
</div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table class="table" id="tbl3">
                <thead>
                    <th scope="col">No. RESERVA</th>
                    <th scope="col">No. CUARTO</th>
                    <th scope="col">TIPO DE CUARTO</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">FECHA DE ENTRADA</th>
                    <th scope="col">FECHA DE SALIDA</th>
                    <th scope="col">CANTIDAD DE NOCHES</th>
                    <th scope="col">CANTIDAD HUESPEDES</th>
                    <th scope="col">HUÉSPED PRINCIPAL</th>
                    <th scope="col">ESTADO</th>
                </thead>
                <tbody>
                @foreach ( $reservas as $reserva )
                    <tr>
                      <td>{{ $reserva->numero_reserva }}</td>
                      <td>{{$reserva->numero_cuarto}}</td>
                      <td>{{ $reserva->tipo_cuarto }}</td>
                      <td>{{ $reserva->cantidad_cuartos }}</td>
                      <td>{{ $reserva->fecha_entrada->format('Y-m-d') }}</td>
                      <td>{{ $reserva->fecha_salida->format('Y-m-d') }}</td>
                      <td>{{ $reserva->cantidad_noches }}</td>
                      <td>{{ $reserva->cantidad_huespedes }}</td>
                      <td><p style="display: inline-block; max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: normal; word-wrap: break-word;">{{ $reserva->huesped->nombre.' ' . $reserva->huesped->apellido }}</p></td>
                      <td>
                      <div style="display: flex; align-items: center;">
        <!-- Select deshabilitado inicialmente -->
        <select name="estado" id="estado_{{ $reserva->id }}" class="form-select col-md-8 me-4" disabled style="margin-right: 8px;" onchange="actualizarEstado(this)">
    @if ($reserva->estado == 'Ocupado')
        <option value="Ocupado" selected>Ocupado</option>
        <option value="Cancelado">Cancelado</option>
        <option value="Pendiente">Pendiente</option>
    @elseif ($reserva->estado == 'Cancelado')
        <option value="Cancelado" selected>Cancelado</option>
        <option value="Ocupado">Ocupado</option>
        <option value="Pendiente">Pendiente</option>
    @elseif ($reserva->estado == 'Pendiente')
        <option value="Pendiente" selected>Pendiente</option>
        <option value="Ocupado">Ocupado</option>
        <option value="Cancelado">Cancelado</option>
    @endif
</select>
        
        <!-- Ícono de lápiz para habilitar el select -->
        <i class="fas fa-pencil-alt" style="cursor: pointer;" onclick="habilitarSelect({{ $reserva->id }})"></i>
    </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <!-- Agrega esta fila al final de tu tabla -->
<tr id="noPendientesMessage" style="display: none;">
    <td colspan="9">No hay reservas pendientes.</td>
</tr>
<tr id="noEnviadosMessage" style="display: none;">
    <td colspan="9">Ninguna reserva ha sido enviado.</td>
</tr>
<tr id="noCanceladoMessage" style="display: none;">
    <td colspan="9">Ninguna reserva ha sido cancelada.</td>
</tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
function habilitarSelect(id) {
    const select = document.getElementById(`estado_${id}`);

    // Si el select ya está habilitado, lo deshabilitamos
    if (!select.disabled) {
        select.disabled = true;
        return; // Salimos de la función
    }

    // Si el select está deshabilitado, lo habilitamos
    select.disabled = false;

    // Obtener el estado actual del pago (el valor seleccionado)
    const estadoActual = select.value;

    // Limpiar las opciones actuales
    select.innerHTML = '';

    // Generar las opciones dinámicamente
    if (estadoActual === 'Ocupado') {
        select.innerHTML += '<option value="Ocupado" selected>Ocupado</option>';
        select.innerHTML += '<option value="Cancelado">Cancelado</option>';
        select.innerHTML += '<option value="Pendiente">Pendiente</option>';
    } else if (estadoActual === 'Cancelado') {
        select.innerHTML += '<option value="Cancelado" selected>Cancelado</option>';
        select.innerHTML += '<option value="Ocupado">Ocupado</option>';
        select.innerHTML += '<option value="Pendiente">Pendiente</option>';
    } else if (estadoActual === 'Pendiente') {
        select.innerHTML += '<option value="Pendiente" selected>Pendiente</option>';
        select.innerHTML += '<option value="Ocupado">Ocupado</option>';
        select.innerHTML += '<option value="Cancelado">Cancelado</option>';
    }
}

function actualizarEstado(select) {
    const id = select.id.split('_')[1];
    const nuevoEstado = select.value;

    // Deshabilitar el select después de seleccionar un valor
    select.disabled = true;

    // Enviar la actualización a la base de datos mediante AJAX
    fetch(`/actualizar-estado-reserva/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ estado: nuevoEstado })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Estado actualizado correctamente');
        } else {
            alert('Error al actualizar el estado');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const checkEnviados = document.getElementById('checkEnviados');
        const checkPendientes = document.getElementById('checkPendientes');
        const tableRows = document.querySelectorAll('#tbl3 tbody tr');
        const noPendientesMessage = document.getElementById('noPendientesMessage');
        const noEnviadosMessage = document.getElementById('noEnviadosMessage');
        const noCanceladosMessage = document.getElementById('noCanceladoMessage');

        // Función para filtrar la tabla
        function filtrarTabla() {
            const searchText = searchInput.value.toLowerCase(); // Texto de búsqueda en minúsculas
            const mostrarEnviados = checkEnviados.checked; // Estado del checkbox "Enviados"
            const mostrarPendientes = checkPendientes.checked; // Estado del checkbox "Pendientes"
            const mostrarCancelados = checkCancelados.checked; // Estado del checkbox "Cancelados"

            let filasVisibles = 0;
            let pendientesVisibles = 0;
            let enviadosVisibles = 0;
            let canceladosVisibles = 0;

            tableRows.forEach(row => {
                // Verificar que la fila tenga al menos 7 celdas
                if (row.cells.length >= 10) {
                    const numeroReserva = row.cells[0].textContent.toLowerCase();
                    const nombreHuesped = row.cells[8].textContent.toLowerCase();
                    const selectEstado = row.cells[9].querySelector('select');

                    // Verificar si el select existe
                    if (selectEstado) {
                        const estado = selectEstado.value;

                        // Verificar si la fila coincide con el texto de búsqueda
                        const coincideBusqueda = numeroReserva.includes(searchText) || nombreHuesped.includes(searchText);

                        // Verificar si la fila coincide con los filtros de estado
                        const coincideEstado =
                            (mostrarEnviados && estado === 'Ocupado') ||
                            (mostrarPendientes && estado === 'Pendiente') ||
                            (mostrarCancelados && estado === 'Cancelado') ||
                            (!mostrarEnviados && !mostrarPendientes && !mostrarCancelados); // Mostrar todos si no hay filtros

                        // Mostrar u ocultar la fila según los filtros
                        if (coincideBusqueda && coincideEstado) {
                            row.style.display = '';
                            filasVisibles++;
                            if (estado === 'Pendiente') pendientesVisibles++;
                            if (estado === 'Ocupado') enviadosVisibles++;
                            if (estado === 'Cancelado') canceladosVisibles++;
                        } else {
                            row.style.display = 'none';
                        }
                    }
                }
            });

            // Mostrar mensajes si no hay filas visibles
            noPendientesMessage.style.display = (pendientesVisibles === 0 && mostrarPendientes) ? '' : 'none';
            noEnviadosMessage.style.display = (enviadosVisibles === 0 && mostrarEnviados) ? '' : 'none';
            noCanceladosMessage.style.display = (canceladosVisibles === 0 && mostrarCancelados) ? '' : 'none';
        }

        // Eventos para activar el filtrado
        searchInput.addEventListener('input', filtrarTabla);
        checkEnviados.addEventListener('change', filtrarTabla);
        checkPendientes.addEventListener('change', filtrarTabla);
        checkCancelados.addEventListener('change', filtrarTabla);
    });
</script>
@endsection