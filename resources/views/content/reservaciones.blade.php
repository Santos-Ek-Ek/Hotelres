<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Truck | Reservaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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
    </style>
</head>
<body class="bg-light">
    <header class="header d-flex justify-content-between align-items-center">
        <h1>Hotel Truck</h1>
        <button disabled class="btn btn-light d-flex align-items-center">

            MXN
        </button>
    </header>
    <main class="position-relative">
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
 
    </main>

    <div style="background-color: #FFC107; width:100%;">
        <header class="header d-flex justify-content-between align-items-center">
            <h1 class="text-black">Hotel Truck</h1>
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center bg-white header-input mr-2">
                    <input type="text" class="form-control border-0" id="checkinbus" placeholder="14 mar 2025">
                    <span class="mx-2">→</span>
                    <input type="text" class="form-control border-0" id="checkoutbus" placeholder="21 mar 2025">
                    <button class="btn text-warning ml-2"><i class="fas fa-search"></i></button>
                </div>

                <button disabled class="btn btn-light d-flex align-items-center">MXN</button>

            </div>
        </header>
        
        <div class="row" id="habitacionesContainer">
        <!-- Aquí se mostrarán las habitaciones disponibles -->

            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Configurar Flatpickr para los inputs de fecha
    flatpickr("#checkin", {
        dateFormat: "d-m-Y", // Formato de fecha
        minDate: "today", // Fecha mínima: hoy
        onChange: function(selectedDates, dateStr) {
            document.getElementById('checkinbus').value = dateStr; // Actualizar el input de fecha en el header
        }
    });

    flatpickr("#checkout", {
        dateFormat: "d-m-Y", // Formato de fecha
        minDate: "today", // Fecha mínima: hoy
        onChange: function(selectedDates, dateStr) {
            document.getElementById('checkoutbus').value = dateStr; // Actualizar el input de fecha en el header
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const btnBuscar = document.getElementById('btnBuscar');
    const habitacionesContainer = document.getElementById('habitacionesContainer');

    btnBuscar.addEventListener('click', function() {
        const checkin = document.getElementById('checkin').value;
        const checkout = document.getElementById('checkout').value;

        if (!checkin || !checkout) {
            alert('Por favor, seleccione ambas fechas.');
            return;
        }

                // Calcular el número de noches
                const checkinDate = moment(checkin, 'D-M-YYYY');
        const checkoutDate = moment(checkout, 'D-M-YYYY');
        const noches = checkoutDate.diff(checkinDate, 'days');

        if (noches <= 0) {
            alert('La fecha de salida debe ser posterior a la fecha de llegada.');
            return;
        }

        // Enviar la solicitud al servidor
        fetch(`/buscar-habitaciones?checkin=${checkin}&checkout=${checkout}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data); // Debugging: Log the data to the console
                    mostrarHabitaciones(data.habitacionesPorTipo, noches);
                } else {
                    alert('Error al buscar habitaciones.');
                }
            })
            .catch(error => console.error('Error:', error));
    });

    function mostrarHabitaciones(habitacionesPorTipo, noches) {
        const habitacionesContainer = document.getElementById('habitacionesContainer');
        habitacionesContainer.innerHTML = ''; // Limpiar el contenedor

        // Validate that habitacionesPorTipo is an array
        if (!Array.isArray(habitacionesPorTipo)) {
            habitacionesContainer.innerHTML = '<p>No hay habitaciones disponibles para las fechas seleccionadas.</p>';
            return;
        }

        if (habitacionesPorTipo.length === 0) {
            habitacionesContainer.innerHTML = '<p>No hay habitaciones disponibles para las fechas seleccionadas.</p>';
            return;
        }
        const nochesTexto = noches === 1 ? '1 noche' : `${noches} noches`;

        habitacionesPorTipo.forEach(grupo => {
            const { tipo_habitacion, cantidad_disponible, habitaciones } = grupo;




            if (habitaciones.length > 0) {
                const habitacion = habitaciones[0]
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
                                    <img src="${habitacion.imagen_habitacion}" class="img-fluid rounded"  style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;" alt="Habitación">
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
                                                <select class="form-select w-auto d-inline">
                                                    ${options}
                                                </select>
                                            </div>
                                            <div>
                                                <label class="fw-bold">Cantidad</label>
                                                <div class="d-flex">
                                                    <button class="btn btn-outline-secondary" onclick="cambiarCantidad(this, -1, ${cantidad_disponible})">-</button>
                                                    <input type="text" class="form-control text-center w-25" value="1" readonly>
                                                    <button class="btn btn-outline-secondary" onclick="cambiarCantidad(this, 1, ${cantidad_disponible})">+</button>
                                                </div>
                                            </div>
                                            <button class="btn btn-warning ms-3 add-btn">Añadir</button>
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
});

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

    </script>
</body>
</html>