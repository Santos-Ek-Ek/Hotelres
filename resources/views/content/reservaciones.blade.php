<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Truck | Reservaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

    <style>
        .row{
            --bs-gutter-x: 0;
        }
                .card { border-radius: 15px; }
                .add-btn { background-color: #FFD700; border: none; }
        .header {
            background-color: #FFC107;
            padding: 1rem;
        }
        .header h1 {
            color: black;
            font-weight: bold;
        }
        .header .btn {
            background-color: white;
            color: black;
        }
        .main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        .booking-form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .property-info {
            background-color: #FFC107;
            padding: 1rem;
        }
        .property-info h2 {
            color: white;
            font-weight: bold;
        }
        
        .header-input {
            border-radius: 50px;
            padding: 0.5rem 1rem;
        }
        .header-button {
            border-radius: 50px;
            padding: 0.5rem 1rem;
        }
        .room-card {
            border-radius: 15px;
        }
        .compare-button {
            border-radius: 50px;
            padding: 0.5rem 1rem;
        }

                /* Estilos para el diseño de dos columnas */
                .main-container {
            display: flex;
            gap: 20px;
            padding: 20px;
        }
        .habitaciones-container {
            flex: 3; /* Ocupa 3 partes del espacio disponible */
            overflow-y: auto; /* Permite el desplazamiento vertical */
        }
        .sidebar {
            flex: 1; /* Ocupa 1 parte del espacio disponible */
            position: sticky;
            top: 20px; /* Distancia desde la parte superior */
            height: fit-content; /* Ajusta la altura al contenido */
        }

        .btn-custom {
            background-color: #FFD700;
            color: white;
        }
        .mb-4{
            margin-bottom: 0.5rem !important;
        }
    </style>
</head>
<div id="apartado1" style="    width: 100%;
    height: 100%;
    background-color: #FFC107;">
<div class="bg-light">
    <header class="header d-flex justify-content-between align-items-center">
        <h1>Hotel Truck</h1>
        <button disabled class="btn btn-light d-flex align-items-center">

            MXN
        </button>
    </header>
    <main class="position-relative" >
        <img src="img/pasillo2.jpeg" alt="A beautiful swimming pool with a person standing at the far end, surrounded by greenery and a building in the background" class="main-image">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="booking-form text-center">
                <h2 class="mb-4">Seleccione las fechas de la estancia</h2>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        <input type="text" id="checkin" class="form-control" placeholder="Llegada">
                        <span class="input-group-text">→</span>
                        <input type="text" id="checkout" class="form-control" placeholder="Salida">
                    </div>
                </div>
                <button id="btnBuscar" class="btn btn-warning text-white">Buscar</button>
            </div>
        </div>
</div>
    </main>
</div>
    <div id="apartado2" style="display: none; background-color: #FFC107; width:100%;">
        <header class="header d-flex justify-content-between align-items-center">
            <h1 class="text-black">Hotel Truck</h1>
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center bg-white header-input mr-2">
                    <input type="text" class="form-control border-0" id="checkinbus" placeholder="14 mar 2025">
                    <span class="mx-2">→</span>
                    <input type="text" class="form-control border-0" id="checkoutbus" placeholder="21 mar 2025">
                    <button id="btnBuscarHeader" class="btn text-warning ml-2"><i class="fas fa-search"></i></button>
                </div>

                <button disabled class="btn btn-light d-flex align-items-center">MXN</button>

            </div>
        </header>
        
        <!-- Contenedor principal para las dos columnas -->
        <div class="main-container">
            <!-- Columna izquierda: Tarjetas de habitaciones -->
            <div class="habitaciones-container" id="habitacionesContainer">
                <!-- Aquí se mostrarán las habitaciones disponibles -->
            </div>

            <!-- Columna derecha: Sección fija -->
            <div class="sidebar">
                <div id="mensajeSinAlojamientos" class="card text-center p-3">
                    <i class="bi bi-bed fs-1"></i>
                    <p>No se han agregado alojamientos</p>
                </div>

                <div id="resumenReserva" class="card shadow p-4" style="width: 22rem; display: none;">
    <h5 class="text-center font-weight-bold mb-4">Resumen de la reserva</h5>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span id="resumenCheckin"></span>
        <i class="fas fa-arrow-right"></i>
        <span id="resumenCheckout"></span>
    </div>
    <div class="d-flex align-items-center justify-content-center mb-4">
        <i class="fas fa-moon"></i>
        <span class="ml-2" id="resumenNoches">&nbsp;</span>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <span id="resumenHabitacion"></span>
        <span id="resumenPrecio"></span>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-user-friends"></i>
            <span class="ml-2" id="resumenHuespedes">&nbsp; </span>
        </div>
        <button class="btn btn-link text-danger p-0">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Subtotal</span>
                        <span id="resumenSubtotal"></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span>Impuestos y tasas</span>
                        <span id="resumenImpuestos"></span>
                    </div>

    <div class="d-flex justify-content-between align-items-center font-weight-bold mb-4">
        <span>Total</span>
        <span id="resumenTotal"></span>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span>Depósito</span>
        <span id="resumenDeposito"></span>
    </div>
    <button class="btn btn-custom btn-block mb-4">Reservar ahora</button>
</div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof flatpickr !== "undefined" && flatpickr.l10ns.es) {
                console.log("Flatpickr y la localización en español cargados correctamente.");
            } else {
                console.error("Error: Flatpickr o la localización en español no se han cargado correctamente.");
            }

            // Configurar Flatpickr para los inputs de fecha
            flatpickr("#checkin", {
                dateFormat: "d-m-Y", // Formato de fecha
                minDate: "today", // Fecha mínima: hoy
                locale: "es", // Idioma español
                onChange: function(selectedDates, dateStr) {
                    document.getElementById('checkinbus').value = dateStr; // Actualizar el input de fecha en el header
                }
            });

            flatpickr("#checkout", {
                dateFormat: "d-m-Y", // Formato de fecha
                minDate: "today", // Fecha mínima: hoy
                locale: "es", // Idioma español
                onChange: function(selectedDates, dateStr) {
                    document.getElementById('checkoutbus').value = dateStr; // Actualizar el input de fecha en el header
                }
            });

            flatpickr("#checkinbus", {
                dateFormat: "d-m-Y", // Formato de fecha
                minDate: "today", // Fecha mínima: hoy
                locale: "es", // Idioma español
            });

            flatpickr("#checkoutbus", {
                dateFormat: "d-m-Y", // Formato de fecha
                minDate: "today", // Fecha mínima: hoy
                locale: "es", // Idioma español
            });

            // Evento para el botón de búsqueda del primer apartado
            document.getElementById('btnBuscar').addEventListener('click', function() {
                const checkin = document.getElementById('checkin').value;
                const checkout = document.getElementById('checkout').value;

                if (!checkin || !checkout) {
                    alert('Por favor, seleccione ambas fechas.');
                    return;
                }

                // Copiar las fechas al segundo apartado
                document.getElementById('checkinbus').value = checkin;
                document.getElementById('checkoutbus').value = checkout;

                // Ocultar el primer apartado y mostrar el segundo
                document.getElementById('apartado1').style.display = 'none';
                document.getElementById('apartado2').style.display = 'block';

                // Realizar la búsqueda inicial
                buscarHabitaciones(checkin, checkout);
            });

            // Evento para el botón de búsqueda del segundo apartado
            document.getElementById('btnBuscarHeader').addEventListener('click', function() {
                const checkin = document.getElementById('checkinbus').value;
                const checkout = document.getElementById('checkoutbus').value;

                if (!checkin || !checkout) {
                    alert('Por favor, seleccione ambas fechas.');
                    return;
                }

                // Realizar la búsqueda con las nuevas fechas
                buscarHabitaciones(checkin, checkout);
            });
        });

        // Función para buscar habitaciones
        function buscarHabitaciones(checkin, checkout) {
            const checkinDate = moment(checkin, 'D-M-YYYY');
            const checkoutDate = moment(checkout, 'D-M-YYYY');
            const noches = checkoutDate.diff(checkinDate, 'days');

            if (noches <= 0) {
                alert('La fecha de salida debe ser posterior a la fecha de llegada.');
                return;
            }

            // Simulación de una solicitud al servidor
            fetch(`/buscar-habitaciones?checkin=${checkin}&checkout=${checkout}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        mostrarHabitaciones(data.habitacionesPorTipo, noches);
                    } else {
                        alert('Error al buscar habitaciones.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Función para mostrar las habitaciones
        function mostrarHabitaciones(habitacionesPorTipo, noches) {
            const habitacionesContainer = document.getElementById('habitacionesContainer');
            habitacionesContainer.innerHTML = ''; // Limpiar el contenedor

            if (!Array.isArray(habitacionesPorTipo) || habitacionesPorTipo.length === 0) {
                habitacionesContainer.innerHTML = '<p>No hay habitaciones disponibles para las fechas seleccionadas.</p>';
                return;
            }

            const nochesTexto = noches === 1 ? '1 noche' : `${noches} noches`;

            habitacionesPorTipo.forEach(grupo => {
                const { tipo_habitacion, cantidad_disponible, habitaciones } = grupo;
                if (habitaciones.length > 0) {
                    const habitacion = habitaciones[0];
                    const precioTotal = habitacion.tipo_habitacion.precio * noches;
                    let options = '';
                    for (let i = 1; i <= habitacion.tipo_habitacion.cantidad_maxima_personas; i++) {
                        options += `<option value="${i}">${i}</option>`;
                    }
                    const card = `
                        <div class="col-md-8">
                            <div class="card p-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="${habitacion.imagen_habitacion}" class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;" alt="Habitación">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">${habitacion.tipo_habitacion.tipo_cuarto}</h5>
                                            <p><i class="fas fa-users"></i> ${habitacion.tipo_habitacion.cantidad_maxima_personas}</p>
                                            <p>${habitacion.descripcion}</p>
                                            <h5 class="fw-bold">MXN ${precioTotal}</h5>
                                            <div class="me-3">
                                                <span class="text-muted">${nochesTexto}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <label class="fw-bold">Huéspedes</label>
                                                    <select class="form-select w-auto d-inline">${options}</select>
                                                </div>
                                                <div>
                                                    <label class="fw-bold">Cantidad</label>
                                                    <div class="d-flex">
                                                        <button class="btn btn-outline-secondary" onclick="cambiarCantidad(this, -1, ${cantidad_disponible})">-</button>
                                                        <input type="text" class="form-control text-center w-25" value="1" readonly>
                                                        <button class="btn btn-outline-secondary" onclick="cambiarCantidad(this, 1, ${cantidad_disponible})">+</button>
                                                    </div>
                                                </div>
<button class="btn btn-warning ms-3 add-btn" data-tipo="${habitacion.tipo_habitacion.tipo_cuarto}" data-precio="${precioTotal}" data-noches="${noches}">Añadir</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                        </div>
                    `;
                    habitacionesContainer.insertAdjacentHTML('beforeend', card);
                }
            });
        }

        // Función para cambiar la cantidad de habitaciones seleccionadas
        function cambiarCantidad(boton, delta, cantidadDisponible) {
            const input = boton.parentElement.querySelector('input');
            let cantidad = parseInt(input.value);

            cantidad += delta;

            // Validar que la cantidad no sea menor que 1 ni mayor que la cantidad disponible
            if (cantidad < 1) cantidad = 1;
            if (cantidad > cantidadDisponible) cantidad = cantidadDisponible;

            input.value = cantidad;
        }
        

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('add-btn')) {
                const tipoHabitacion = event.target.getAttribute('data-tipo');
                const precioTotal = event.target.getAttribute('data-precio');
                const noches = event.target.getAttribute('data-noches');
                const cantidad = event.target.closest('.card-body').querySelector('input').value;
                const maxPersonas = event.target.closest('.card-body').querySelector('select').value;
                agregarAlResumen(tipoHabitacion, precioTotal, noches, cantidad, maxPersonas);
            }
        });

        function agregarAlResumen(tipoHabitacion, precioTotal, noches, cantidad, maxPersonas) {
    
    const mensajeSinAlojamientos = document.getElementById('mensajeSinAlojamientos');
            const resumenReserva = document.getElementById('resumenReserva');

            // Ocultar el mensaje y mostrar el resumen
            mensajeSinAlojamientos.style.display = 'none';
            resumenReserva.style.display = 'block';

            // Obtener las fechas seleccionadas
            const checkin = document.getElementById('checkinbus').value;
            const checkout = document.getElementById('checkoutbus').value;
            document.getElementById('resumenCheckin').textContent = checkin;
            document.getElementById('resumenCheckout').textContent = checkout;

            // Actualizar el número de noches
            document.getElementById('resumenNoches').textContent = `${noches} noches`;
    document.getElementById('resumenHabitacion').textContent = `${cantidad}x ${tipoHabitacion}`;
    
    // Actualizar el precio total
    document.getElementById('resumenPrecio').textContent = `MXN ${precioTotal}`;
    
    // Actualizar el número de huéspedes
    document.getElementById('resumenHuespedes').textContent = ` ${maxPersonas}`;
    
    // Calcular y actualizar el total
    const subtotal = parseFloat(precioTotal.replace('MXN ', '').replace(',', ''));
    const impuestos = subtotal * 0.16; // Suponiendo un 16% de impuestos
    const subtotal2 = subtotal - impuestos;
    const total = subtotal2 + impuestos;
    
    document.getElementById('resumenTotal').textContent = `MXN ${total.toLocaleString('es-MX', { minimumFractionDigits: 2 })}`;
    document.getElementById('resumenImpuestos').textContent = `MXN ${impuestos.toLocaleString('es-MX', { minimumFractionDigits: 2 })}`;
    document.getElementById('resumenSubtotal').textContent = `MXN ${subtotal2.toLocaleString('es-MX', { minimumFractionDigits: 2 })}`;

    
    // Actualizar el depósito (puede ser igual al total o un porcentaje)
    document.getElementById('resumenDeposito').textContent = `MXN ${total.toLocaleString('es-MX', { minimumFractionDigits: 2 })}`;
}
    </script>
</body>
</html>