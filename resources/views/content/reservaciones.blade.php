<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="img/logo.jpeg" />
    <title>Hotel Truck | Reservaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
            :root {
        --primary-color: #FFC107;
        --secondary-color: #FFD700;
    }
    /* Estilos para el control de cantidad */
.cantidad-input-flex {
    width: 50px;
    min-width: 50px;
    padding: 0.25rem;
}

/* Estilos responsivos para el botón añadir */
.add-btn {
    white-space: nowrap;
    padding: 0.5rem;
}

@media (max-width: 767.98px) {
    .add-btn {
        width: 100%;
        margin-top: 0.5rem;
    }
    
    .cantidad-input-flex {
        width: 40px;
        min-width: 40px;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .add-btn {
        font-size: 0.9rem;
        padding: 0.4rem 0.5rem;
    }
}
    .row {
        --bs-gutter-x: 0;
    }
    
    .card {
        border-radius: 15px;
        margin-bottom: 1rem;
    }
    
    .header {
        background-color: var(--primary-color);
        padding: 1rem;
    }
    
    .header h1 {
        color: black;
        font-weight: bold;
        font-size: 1.5rem;
    }
    
    .header-input {
        border-radius: 50px;
        padding: 0.3rem 0.8rem;
        border: 1px solid #ddd;
    }
        .header .btn {
            background-color: white;
            color: black;
        }
        .main-image {
            width: 100%;
            height: 100%;
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
        

        .header-button {
            border-radius: 50px;
            padding: 0.5rem 1rem;
        }
        .room-card, .reserva-card {
        width: 100%;
    }
        .compare-button {
            border-radius: 50px;
            padding: 0.5rem 1rem;
        }

    /* Contenedores principales */
    .main-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 15px;
    }

        .sidebar {
            flex: 1; /* Ocupa 1 parte del espacio disponible */
            position: sticky;
            top: 20px; /* Distancia desde la parte superior */
            height: fit-content; /* Ajusta la altura al contenido */
        }
        .mb-4{
            margin-bottom: 0.5rem !important;
        }
        .habitaciones-container {
    flex: 3;
    overflow-y: auto;
    position: relative; /* Para posicionar el formulario dentro de este contenedor */
}
.reservas-container {
    flex: 3;
    overflow-y: auto;
    position: relative; /* Para posicionar el formulario dentro de este contenedor */
}
.form-container {
        background-color: white;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        margin-bottom: 1rem;
    }
    
    /* Botones */
    .btn-custom {
        background-color: var(--secondary-color);
        color: white;
        white-space: nowrap;
    }
    
        /* Mejoras para móviles */
        @media (max-width: 575.98px) {
        .card-body .row > div {
            margin-bottom: 0.5rem;
        }
        
        .card-body .row > div:last-child {
            margin-bottom: 0;
        }
        
        .btn-responsive {
            width: 100%;
            margin-top: 0.5rem;
        }
    }

@media (min-width: 576px) {
        .room-card, .reserva-card {
            max-width: 100%;
        }
    }
    /* Estilos responsive */
    @media (max-width: 767.98px) {
        .header {
            padding: 0.8rem;
        }
        
        .header-input {
            width: 100% !important;
            margin-right: 0 !important;
        }
        
        .header-input input {
            font-size: 0.9rem;
            padding: 0.25rem 0.5rem;
        }
        
        .header-input .btn {
            padding: 0.25rem 0.5rem;
        }
        
        .date-range-input span {
            display: none;
        }
    }
    
    @media (min-width: 768px) {
        .header h1 {
            font-size: 2rem;
        }
        
        .header-input {
            min-width: 250px;
        }
    }
    @media (min-width: 992px) {
        .main-container {
            flex-direction: row;
        }
        
        .sidebar {
            flex: 1;
            position: sticky;
            top: 20px;
            height: fit-content;
        }
        
        .habitaciones-container,
        .reservas-container {
            flex: 3;
        }
    }
    </style>
    
</head>
<body style="background-color: #FFC107;">
    

<div id="apartado1" style="    width: 100%;
    height: 100%;
    background-color: #FFC107;">
<div class="bg-light">
    <header class="header d-flex justify-content-between align-items-center">
        <h1><a href="/" style="text-decoration: none; color:black;">Hotel Truck</a></h1>
        <div class="d-flex align-items-center bg-white header-input mr-2 me-2">
                    <input type="text" class="form-control border-0" id="inputBuscarReserva2" placeholder="Buscar reserva (Número de reserva)">
                    <button id="btnBuscarReserva2" class="btn text-warning ml-2"><i class="fas fa-search"></i></button>
                </div>
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
    <header class="header d-flex flex-column flex-md-row justify-content-between align-items-center p-2 p-md-3">
    <h1 class="mb-2 mb-md-0"><a href="/" style="text-decoration: none; color:black;">Hotel Truck</a></h1>
    <div class="d-flex flex-column flex-md-row align-items-center w-100 w-md-auto">
        <div class="d-flex align-items-center bg-white header-input mb-2 mb-md-0 me-md-2 w-100">
            <input type="text" class="form-control border-0" id="inputBuscarReserva" placeholder="Buscar reserva">
            <button id="btnBuscarReserva" class="btn text-warning"><i class="fas fa-search"></i></button>
        </div>
        <div class="d-flex align-items-center bg-white header-input mb-2 mb-md-0 me-md-2 w-100">
            <input type="text" class="form-control border-0" id="checkinbus" placeholder="DD-MM-YYYY">
            <span class="mx-md-2">→</span>
            <input type="text" class="form-control border-0" id="checkoutbus" placeholder="DD-MM-YYYY">
            <button id="btnBuscarHeader" class="btn text-warning"><i class="fas fa-search"></i></button>
        </div>
        <button disabled class="btn btn-light d-flex align-items-center ms-md-2">MXN</button>
    </div>
</header>
        
        <!-- Contenedor principal para las dos columnas -->
        <div class="main-container">
            <!-- Columna izquierda: Tarjetas de habitaciones -->
            <div class="habitaciones-container" id="habitacionesContainer">
                <!-- Aquí se mostrarán las habitaciones disponibles -->

            </div>
            <div id="contenedorReservas" class="reservas-container" style="display: none;">
    <!-- Botón de Volver -->
    <button id="btnVolver2" class="btn btn-link text-decoration-none text-dark fs-4 me-2">
        <i class="fas fa-arrow-left"> <p>Volver</p></i>
    </button>
    <!-- Aquí se mostrarán las reservas -->
</div>
            <div id="apartado3" class="form-container w-100" style="max-width: 600px; display: none;margin: 0 auto;">
        <div class="d-flex align-items-center mb-4">
            <button id="btnVolver" class="btn btn-link text-decoration-none text-dark fs-4 me-2">
                <i class="fas fa-arrow-left"></i>
            </button>
            <h1 class="h4 mb-0">Agregar huésped</h1>
        </div>
        <p class="text-muted mb-4">Agregue información</p>
        <form>
            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" class="form-control" id="nombre" required>
                </div>
                <div class="col-md-6">
                    <label for="apellido" class="form-label">Apellido *</label>
                    <input type="text" class="form-control" id="apellido" required>
                </div>
            </div>
            <h2 class="h6 mb-4">Más datos de la dirección</h2>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion">
            </div>
            <div class="mb-3">
                <label for="apartamento" class="form-label">Apartamento, suite, piso, etc.</label>
                <input type="text" class="form-control" id="apartamento">
            </div>
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="pais" class="form-label">País *</label>
                    <select class="form-select" id="pais" required>
                        <option selected>Seleccione un país</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado">
                        <option selected>Seleccione un estado</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="ciudad" class="form-label">Ciudad</label>
                    <select class="form-select" id="ciudad">
                        <option selected>Seleccione una ciudad</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="zip" class="form-label">ZIP / Código postal</label>
                    <input type="text" class="form-control" id="zip">
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico *</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono *</label>
                <input type="tel" class="form-control" id="telefono" required>
            </div>
        </form>
    </div>
            <!-- Columna derecha: Sección fija -->
            <div class="sidebar">
                <div id="mensajeSinAlojamientos" class="card text-center p-3">
                    <i class="bi bi-bed fs-1"></i>
                    <p>No se han agregado alojamientos</p>
                </div>
                <div id="btnCancelarTodos" class="card text-center p-3" style="display:none;">
        <button class="btn btn-danger" onclick="enviarCodigoCancelacion('${reservas[0].numero_reserva}')">Cancelar todas las reservas</button>
        <p>Nota: Solo puede cancelar una habitación con la opción "Cancelar Reserva"</p>
    </div>
    <div id="anticipoImg" class="card text-center p-3" style="display:none;">
    <p>Por favor proporcione la imagen del comprobante de pago del anticipo (200 MNX)</p>
    <input type="file" class="form-control"  name="imgAnticipo" accept="image/*">
    <div id="uploadStatus" class="mt-2 small"></div>
    </div>

                <div id="resumenReserva" class="card shadow p-4" style="display: none;">
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
    <!-- Botón "Reservar ahora" -->
    <button id="btnReservarAhora" class="btn btn-custom btn-block mb-4">Reservar ahora</button>
    <!-- Botón "Continuar" (oculto inicialmente) -->
    <button id="btnContinuar" class="btn btn-custom btn-block mb-4" style="display: none;">Continuar</button>
</div>
            </div>
        </div>
        <!-- Modal de Confirmación -->
<div class="modal fade" id="confirmacionModal" tabindex="-1" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmacionModalLabel">Confirmar Búsqueda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas realizar una nueva búsqueda? Esto eliminará los alojamientos agregados.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-warning" id="confirmarBusqueda">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<!-- Spinner de carga -->
<div id="loadingSpinner" class="d-none">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
</div>
    </div>
    <!-- Modal de reserva exitosa -->
<div class="modal fade" id="reservaExitosaModal" tabindex="-1" aria-labelledby="reservaExitosaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservaExitosaModalLabel">Reserva Exitosa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>La reserva se ha creado correctamente.</p>
                <p>Por favor proporcione el ticket de pago, en la seccion de buscar reserva</p>
                <p>Se ha enviado un PDF con los detalles de la reserva al correo proporcionado.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="aceptarReserva">Cerrar</button>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
// Configuración de event listeners mejorada
document.getElementById('btnBuscarReserva').addEventListener('click', function() {
    buscarPorCampo('inputBuscarReserva');
});

document.getElementById('btnBuscarReserva2').addEventListener('click', function() {
    buscarPorCampo('inputBuscarReserva2');
});

// Función genérica para buscar por cualquier campo
function buscarPorCampo(inputId) {
    const input = document.getElementById(inputId);
    const numeroReserva = input.value.trim();
    
    if (!numeroReserva) {
        Swal.fire({
            icon: 'error',
            title: 'Campo vacío',
            text: `Por favor ingresa un número de reserva en el campo ${inputId === 'inputBuscarReserva' ? 'primero' : 'segundo'}`
        });
        input.focus();
        return;
    }
    
    buscarReserva(numeroReserva).then(() => {
        input.value = ''; // Limpiar el campo después de buscar
    });
}

// Función mejorada de búsqueda con diagnóstico
function buscarReserva(numeroReserva) {
    console.log(`Buscando reserva: ${numeroReserva}`); // Debug
    
    return fetch(`/api/reservas/${numeroReserva}`)
        .then(response => {
            console.log('Respuesta recibida:', response); // Debug
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Error en respuesta:', text); // Debug
                    throw new Error(`Error ${response.status}: ${text}`);
                });
            }
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new TypeError("La respuesta no es JSON");
            }
            return response.json();
        })
        .then(data => {
            console.log('Datos recibidos:', data); // Debug
            if (!data || (Array.isArray(data) && data.length === 0)) {
                throw new Error('No se encontraron reservas con ese número');
            }
            mostrarReserva(data);
            return data;
        })
        .catch(error => {
            console.error('Error completo:', error); // Debug
            Swal.fire({
                icon: 'error',
                title: 'Error en búsqueda',
                text: error.message || 'No se pudo completar la búsqueda'
            });
            throw error;
        });
}

async function mostrarReserva(reservas) {
    document.getElementById('apartado1').style.display = 'none';
    document.getElementById('apartado2').style.display = 'block';
    document.getElementById('resumenReserva').style.display = 'none';
    document.getElementById('anticipoImg').style.display = 'block';

    const contenedorReservas = document.getElementById('contenedorReservas');
    const habitacionesContainer = document.getElementById('habitacionesContainer');
    const mensajeSinAlojamientos = document.getElementById('mensajeSinAlojamientos');
    const btnCancelarTodos = document.getElementById('btnCancelarTodos');

    const inputImagen = document.querySelector('input[name="imgAnticipo"]');
    inputImagen.onchange = function(e) {
        subirComprobantePago(e.target.files[0], reserva.numeroReserva);
    };
        // Verificar si los elementos existen antes de manipularlos
        if (!contenedorReservas || !habitacionesContainer || !mensajeSinAlojamientos || !btnCancelarTodos) {
        console.error('Uno o más elementos no se encontraron en el DOM.');
        console.log('btnCancelarTodos', btnCancelarTodos);
 
        console.log('contenerdorReservas', contenedorReservas);
        console.log('habitacionesContainer', habitacionesContainer);
        console.log('mensajeSinAlojamientos', mensajeSinAlojamientos);
        return;
    }
    // Ocultar el contenedor de habitaciones y el mensaje de "Sin alojamientos"
    habitacionesContainer.style.display = 'none';
    mensajeSinAlojamientos.style.display = 'none';

    // Mostrar el contenedor de reservas
    contenedorReservas.style.display = 'block';

    // Limpiar el contenedor de reservas antes de agregar nuevas cards
    contenedorReservas.innerHTML = '';

    // Verificar si hay reservas
    if (!reservas || reservas.length === 0) {
        contenedorReservas.innerHTML = '<p class="text-danger">Reserva no encontrada.</p>';
        btnCancelarTodos.style.display = 'none'; // Ocultar el botón si no hay reservas
        return;
    }

    // Verificar si todas las reservas están canceladas
    const todasCanceladas = reservas.every(reserva => reserva.estado === 'Cancelado');
    const UnoCancelado = reservas.some(reserva => reserva.estado === 'Cancelado');

    // Mostrar el botón "Cancelar todas las reservas"
    btnCancelarTodos.style.display = 'block';



    // Deshabilitar el botón si todas las reservas están canceladas
    if (todasCanceladas) {
        btnCancelarTodos.querySelector('button').disabled = true;
        btnCancelarTodos.querySelector('button').classList.add('disabled');
        btnCancelarTodos.querySelector('button').textContent = 'Todas las reservas canceladas';
    } else {
        btnCancelarTodos.querySelector('button').disabled = false;
        btnCancelarTodos.querySelector('button').classList.remove('disabled');
        btnCancelarTodos.querySelector('button').textContent = 'Cancelar todas las reservas';
        btnCancelarTodos.querySelector('button').onclick = () => enviarCodigoCancelacion(reservas[0].numero_reserva);
    }

    // Agregar el botón de "Volver" al contenedor de reservas
    const botonVolver = `
        <button id="btnVolver2" class="btn btn-link text-decoration-none text-dark fs-4 me-2">
            <i class="fas fa-arrow-left"></i>
        </button>
    `;
    contenedorReservas.innerHTML += botonVolver;

    // Iterar sobre cada reserva y crear una card
    reservas.forEach(reserva => {
        const reservaCancelada = reserva.estado === 'Cancelado';

        // Crear la card con los datos de la reserva
        const card = `
            <div class="col-md-8">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title">Reserva #${reserva.numero_reserva}</h5>
                                <div class="row">
                                    <!-- Columna 1: Tipo de cuarto, cantidad de cuartos, cantidad de huéspedes -->
                                    <div class="col-md-6">
                                        <p><strong>Tipo de cuarto:</strong> ${reserva.tipo_cuarto}</p>
                                        <p><strong>Cantidad de cuartos:</strong> ${reserva.cantidad_cuartos}</p>
                                        <p><strong>Cantidad de huéspedes:</strong> ${reserva.cantidad_huespedes}</p>
                                    </div>
                                    <!-- Columna 2: Fecha de entrada, fecha de salida, cantidad de noches -->
                                    <div class="col-md-6">
                                        <p><strong>Fecha de entrada:</strong> ${reserva.fecha_entrada}</p>
                                        <p><strong>Fecha de salida:</strong> ${reserva.fecha_salida}</p>
                                        <p><strong>Cantidad de noches:</strong> ${reserva.cantidad_noches}</p>
                                    </div>
                                </div>
                                <!-- Información adicional -->
                                <p><strong>Subtotal:</strong> MXN ${reserva.subtotal}</p>
                                <p><strong>Estado:</strong> ${reserva.estado}</p>
                                <p><strong>Número de cuarto:</strong> ${reserva.numero_cuarto}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="CancelarUno btn btn-danger ${reservaCancelada ? 'disabled' : ''}" 
                                onclick="${reservaCancelada ? '' : `cancelarReserva('${reserva.numero_reserva}', ${reserva.id}, this)`}" 
                                ${reservaCancelada ? 'disabled' : ''}>
                            ${reservaCancelada ? 'Reserva Cancelada' : 'Cancelar Reserva'}
                        </button>
                    </div>
                </div><br>
            </div>
        `;
        contenedorReservas.innerHTML += card;
    });
    const btnCancelarUno = document.querySelectorAll('.CancelarUno');


    if (UnoCancelado) {
        btnCancelarUno.forEach(boton => {
            boton.disabled = true;
            boton.classList.add('disabled');
            // boton.textContent = 'Cancelar Reserva';
        });
    }


    // Agregar el evento de clic al botón de "Volver"
    document.getElementById('btnVolver2').addEventListener('click', function () {
        // Ocultar el contenedor de reservas
        contenedorReservas.style.display = 'none';

        // Mostrar el contenedor de habitaciones y el mensaje de "Sin alojamientos"
        habitacionesContainer.style.display = 'block';
        if (reservas && reservas.length > 0) {
                // Mostrar las reservas en el resumen
                    document.getElementById('resumenReserva').style.display = 'block';
                    document.getElementById('anticipoImg').style.display = 'none';

            } else {
                // Mostrar mensaje de "Sin reservas"
                mensajeSinAlojamientos.style.display = 'block';
            }

        // Ocultar el botón "Cancelar todas las reservas"
        btnCancelarTodos.style.display = 'none';
        // Limpiar el campo de búsqueda
        document.getElementById('inputBuscarReserva').value = '';
    });

    document.getElementById('anticipoImg').style.display = 'block';
    const tieneComprobante = await verificarYMostrarComprobante(reservas[0].numero_reserva);
    
    // Configurar input solo si no hay comprobante
    if (!tieneComprobante) {
        const inputFile = document.querySelector('input[name="imgAnticipo"]');
        inputFile.onchange = (e) => manejarSubidaComprobante(e, reservas[0].numero_reserva);
    }   
}


// Definir el input al inicio del código
const inputImagen = document.querySelector('input[name="imgAnticipo"]');

// Función unificada para manejar comprobantes
async function verificarYMostrarComprobante(numeroReserva) {
    const uploadStatus = document.getElementById('uploadStatus');
    const btnActualizar = document.createElement('button');
    
    try {
        // Limpiar estado anterior
        uploadStatus.innerHTML = '';
        document.querySelectorAll('.comprobante-preview').forEach(el => el.remove());
        
        // Obtener datos del comprobante
        const response = await fetch(`/api/pagos/comprobante/${numeroReserva}`);
        
        if (!response.ok) {
            const errorData = await response.json().catch(() => null);
            const errorMsg = errorData?.message || 'Error al verificar el comprobante';
            throw new Error(errorMsg);
        }
        
        const data = await response.json();
        
        if (data.success && data.comprobante) {
            // Mostrar vista previa del comprobante existente
            const previewHTML = `
                <div class="comprobante-preview mt-3">
                    <div class="card">
                        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-check-circle"></i> Comprobante existente</span>
                            <button id="btnActualizarComprobante" class="btn btn-sm btn-warning">
                                <i class="fas fa-sync-alt"></i> Actualizar
                            </button>
                        </div>
                        <div class="card-body text-center">
                            <img src="${data.comprobante.url}" 
                                 class="img-thumbnail mb-2" 
                                 style="max-height: 200px; cursor: pointer"
                                 onclick="ampliarImagen('${data.comprobante.url}')">
                            <p class="mb-1"><strong>Estado:</strong> ${data.comprobante.estado}</p>
                        </div>
                    </div>
                </div>
            `;
            uploadStatus.insertAdjacentHTML('beforeend', previewHTML);
            
            // Configurar botón de actualización
            document.getElementById('btnActualizarComprobante').addEventListener('click', () => {
                inputImagen.disabled = false;
                inputImagen.click(); // Abrir el selector de archivos
            });
            
            // Configurar input para permitir actualización
            inputImagen.onchange = (e) => manejarSubidaComprobante(e, numeroReserva);
            inputImagen.disabled = false;
            inputImagen.value = ''; // Limpiar el input
            
            return true;
        } else {
            // Mostrar mensaje para subir nuevo comprobante
            uploadStatus.innerHTML = `
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle"></i> Por favor suba el comprobante de pago
                </div>
            `;
            
            // Configurar input para nuevo comprobante
            inputImagen.onchange = (e) => manejarSubidaComprobante(e, numeroReserva);
            inputImagen.disabled = false;
            
            return false;
        }
    } catch (error) {
        console.error('Error al verificar comprobante:', error);
        uploadStatus.innerHTML = `
            <div class="alert alert-danger mt-3">
                <i class="fas fa-exclamation-triangle"></i> ${error.message}
            </div>
        `;
        
        // Configurar input para nuevo comprobante en caso de error
        inputImagen.onchange = (e) => manejarSubidaComprobante(e, numeroReserva);
        inputImagen.disabled = false;
        
        return false;
    }
}

// Función para manejar la subida/actualización de comprobantes
async function manejarSubidaComprobante(event, numeroReserva) {
    const file = event.target.files[0];
    const uploadStatus = document.getElementById('uploadStatus');
    
    if (!file) return;
    
    // Validaciones
    if (!file.type.match('image.*')) {
        uploadStatus.innerHTML = crearAlerta('Formato no válido', 'Solo imágenes JPEG, PNG o JPG', 'danger');
        return;
    }
    
    if (file.size > 2 * 1024 * 1024) {
        uploadStatus.innerHTML = crearAlerta('Archivo muy grande', 'El tamaño máximo es 2MB', 'danger');
        return;
    }
    
    // Mostrar vista previa temporal
    const previewURL = URL.createObjectURL(file);
    const previewHTML = `
        <div class="comprobante-preview-temp mt-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-upload"></i> Nuevo comprobante
                </div>
                <div class="card-body text-center">
                    <img src="${previewURL}" class="img-thumbnail" style="max-height: 150px;">
                    <p class="small text-muted mt-2">${file.name}</p>
                    <button id="btnConfirmarSubida" class="btn btn-success mt-2">
                        <i class="fas fa-check"></i> Confirmar actualización
                    </button>
                    <button id="btnCancelarSubida" class="btn btn-danger mt-2 ml-2">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </div>
            </div>
        </div>
    `;
    
    // Limpiar previas y mostrar nueva vista previa
    document.querySelectorAll('.comprobante-preview, .comprobante-preview-temp').forEach(el => el.remove());
    uploadStatus.insertAdjacentHTML('beforeend', previewHTML);
    
    // Configurar botones de confirmación
    document.getElementById('btnConfirmarSubida').addEventListener('click', async () => {
        await subirComprobantePago(file, numeroReserva);
    });
    
    document.getElementById('btnCancelarSubida').addEventListener('click', () => {
        document.querySelector('.comprobante-preview-temp').remove();
        inputImagen.value = '';
        verificarYMostrarComprobante(numeroReserva); // Volver a mostrar el estado actual
    });
}

// Función para subir/actualizar el comprobante
async function subirComprobantePago(archivo, numeroReserva) {
    const formData = new FormData();
    formData.append('comprobante', archivo);
    formData.append('numero_reserva', numeroReserva);
    formData.append('monto', '200');
    formData.append('_method', 'PUT'); // Para actualización

    Swal.fire({
        title: 'Procesando comprobante...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    try {
        const response = await fetch(`/api/pagos/${numeroReserva}`, {
            method: 'POST', // Usamos POST pero con _method=PUT
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Error al actualizar el comprobante');
        }

        Swal.fire({
            icon: 'success',
            title: '¡Comprobante actualizado!',
            text: 'El comprobante se ha actualizado correctamente',
            timer: 2000,
            showConfirmButton: false
        });

        // Volver a cargar la vista del comprobante
        verificarYMostrarComprobante(numeroReserva);

    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'Error al actualizar el comprobante'
        });
        console.error('Error:', error);
    }
}

// Función auxiliar para crear alertas
function crearAlerta(titulo, mensaje, tipo) {
    return `
        <div class="alert alert-${tipo} mt-3">
            <strong>${titulo}:</strong> ${mensaje}
        </div>
    `;
}

// Función para ampliar imagen
function ampliarImagen(url) {
    Swal.fire({
        imageUrl: url,
        imageAlt: 'Comprobante de pago',
        showConfirmButton: false,
        background: 'transparent',
        backdrop: `rgba(0,0,0,0.8)`,
        showCloseButton: true
    });
}

// Función para mostrar el comprobante existente
async function mostrarComprobanteExistente(numeroReserva) {
    const uploadStatus = document.getElementById('uploadStatus');
    const inputFile = document.querySelector('input[name="imgAnticipo"]');
    
    try {
        // Limpiar estado anterior
        uploadStatus.innerHTML = '';
        document.querySelectorAll('.comprobante-preview').forEach(el => el.remove());
        
        // Obtener datos del comprobante
        const response = await fetch(`comprobantes/${numeroReserva}`);
        const data = await response.json();
        
        if (data.success && data.comprobante) {
            // Mostrar vista previa
            const previewHTML = `
                <div class="comprobante-preview mt-3">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <i class="fas fa-check-circle"></i> Comprobante ya subido
                        </div>
                        <div class="card-body text-center">
                            <img src="${data.comprobante.url}" 
                                 class="img-thumbnail mb-2" 
                                 style="max-height: 200px; cursor: pointer"
                                 onclick="ampliarImagen('${data.comprobante.url}')">
                            <p class="mb-1"><strong>Estado:</strong> ${data.comprobante.estado}</p>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('anticipoImg').insertAdjacentHTML('beforeend', previewHTML);
            
            // Deshabilitar input de subida
            inputFile.disabled = true;
            return true;
        } else {
            // Mostrar mensaje para subir nuevo comprobante
            uploadStatus.innerHTML = `
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle"></i> Por favor suba el comprobante de pago
                </div>
            `;
            return false;
        }
    } catch (error) {
        console.error('Error:', error);
        uploadStatus.innerHTML = `
            <div class="alert alert-warning mt-3">
                <i class="fas fa-exclamation-triangle"></i> No se pudo verificar el comprobante
            </div>
        `;
        return false;
    }
}

inputImagen.onchange = function(e) {
        if (e.target.files && e.target.files[0]) {
            // Validar el archivo antes de subir
            const file = e.target.files[0];
            if (!file.type.match('image.*')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Formato no válido',
                    text: 'Por favor sube una imagen (JPEG, PNG, JPG)'
                });
                return;
            }
            
            if (file.size > 2 * 1024 * 1024) { // 2MB máximo
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo muy grande',
                    text: 'El tamaño máximo permitido es 2MB'
                });
                return;
            }
            
            // Mostrar vista previa
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.createElement('div');
                preview.innerHTML = `
                    <div class="mt-3">
                        <img src="${event.target.result}" class="img-thumbnail" style="max-height: 150px;">
                        <p class="text-muted small mt-1">${file.name}</p>
                    </div>
                `;
                document.getElementById('anticipoImg').appendChild(preview);
            };
            reader.readAsDataURL(file);
            
            // Subir el comprobante automáticamente
            subirComprobantePago(file, reservas[0].numero_reserva);
        }
    };



function enviarCodigoCancelacion(numeroReserva) {
    fetch('/reservas/cancelar-todas', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ numero_reserva: numeroReserva }),
    })
    .then(response => response.json())
    .then(data => {
    // Mostrar SweetAlert para ingresar el código
    Swal.fire({
        title: 'Código de cancelación',
        text: data.mensaje,
        input: 'text',
        inputPlaceholder: 'Ingresa el código que recibiste en tu correo',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Validar código',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: (codigo) => {
            if (!codigo) {
                Swal.showValidationMessage('El código es requerido');
            }
            return codigo;
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            validarCodigoYCancelar(numeroReserva, result.value);
        }
    });
})
    .catch(error => {
        console.error('Error al enviar el código de cancelación:', error);
    });
}
function validarCodigoYCancelar(numeroReserva, codigo) {
    fetch('/reservas/validar-codigo', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ numero_reserva: numeroReserva, codigo: codigo }),
    })
    .then(response => {
        // Verificar primero si la respuesta es OK
        if (!response.ok) {
            return response.text().then(text => {
                throw new Error(`Error ${response.status}: ${text}`);
            });
        }
        
        // Verificar que la respuesta sea JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new TypeError("La respuesta no es JSON");
        }
        
        return response.json();
    })
    .then(data => {
        if (data.success || data.mensaje === 'Todas las reservas han sido canceladas correctamente.') {
            // Actualizar la vista primero
            return buscarReserva(numeroReserva).then(() => {
                // Mostrar mensaje de éxito
                return Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: data.mensaje,
                });
            }).then(() => {
                // Actualizar botones
                const btnCancelarTodos = document.getElementById('btnCancelarTodos');
                if (btnCancelarTodos) {
                    btnCancelarTodos.querySelector('button').disabled = true;
                    btnCancelarTodos.querySelector('button').classList.add('disabled');
                    btnCancelarTodos.querySelector('button').textContent = 'Todas las reservas canceladas';
                }
                
                // Deshabilitar todos los botones individuales
                document.querySelectorAll('.CancelarUno').forEach(boton => {
                    boton.disabled = true;
                    boton.textContent = 'Reserva Cancelada';
                });
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.mensaje || 'Error desconocido al cancelar las reservas',
            });
        }
    })
    .catch(error => {
        console.error('Error al validar el código:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message.includes('JSON') 
                ? 'Error en el formato de la respuesta del servidor' 
                : error.message,
        });
    });
}
function deshabilitarBotonesCancelacion(numeroReserva) {
    // Seleccionar todos los botones de cancelación dentro de las cards de reserva
    const botonesCancelacion = document.querySelectorAll(`button[onclick*="cancelarReserva('${numeroReserva}'"]`);

    // Deshabilitar cada botón
    botonesCancelacion.forEach(boton => {
        boton.disabled = true;
        boton.classList.add('disabled'); // Opcional: agregar una clase CSS para estilo
        boton.textContent = 'Reserva Cancelada'; // Cambiar el texto del botón
    });
}

function cancelarReserva(numeroReserva, reservaId, boton) {
    // Obtener el token CSRF
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Hacer la solicitud POST para cancelar la reserva
    fetch(`/api/reservas/${reservaId}/cancelar`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token, // Incluir el token CSRF
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al cancelar la reserva');
        }
        return response.json();
    })
    .then(data => {
        alert(data.mensaje); // Mostrar mensaje de éxito
        // Deshabilitar el botón que se hizo clic y cambiar su texto
        boton.disabled = true;
        boton.classList.add('disabled');
        boton.textContent = 'Reserva Cancelada';

        // Deshabilitar todos los demás botones
        const btnCancelarUno = document.querySelectorAll('.CancelarUno');
        btnCancelarUno.forEach(btn => {
            if (btn !== boton && !btn.disabled) { // Solo deshabilitar los botones que no son el que se hizo clic
                btn.disabled = true;
                btn.classList.add('disabled');
                btn.textContent = 'Cancelar Reserva';
            }
        });
        buscarReserva(numeroReserva);
    })
    .catch(error => {
        console.error('Error al cancelar la reserva:', error);
        alert('Hubo un error al cancelar la reserva.');
    });
}
</script>
    <script>
        const GEONAMES_USERNAME = 'ismaelek'; // Reemplaza con tu nombre de usuario de GeoNames

        // Función para obtener países desde GeoNames
        async function obtenerPaises() {
            const url = `http://api.geonames.org/countryInfoJSON?username=${GEONAMES_USERNAME}`;
            try {
                const response = await fetch(url);
                const data = await response.json();
                const selectPais = document.getElementById('pais');
                data.geonames.forEach(pais => {
                    const option = document.createElement('option');
                    option.value = pais.countryName; // Usamos el nombre del país
                    option.textContent = pais.countryName;
                    selectPais.appendChild(option);
                });
            } catch (error) {
                console.error('Error al obtener países:', error);
            }
        }

        // Función para obtener estados/provincias usando GeoNames
        async function obtenerEstados(pais) {
            const url = `http://api.geonames.org/searchJSON?q=${pais}&maxRows=1000&username=${GEONAMES_USERNAME}&featureCode=ADM1`;
            try {
                const response = await fetch(url);
                const data = await response.json();
                const selectEstado = document.getElementById('estado');
                selectEstado.innerHTML = '<option selected>Seleccione un estado</option>';
                const estadosUnicos = new Set(); // Para evitar duplicados

                data.geonames.forEach(resultado => {
                    const estado = resultado.adminName1; // Nombre del estado
                    if (estado && !estadosUnicos.has(estado)) {
                        estadosUnicos.add(estado);
                        const option = document.createElement('option');
                        option.value = estado;
                        option.textContent = estado;
                        selectEstado.appendChild(option);
                    }
                });

                if (estadosUnicos.size === 0) {
                    console.warn(`No se encontraron estados para el país: ${pais}`);
                    selectEstado.innerHTML = '<option selected>No se encontraron estados</option>';
                }
            } catch (error) {
                console.error('Error al obtener estados:', error);
                const selectEstado = document.getElementById('estado');
                selectEstado.innerHTML = '<option selected>Error al cargar estados</option>';
            }
        }

        // Función para obtener ciudades usando GeoNames
        async function obtenerCiudades(estado) {
            const url = `http://api.geonames.org/searchJSON?q=${estado}&maxRows=1000&username=${GEONAMES_USERNAME}&featureCode=PPL`;
            try {
                const response = await fetch(url);
                const data = await response.json();
                const selectCiudad = document.getElementById('ciudad');
                selectCiudad.innerHTML = '<option selected>Seleccione una ciudad</option>';
                const ciudadesUnicas = new Set(); // Para evitar duplicados

                data.geonames.forEach(resultado => {
                    const ciudad = resultado.name; // Nombre de la ciudad
                    if (ciudad && !ciudadesUnicas.has(ciudad)) {
                        ciudadesUnicas.add(ciudad);
                        const option = document.createElement('option');
                        option.value = ciudad;
                        option.textContent = ciudad;
                        selectCiudad.appendChild(option);
                    }
                });

                if (ciudadesUnicas.size === 0) {
                    console.warn(`No se encontraron ciudades para el estado: ${estado}`);
                    selectCiudad.innerHTML = '<option selected>No se encontraron ciudades</option>';
                }
            } catch (error) {
                console.error('Error al obtener ciudades:', error);
                const selectCiudad = document.getElementById('ciudad');
                selectCiudad.innerHTML = '<option selected>Error al cargar ciudades</option>';
            }
        }

        // Evento para cargar países al cargar la página
        document.addEventListener('DOMContentLoaded', obtenerPaises);

        // Evento para cargar estados cuando se selecciona un país
        document.getElementById('pais').addEventListener('change', function() {
            const pais = this.value;
            obtenerEstados(pais);
        });

        // Evento para cargar ciudades cuando se selecciona un estado
        document.getElementById('estado').addEventListener('change', function() {
            const estado = this.value;
            obtenerCiudades(estado);
        });
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Evento para el botón de búsqueda del segundo apartado
    document.getElementById('btnBuscarHeader').addEventListener('click', function() {
        const checkin = document.getElementById('checkinbus').value;
        const checkout = document.getElementById('checkoutbus').value;

        if (!checkin || !checkout) {
            alert('Por favor, seleccione ambas fechas.');
            return;
        }

        const formularioHuespedes = document.getElementById('apartado3');
        if (formularioHuespedes.style.display === 'block') {
            // Ocultar el formulario de huéspedes
            formularioHuespedes.style.display = 'none';

            // Mostrar todas las tarjetas de habitaciones
            const tarjetasHabitaciones = document.querySelectorAll('#habitacionesContainer .card');
            tarjetasHabitaciones.forEach(tarjeta => {
                tarjeta.style.display = 'block';
            });
        }

        // Restablecer los botones de reserva
        document.getElementById('btnReservarAhora').style.display = 'block';
        document.getElementById('btnContinuar').style.display = 'none';

        // Verificar si hay alojamientos agregados
        const resumenReserva = document.getElementById('resumenReserva');
        const hayAlojamientos = resumenReserva.style.display !== 'none';

        if (hayAlojamientos) {
            // Mostrar el modal de confirmación
            const confirmacionModal = new bootstrap.Modal(document.getElementById('confirmacionModal'));
            confirmacionModal.show();

            document.getElementById('confirmarBusqueda').addEventListener('click', function() {
    // Ocultar el modal
    confirmacionModal.hide();

    // Limpiar completamente el resumen de la reserva
    const resumenReserva = document.getElementById('resumenReserva');
    const mensajeSinAlojamientos = document.getElementById('mensajeSinAlojamientos');

    // Seleccionar solo los elementos con la clase 'habitacion-agregada'
    const elementosAEliminar = resumenReserva.querySelectorAll('.habitacion-agregada');

    // Eliminar todos los elementos seleccionados
    elementosAEliminar.forEach(elemento => elemento.remove());

    // Ocultar el resumen y mostrar el mensaje de "No se han agregado alojamientos"
    resumenReserva.style.display = 'none';
    mensajeSinAlojamientos.style.display = 'block';

    // Restablecer los totales
    actualizarTotales();

    // Limpiar las tarjetas de habitaciones
    const habitacionesContainer = document.getElementById('habitacionesContainer');
    habitacionesContainer.innerHTML = ''; // Limpiar el contenedor

    // Reiniciar el scroll del contenedor de habitaciones
    habitacionesContainer.scrollTop = 0;
  // Actualizar las fechas y el número de noches en el resumen
  actualizarResumenFechas(checkin, checkout);
    // Realizar la búsqueda con las nuevas fechas
    buscarHabitaciones(checkin, checkout);
});
        } else {
              // Actualizar las fechas y el número de noches en el resumen
              actualizarResumenFechas(checkin, checkout);
            // Si no hay alojamientos, realizar la búsqueda directamente
            buscarHabitaciones(checkin, checkout);
        }
    });
});
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Evento para el botón "Reservar ahora"
    document.getElementById('btnReservarAhora').addEventListener('click', function() {
        // Ocultar todas las tarjetas de habitaciones
        const tarjetasHabitaciones = document.getElementById('habitacionesContainer');

            tarjetasHabitaciones.style.display = 'none';


        // Mostrar el apartado 3 (formulario de huéspedes)
        document.getElementById('apartado3').style.display = 'block';

        // Ocultar el botón "Reservar ahora" y mostrar el botón "Continuar"
        document.getElementById('btnReservarAhora').style.display = 'none';
        document.getElementById('btnContinuar').style.display = 'block';
    });

    // Evento para el botón "Volver"
    document.getElementById('btnVolver').addEventListener('click', function() {
        // Ocultar el apartado 3
        document.getElementById('apartado3').style.display = 'none';

        // Mostrar todas las tarjetas de habitaciones
        const tarjetasHabitaciones = document.querySelectorAll('#habitacionesContainer .card');
        tarjetasHabitaciones.forEach(tarjeta => {
            tarjeta.style.display = 'block';
        });
        // Ocultar el botón "Continuar" y mostrar el botón "Reservar ahora"
        document.getElementById('btnContinuar').style.display = 'none';
        document.getElementById('btnReservarAhora').style.display = 'block';
    });
});
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        // Función para verificar si no hay reservas y mostrar las tarjetas de habitaciones
        function verificarReservas() {
            const resumenReserva = document.getElementById('resumenReserva');
            const registros = resumenReserva.querySelectorAll('.d-flex.justify-content-between.align-items-center.mb-2 span:nth-child(2)');

            if (registros.length === 1) {
                // Si no hay registros, mostrar el mensaje y ocultar el resumen
                document.getElementById('mensajeSinAlojamientos').style.display = 'block';
                resumenReserva.style.display = 'none';

                // Ocultar el formulario de huéspedes y mostrar las tarjetas de habitaciones
                document.getElementById('apartado3').style.display = 'none';
                const tarjetasHabitaciones = document.querySelectorAll('#habitacionesContainer .card');
                tarjetasHabitaciones.forEach(tarjeta => {
                    tarjeta.style.display = 'block';
                });
            }
        }

        // Modificar la función eliminarHabitacion para llamar a verificarReservas
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

            // Actualizar el texto de la cantidad disponible
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
            verificarReservas();
        }
    });
</script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
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
        onChange: function (selectedDates, dateStr) {
            document.getElementById('checkinbus').value = dateStr; // Actualizar el input de fecha en el header
        },
    });

    flatpickr("#checkout", {
        dateFormat: "d-m-Y", // Formato de fecha
        minDate: "today", // Fecha mínima: hoy
        locale: "es", // Idioma español
        onChange: function (selectedDates, dateStr) {
            document.getElementById('checkoutbus').value = dateStr; // Actualizar el input de fecha en el header
        },
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
    document.getElementById('btnBuscar').addEventListener('click', function () {
        const checkin = document.getElementById('checkin').value;
        const checkout = document.getElementById('checkout').value;

        if (!checkin || !checkout) {
            Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, seleccione ambas fechas.',
            toast: true, // Mostrar como toast
            position: 'top-end', // Esquina superior derecha
            showConfirmButton: false,
            timer: 3000, // Duración del popup en milisegundos
            timerProgressBar: true,
        });
        return; // Detener la ejecución si las fechas no son válidas
        }

        // Copiar las fechas al segundo apartado
        document.getElementById('checkinbus').value = checkin;
        document.getElementById('checkoutbus').value = checkout;
        actualizarResumenFechas(checkin, checkout);

        // Realizar la búsqueda inicial
        buscarHabitaciones(checkin, checkout);
    });
});

// Función para buscar habitaciones
// Función para buscar habitaciones
function buscarHabitaciones(checkin, checkout) {
    const checkinDate = moment(checkin, 'D-M-YYYY');
    const checkoutDate = moment(checkout, 'D-M-YYYY');

    // Validar que las fechas sean válidas
    if (!checkinDate.isValid() || !checkoutDate.isValid()) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Las fechas ingresadas no son válidas.',
            toast: true, // Mostrar como toast
            position: 'top-end', // Esquina superior derecha
            showConfirmButton: false,
            timer: 3000, // Duración del popup en milisegundos
            timerProgressBar: true,
        });
        return; // Detener la ejecución si las fechas no son válidas
    }

    // Calcular la diferencia en días
    const noches = checkoutDate.diff(checkinDate, 'days');

    // Validar que la fecha de salida sea posterior a la fecha de llegada
    if (noches <= 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La fecha de salida debe ser posterior a la fecha de llegada.',
            toast: true, // Mostrar como toast
            position: 'top-end', // Esquina superior derecha
            showConfirmButton: false,
            timer: 3000, // Duración del popup en milisegundos
            timerProgressBar: true,
        });
        return; // Detener la ejecución si las fechas no son válidas
    }

    // Si las fechas son válidas, mostrar el apartado2
    document.getElementById('apartado1').style.display = 'none';
    document.getElementById('apartado2').style.display = 'block';

    // Simulación de una solicitud al servidor
    fetch(`/buscar-habitaciones?checkin=${checkin}&checkout=${checkout}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                mostrarHabitaciones(data.habitacionesPorTipo, noches);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al buscar habitaciones.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al procesar la solicitud.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        });
}
        // Función para mostrar las habitaciones
        function mostrarHabitaciones(habitacionesPorTipo, noches) {
            const habitacionesContainer = document.getElementById('habitacionesContainer');
            const contenedorReservas = document.getElementById('contenedorReservas');
    const mensajeSinAlojamientos = document.getElementById('mensajeSinAlojamientos');

    document.getElementById('btnCancelarTodos').style.display = 'none';
    document.getElementById('anticipoImg').style.display = 'none';


// Ocultar el contenedor de reservas
contenedorReservas.style.display = 'none';

// Mostrar el contenedor de habitaciones
habitacionesContainer.style.display = 'block';
mensajeSinAlojamientos.style.display = 'block';
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
                                            <p><i class="fas fa-bed"></i> ${habitacion.tipo_habitacion.numero_camas}</p>
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
<div class="d-flex align-items-center justify-content-between w-100">
    <button class="btn btn-outline-secondary flex-shrink-0" onclick="cambiarCantidad(this, -1, ${cantidad_disponible})">-</button>
    <input type="text" class="form-control text-center flex-grow-1 cantidad-input-flex" value="1" readonly max="${cantidad_disponible}">
    <button class="btn btn-outline-secondary flex-shrink-0" onclick="cambiarCantidad(this, 1, ${cantidad_disponible})">+</button>
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

        function cambiarCantidad(button, cambio, cantidadDisponible) {
    const card = button.closest('.card');
    const cantidadInput = card.querySelector('input[type="text"]');
    let cantidad = parseInt(cantidadInput.value);
    const nuevaCantidad = cantidad + cambio;
    const maxCantidad = parseInt(cantidadInput.getAttribute('max'));
    // Validar que la cantidad no sea menor que 1 ni mayor que la cantidad disponible
    if (nuevaCantidad < 1) {
        alert('La cantidad mínima es 1.');
        return;
    }
    if (nuevaCantidad > maxCantidad) {
        alert(`No hay suficientes habitaciones disponibles. Solo quedan ${maxCantidad}.`);
        return;
    }

    // Actualizar el valor del input
    cantidadInput.value = nuevaCantidad;

    // Obtener el precio por noche
    const precioPorNoche = parseFloat(card.querySelector('.add-btn').getAttribute('data-precio'));

    // Calcular el nuevo precio total
    const precioTotal = nuevaCantidad * precioPorNoche;

    // Actualizar el precio total en la tarjeta
    const precioTotalElement = card.querySelector('h5.fw-bold');
    precioTotalElement.textContent = `MXN ${precioTotal.toFixed(2)}`;

    // Actualizar el botón "Añadir" con la nueva cantidad
    const addButton = card.querySelector('.add-btn');
    addButton.setAttribute('data-cantidad', nuevaCantidad);
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
        const subtotal = precioTotal * cantidad;

        agregarAlResumen(tipoHabitacion, precioTotal, noches, cantidad, maxPersonas,cantidadDisponible, index);
    }
}

function agregarAlResumen(tipoHabitacion, precioTotal, noches, cantidad, maxPersonas, cantidadDisponible, index) {
    const mensajeSinAlojamientos = document.getElementById('mensajeSinAlojamientos');
    const resumenReserva = document.getElementById('resumenReserva');

    // Ocultar el mensaje y mostrar el resumen
    mensajeSinAlojamientos.style.display = 'none';
    resumenReserva.style.display = 'block';
    const precioTotalReserva = precioTotal * cantidad;
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
        nuevaEntrada.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'mb-2', 'habitacion-agregada');
        nuevaEntrada.innerHTML = `
            <span>${cantidad}x ${tipoHabitacion}</span>
            <span>MXN ${precioTotalReserva.toFixed(2)}</span>
        `;

        const nuevaEntradaHuespedes = document.createElement('div');
        nuevaEntradaHuespedes.classList.add('d-flex', 'align-items-center', 'justify-content-between', 'mb-4', 'habitacion-agregada');
        nuevaEntradaHuespedes.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-user-friends"></i>
                <span class="ml-2 cantidad-huespedes" >${maxPersonas}</span>
            </div>
            <button class="btn btn-link text-danger p-0" onclick="eliminarHabitacion(this)">
                <i class="fas fa-trash-alt"></i>
            </button>
        `;

        // Crear un hr para separar las entradas
        const hr = document.createElement('hr');
        hr.classList.add('habitacion-agregada');

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
    const cantidadInput = card.querySelector('input[type="text"]');
    cantidadInput.setAttribute('max', nuevaCantidadDisponible);
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

    // Actualizar el texto de la cantidad disponible
    const cantidadDisponibleElement = card.querySelector(`#cantidad-disponible-${index}`);
    cantidadDisponibleElement.textContent = cantidadDisponible;
    const cantidadInput = card.querySelector('input[type="text"]');
    cantidadInput.setAttribute('max', cantidadDisponible);
    // Habilitar el botón si hay disponibilidad
    if (cantidadDisponible > 0) {
        addButton.disabled = false;
        addButton.textContent = 'Añadir';
        addButton.classList.remove('btn-secondary');
        addButton.classList.add('btn-warning');
    }

    // Verificar si no quedan registros
    const resumenReserva = document.getElementById('resumenReserva');
    const registros = resumenReserva.querySelectorAll('.d-flex.justify-content-between.align-items-center.mb-2 span:nth-child(2)');

    console.log("Registros restantes:", registros.length); // Depuración

    if (registros.length === 1) {
        // Si no hay registros, mostrar el mensaje y ocultar el resumen
        document.getElementById('mensajeSinAlojamientos').style.display = 'block';
        resumenReserva.style.display = 'none';

// Ocultar el formulario de huéspedes
document.getElementById('apartado3').style.display = 'none';

// Mostrar todas las tarjetas de habitaciones
const tarjetasHabitaciones = document.querySelectorAll('#habitacionesContainer .card');
tarjetasHabitaciones.forEach(tarjeta => {
    tarjeta.style.display = 'block';
});
        console.log("No hay registros. Mostrando mensaje."); // Depuración
    } else {
        // Si aún hay registros, actualizar los totales
        actualizarTotales();
        console.log("Aún hay registros. Actualizando totales."); // Depuración
    }
}
function actualizarTotales() {
    const resumenReserva = document.getElementById('resumenReserva');

    if (!resumenReserva) {
        console.error("El resumen de reserva no existe en el DOM.");
        return;
    }

    // Seleccionar solo los precios de las habitaciones
    const preciosElements = resumenReserva.querySelectorAll('.d-flex.justify-content-between.align-items-center.mb-2.habitacion-agregada span:nth-child(2)');

    const precios = Array.from(preciosElements).map(span => {
        const precioTexto = span.textContent.replace('MXN ', '').replace(/,/g, '');
        return parseFloat(precioTexto);
    });

    const subtotal = precios.reduce((sum, precio) => sum + precio, 0);
    const impuestos = subtotal * 0.16;
    const total = subtotal;
    const subtotal2 = subtotal- impuestos;

    // Actualizar los valores en el DOM
    const resumenSubtotal = document.getElementById('resumenSubtotal');
    const resumenImpuestos = document.getElementById('resumenImpuestos');
    const resumenTotal = document.getElementById('resumenTotal');
    const resumenDeposito = document.getElementById('resumenDeposito');

    if (resumenSubtotal) {
        resumenSubtotal.textContent = `MXN ${subtotal2.toLocaleString('es-MX', { minimumFractionDigits: 2 })}`;
    }
    if (resumenImpuestos) {
        resumenImpuestos.textContent = `MXN ${impuestos.toLocaleString('es-MX', { minimumFractionDigits: 2 })}`;
    }
    if (resumenTotal) {
        resumenTotal.textContent = `MXN ${total.toLocaleString('es-MX', { minimumFractionDigits: 2 })}`;
    }
    if (resumenDeposito) {
        resumenDeposito.textContent = `MXN ${total.toLocaleString('es-MX', { minimumFractionDigits: 2 })}`;
    }
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
    <script>
        document.getElementById('btnContinuar').addEventListener('click', function () {
    // Recopilar los datos del formulario de huéspedes
    const datosHuesped = {
        nombre: document.getElementById('nombre').value,
        apellido: document.getElementById('apellido').value,
        direccion: document.getElementById('direccion').value,
        apartamento: document.getElementById('apartamento').value,
        pais: document.getElementById('pais').value,
        estado: document.getElementById('estado').value,
        ciudad: document.getElementById('ciudad').value,
        codigo_postal: document.getElementById('zip').value,
        correo: document.getElementById('email').value,
        telefono: document.getElementById('telefono').value,
    };

    // Recopilar los datos de la reserva (del resumen)
    const datosReserva = obtenerDatosReserva();

    // Combinar los datos del huésped y la reserva
    const datosCompletos = {
        ...datosHuesped,
        ...datosReserva,
    };

    // Enviar los datos al backend
    enviarDatosAlBackend(datosCompletos);
});

function obtenerDatosReserva() {
    const datosReserva = {
        habitaciones: [], // Array para almacenar múltiples habitaciones
        subtotal: parseFloat(document.getElementById('resumenSubtotal').textContent.replace('MXN ', '').replace(/,/g, '')),
        fecha_entrada: document.getElementById('checkinbus').value,
        fecha_salida: document.getElementById('checkoutbus').value,
        cantidad_noches: parseInt(document.getElementById('resumenNoches').textContent.split(' ')[0]),
        cantidad_huespedes: 0, // Inicializar en 0
        total: parseFloat(document.getElementById('resumenTotal').textContent.replace('MXN ', '').replace(/,/g, '')),
        impuesto: parseFloat(document.getElementById('resumenImpuestos').textContent.replace('MXN ', '').replace(/,/g, '')),
    };

    // Obtener todas las entradas de habitaciones en el resumen
    const entradasHabitaciones = document.querySelectorAll('#resumenReserva .habitacion-agregada');

    entradasHabitaciones.forEach(entrada => {
        // Obtener la cantidad de cuartos y el tipo de cuarto
        const textoHabitacion = entrada.querySelector('span:nth-child(1)')?.textContent;
        if (textoHabitacion) {
            const [cantidad, tipo] = textoHabitacion.split('x').map(item => item.trim());

            // Obtener la cantidad de huéspedes para esta habitación
            const cantidadHuespedes = entrada.nextElementSibling?.querySelector('.cantidad-huespedes')?.textContent;
            const subtotalHabitacion = parseFloat(entrada.querySelector('span:nth-child(2)')?.textContent.replace('MXN ', '').replace(/,/g, ''));
            datosReserva.habitaciones.push({
                tipo: tipo, // Nombre del tipo de habitación
                cantidad: parseInt(cantidad), // Cantidad de habitaciones de este tipo
                cantidad_cuartos: parseInt(cantidad), // Incluir cantidad_cuartos
                cantidad_huespedes: parseInt(cantidadHuespedes || 1), // Asociar huéspedes a la habitación
                subtotal: subtotalHabitacion,
            });

            // Sumar la cantidad de huéspedes al total
            datosReserva.cantidad_huespedes += parseInt(cantidadHuespedes || 1);
        }
    });

    console.log("Datos de la reserva:", datosReserva);
    return datosReserva;
}

function enviarDatosAlBackend(datos) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Mostrar el spinner de carga de SweetAlert
    Swal.fire({
        title: 'Procesando reserva...',
        text: 'Por favor, espera un momento.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading(); // Mostrar el spinner
        },
    });

    // Usar setTimeout para permitir que el navegador actualice la UI
    setTimeout(() => {
        fetch('/reservas', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(datos),
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.message || 'Error en la respuesta del servidor');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data && data.success) {
                // Cerrar el spinner de carga
                Swal.close();

                const modal = new bootstrap.Modal(document.getElementById('reservaExitosaModal'));
                modal.show();
            } else {
                throw new Error(data.message || 'Error desconocido');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Cerrar el spinner de carga
            Swal.close();
            // Mostrar un mensaje de error
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, complete el formulario: ' + error.message,
            });
        });
    }, 100); // Retraso de 100ms para permitir que el navegador actualice la UI
}
document.addEventListener('DOMContentLoaded', function () {
    // Evento para el botón "Aceptar" en el modal de confirmación
    document.getElementById('aceptarReserva').addEventListener('click', function () {
        location.reload(); // Recargar la página
    });
});
    </script>
</bodym>
</html>