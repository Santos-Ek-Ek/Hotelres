<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Truck | Reservaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <style>
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
    </style>
</head>
<body class="bg-light">
    <header class="header d-flex justify-content-between align-items-center">
        <h1>Hacienda de Izamal</h1>
        <button class="btn btn-light d-flex align-items-center">
            <i class="fas fa-globe me-2"></i>
            MXN
        </button>
    </header>
    <main class="position-relative">
        <img src="https://placehold.co/1920x1080" alt="A beautiful swimming pool with a person standing at the far end, surrounded by greenery and a building in the background" class="main-image">
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
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                        <input type="text" class="form-control" placeholder="Código promocional o de grupo">
                    </div>
                </div>
                <button class="btn btn-warning text-white">Buscar</button>
            </div>
        </div>
    </main>
    <section class="property-info">
        <h2>Información de la propiedad</h2>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#checkin", {
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    const checkoutInput = document.getElementById('checkout');
                    checkoutInput._flatpickr.set('minDate', dateStr);
                }
            }
        });

        flatpickr("#checkout", {
            dateFormat: "Y-m-d",
            onOpen: function(selectedDates, dateStr, instance) {
                const checkinInput = document.getElementById('checkin');
                if (checkinInput.value) {
                    instance.set('minDate', checkinInput.value);
                }
            }
        });
    </script>
</body>
</html>