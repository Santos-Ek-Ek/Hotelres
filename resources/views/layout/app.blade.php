<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="img/logo.jpeg" />
    <title>Hotel Truck | @yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&amp;display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #333;
        }
        .navbar a {
            color: #fff;
            font-weight: bold;
        }
        .hero-section {
            position: relative;
            text-align: center;
            color: #000;
            padding: 150px 20px;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('img/entrada.jpeg');
            background-size: cover;
            background-position: center;
            opacity: 0.6; /* Ajusta el nivel de opacidad */
            z-index: -1; /* Envía la imagen al fondo */
        }
        .icon-circle {
            background-color: #343a40;
            border-radius: 50%;
            padding: 20px;
            display: inline-block;
        }
        .icon-circle i {
            color: #ffc107;
        }
        .icon-text {
            margin-top: 15px;
            font-weight: bold;
            color: #343a40;
        }
        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: bold;
            color: #000; /* Color del texto */
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.7); /* Sombra para mejorar la legibilidad */
        }

        .hero-section p {
            font-size: 1.5rem;
            font-weight: bold;
            color: #000; /* Color del texto */
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.7); /* Sombra para mejorar la legibilidad */
        }

        .hero-section .highlight {
            font-size: 1.2rem;
            font-weight: bold;
            color: #000; /* Color del texto */
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.7); /* Sombra para mejorar la legibilidad */
            margin-top: 20px;
        }
        .reserve-btn {
            background-color: #ffc107;
            color: #333;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
        }
        .circle-img {
            border-radius: 50%;
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="img/logo.jpeg" style="width: 98px;" alt="Hotel Logo" class="me-2"> HOTEL TRUCK
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="hotel">Hotel</a></li>
                    <li class="nav-item"><a class="nav-link" href="habitacion">Habitaciones</a></li>
                </ul>
                <a href="reservaciones" class="btn reserve-btn ms-3">Reservar</a>
            </div>
        </div>
    </nav>
    <div >
    @yield('content')
    </div>
        <footer class="bg-dark text-white py-5">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="text-center text-md-left mb-4 mb-md-0">
                <h2 class="h4 font-weight-bold">DIRECCIÓN</h2>
                <p class="mt-2">
                    Calle 31 81<br>
                    97510 Temax, Yucatán<br>
                    México
                </p>
            </div>
            <div class="text-center mb-4 mb-md-0">
    <img src="img/logo.jpeg" alt="Hotel Truck logo" class="mx-auto" width="100" height="100">
    <h2 class="h4 font-weight-bold mt-2">Hotel Boutique el Truck</h2>
    <!-- Ícono de Facebook -->
    <a href="https://www.facebook.com/share/1HxYT7e6Wi/" target="_blank" class="text-decoration-none">
        <i class="fab fa-facebook fa-2x mt-2" style="color: #1877F2;"></i>
    </a>
</div>
            <div class="text-center text-md-right">
                <h2 class="h4 font-weight-bold">CONTACTO</h2>
                <p class="mt-2">
                    +52 9999 932 551<br>
                    Ismaeltinalmoguel@gmail.com
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>