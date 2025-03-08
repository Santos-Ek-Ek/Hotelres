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
    <!-- <div class="d-flex justify-content-between align-items-center mb-2">
        <span id="resumenHabitacion"></span>
        <span id="resumenPrecio"></span>
    </div> -->
    <!-- <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-user-friends"></i>
            <span class="ml-2" id="resumenHuespedes">&nbsp; </span>
        </div>
        <button class="btn btn-link text-danger p-0">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div> -->
    <!-- <hr> -->
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
                actualizarResumenFechas(checkin, checkout);
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

            habitacionesPorTipo.forEach((grupo,index) => {
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
                            <div class="card p-3" id="card-${index}">
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
<button class="btn btn-warning ms-3 add-btn" data-tipo="${habitacion.tipo_habitacion.tipo_cuarto}" data-precio="${precioTotal}" data-noches="${noches}" data-cantidad-disponible="${cantidad_disponible}" data-index="${index}">Añadir</button>
                                            </div>
                                                                                <div class="mt-2">
                                        <span class="text-muted">Disponibles: <span id="cantidad-disponible-${index}">${cantidad_disponible}</span></span>
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
        

        document.removeEventListener('click', handleAddButtonClick); // Eliminar el evento si ya existe
document.addEventListener('click', handleAddButtonClick); // Registrar el evento nuevamente

function handleAddButtonClick(event) {
    if (event.target.classList.contains('add-btn')) {
        const tipoHabitacion = event.target.getAttribute('data-tipo');
        const precioTotal = event.target.getAttribute('data-precio');
        const noches = event.target.getAttribute('data-noches');
        const cantidad = event.target.closest('.card-body').querySelector('input').value;
        const maxPersonas = event.target.closest('.card-body').querySelector('select').value;
        const cantidadDisponible = event.target.getAttribute('data-cantidad-disponible');
        const index = event.target.getAttribute('data-index');
        agregarAlResumen(tipoHabitacion, precioTotal, noches, cantidad, maxPersonas,cantidadDisponible, index);
    }
}

function agregarAlResumen(tipoHabitacion, precioTotal, noches, cantidad, maxPersonas, cantidadDisponible, index) {
    const mensajeSinAlojamientos = document.getElementById('mensajeSinAlojamientos');
    const resumenReserva = document.getElementById('resumenReserva');

    // Ocultar el mensaje y mostrar el resumen
    mensajeSinAlojamientos.style.display = 'none';
    resumenReserva.style.display = 'block';

    // Buscar si ya existe una entrada con el mismo tipo de habitación y número de huéspedes
    const entradasHabitaciones = resumenReserva.querySelectorAll('.d-flex.justify-content-between.align-items-center.mb-2');
    let entradaExistente = null;

    entradasHabitaciones.forEach(entrada => {
        const tipo = entrada.querySelector('span:nth-child(1)')?.textContent; // Usar operador opcional (?)
        const entradaHuespedes = entrada.nextElementSibling; // Contenedor de huéspedes
        const huespedes = entradaHuespedes?.querySelector('.ml-2')?.textContent; // Usar operador opcional (?)

        if (tipo && tipo.includes(tipoHabitacion) && huespedes === maxPersonas) {
            entradaExistente = entrada;
        }
    });

    if (entradaExistente) {
        // Si existe, incrementar la cantidad
        const cantidadActual = parseInt(entradaExistente.querySelector('span:nth-child(1)').textContent.split('x')[0].trim());
        const nuevaCantidad = cantidadActual + parseInt(cantidad);

        // Verificar que la nueva cantidad no supere la cantidad disponible
        if (nuevaCantidad < cantidadDisponible) {
            alert(`No hay suficientes habitaciones disponibles. Solo quedan ${cantidadDisponible}.`);
            return;
        }

        // Actualizar la cantidad en la entrada existente
        entradaExistente.querySelector('span:nth-child(1)').textContent = `${nuevaCantidad}x ${tipoHabitacion}`;

        // Actualizar el precio total
        const precioUnitario = precioTotal / cantidad;
        const nuevoPrecioTotal = precioUnitario * nuevaCantidad;
        entradaExistente.querySelector('span:nth-child(2)').textContent = `MXN ${nuevoPrecioTotal}`;
    } else {
        // Si no existe, crear una nueva entrada
        const nuevaEntrada = document.createElement('div');
        nuevaEntrada.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'mb-2');
        nuevaEntrada.innerHTML = `
            <span>${cantidad}x ${tipoHabitacion}</span>
            <span>MXN ${precioTotal}</span>
        `;

        const nuevaEntradaHuespedes = document.createElement('div');
        nuevaEntradaHuespedes.classList.add('d-flex', 'align-items-center', 'justify-content-between', 'mb-4');
        nuevaEntradaHuespedes.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-user-friends"></i>
                <span class="ml-2">${maxPersonas}</span>
            </div>
            <button class="btn btn-link text-danger p-0" onclick="eliminarHabitacion(this)">
                <i class="fas fa-trash-alt"></i>
            </button>
        `;

        // Crear un hr para separar las entradas
        const hr = document.createElement('hr');

        // Insertar la nueva entrada y el hr antes del subtotal
        const subtotalElement = resumenReserva.querySelector('.d-flex.justify-content-between.align-items-center.mb-2');
        resumenReserva.insertBefore(nuevaEntrada, subtotalElement);
        resumenReserva.insertBefore(nuevaEntradaHuespedes, subtotalElement);
        resumenReserva.insertBefore(hr, subtotalElement);
    }

    // Actualizar la cantidad disponible en la tarjeta de la habitación
    const card = document.getElementById(`card-${index}`);
    const addButton = card.querySelector('.add-btn');
    const nuevaCantidadDisponible = cantidadDisponible - cantidad;

    // Actualizar el atributo data-cantidad-disponible
    addButton.setAttribute('data-cantidad-disponible', nuevaCantidadDisponible);
 // Actualizar el texto de la cantidad disponible
 const cantidadDisponibleElement = card.querySelector(`#cantidad-disponible-${index}`);
    cantidadDisponibleElement.textContent = nuevaCantidadDisponible;
    // Deshabilitar el botón si no hay disponibilidad
    if (nuevaCantidadDisponible <= 0) {
        addButton.disabled = true;
        addButton.textContent = 'No disponible';
        addButton.classList.remove('btn-warning');
        addButton.classList.add('btn-secondary');
    }

    // Actualizar los totales
    actualizarTotales();
}
function eliminarHabitacion(boton) {
    // Obtener el contenedor de la habitación (el div anterior al contenedor del botón)
    const contenedorHuespedes = boton.closest('.d-flex.align-items-center.justify-content-between.mb-4');
    const entradaHabitacion = contenedorHuespedes.previousElementSibling;

    // Verificar que el contenedor de la habitación existe
    if (!entradaHabitacion || !entradaHabitacion.classList.contains('d-flex')) {
        console.error("No se encontró el contenedor de la habitación.");
        return;
    }

    // Obtener el <hr> (siguiente hermano del contenedor de los huéspedes)
    const hr = contenedorHuespedes.nextElementSibling;

    // Verificar que el <hr> existe
    if (!hr || hr.tagName !== 'HR') {
        console.error("No se encontró el <hr>.");
        return;
    }
    // Obtener la cantidad eliminada
    const cantidadEliminada = parseInt(entradaHabitacion.querySelector('span:nth-child(1)').textContent.split('x')[0].trim());
    const tipoHabitacion = entradaHabitacion.querySelector('span:nth-child(1)').textContent.split('x')[1].trim();
    const index = Array.from(document.querySelectorAll('.add-btn')).findIndex(btn => btn.getAttribute('data-tipo') === tipoHabitacion);
    // Eliminar los elementos del DOM
    entradaHabitacion.remove();
    contenedorHuespedes.remove();
    hr.remove();
    // Actualizar la cantidad disponible en la tarjeta de la habitación
    const card = document.getElementById(`card-${index}`);
    const addButton = card.querySelector('.add-btn');
    const cantidadDisponible = parseInt(addButton.getAttribute('data-cantidad-disponible')) + cantidadEliminada;

    // Actualizar el atributo data-cantidad-disponible
    addButton.setAttribute('data-cantidad-disponible', cantidadDisponible);
    const cantidadDisponibleElement = card.querySelector(`#cantidad-disponible-${index}`);
    cantidadDisponibleElement.textContent = cantidadDisponible;

    // Habilitar el botón si hay disponibilidad
    if (cantidadDisponible > 0) {
        addButton.disabled = false;
        addButton.textContent = 'Añadir';
        addButton.classList.remove('btn-secondary');
        addButton.classList.add('btn-warning');
    }
    // Verificar si no quedan registros
    const resumenReserva = document.getElementById('resumenReserva');
    const registros = resumenReserva.querySelectorAll('.d-flex.justify-content-between.align-items-center.mb-2');

    if (registros.length === 0) {
        // Si no hay registros, mostrar el mensaje y ocultar el resumen
        document.getElementById('mensajeSinAlojamientos').style.display = 'block';
        resumenReserva.style.display = 'none';
    } else {
        // Si aún hay registros, actualizar los totales
        actualizarTotales();
    }
}
function actualizarTotales() {
    const resumenReserva = document.getElementById('resumenReserva');
    
    // Selecciona solo los elementos que contienen los precios de las habitaciones
    const preciosElements = resumenReserva.querySelectorAll('.d-flex.justify-content-between.align-items-center.mb-2 span:nth-child(2):not(#resumenSubtotal):not(#resumenImpuestos):not(#resumenTotal):not(#resumenDeposito)');
    
    console.log("Elementos de precios encontrados:", preciosElements);

    // Extrae los valores numéricos de los precios
    const precios = Array.from(preciosElements).map(span => {
        const precioTexto = span.textContent.replace('MXN ', '').replace(/,/g, '');
        console.log("Texto del precio:", precioTexto);
        const precioNumero = parseFloat(precioTexto);
        console.log("Precio convertido a número:", precioNumero);
        return precioNumero;
    });

    console.log("Precios extraídos:", precios);

    // Suma todos los precios para obtener el subtotal
    const subtotal = precios.reduce((sum, precio) => sum + precio, 0);
    console.log("Subtotal:", subtotal);

    // Calcula impuestos (16%)
    const impuestos = subtotal * 0.16;
    console.log("Impuestos:", impuestos);
    const subtotal2 =subtotal-impuestos;
    // Calcula el total
    const total = subtotal;
    console.log("Total:", total);

    // Actualiza los valores en el DOM
    document.getElementById('resumenSubtotal').textContent = `MXN ${subtotal2.toLocaleString('es-MX', { minimumFractionDigits: 2 })}`;
    document.getElementById('resumenImpuestos').textContent = `MXN ${impuestos.toLocaleString('es-MX', { minimumFractionDigits: 2 })}`;
    document.getElementById('resumenTotal').textContent = `MXN ${total.toLocaleString('es-MX', { minimumFractionDigits: 2 })}`;
    document.getElementById('resumenDeposito').textContent = `MXN ${total.toLocaleString('es-MX', { minimumFractionDigits: 2 })}`;
}
function actualizarResumenFechas(checkin, checkout) {
    // Formatear las fechas en el formato "d-MM-YYYY"
    const checkinFormateado = moment(checkin, 'D-M-YYYY').format('D-MM-YYYY');
    const checkoutFormateado = moment(checkout, 'D-M-YYYY').format('D-MM-YYYY');

    // Calcular el número de noches
    const checkinDate = moment(checkin, 'D-M-YYYY');
    const checkoutDate = moment(checkout, 'D-M-YYYY');
    const noches = checkoutDate.diff(checkinDate, 'days');

    // Actualizar el resumen
    document.getElementById('resumenCheckin').textContent = checkinFormateado;
    document.getElementById('resumenCheckout').textContent = checkoutFormateado;
    document.getElementById('resumenNoches').textContent = `${noches} ${noches === 1 ? 'noche' : 'noches'}`;
}
    </script>
</body>
</html>