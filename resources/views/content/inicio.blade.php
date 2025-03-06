@extends('layout.app')
@section('titulo','Inicio')
@section('content')
<div class="hero-section">
        <h1>Un Lugar Mágico para Descansar</h1>
        <p>Sumérgete en la comodidad del Hotel Truck de Temax y encuentra el lugar perfecto para descansar, recargar energías y continuar tu aventura explorando Temax.</p>
        <p class="highlight">SOMOS TU MEJOR OPCIÓN</p>
    </div>
   
    <div class="container text-center py-5">
        <h1 class="display-4 font-weight-bold mb-5">SOMOS TU MEJOR OPCIÓN</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <img src="img/collage.jpeg" alt="Habitación cómoda con dos camas y una ventana con vista al jardín" class="circle-img mb-3"/>
                <h2 class="h4 font-weight-bold">HABITACIONES CÓMODAS</h2>
                <p>Descansa placenteramente en nuestras habitaciones. Relájate en la cama ideal y disfruta de una noche de sueño reparador después de un día explorando Temax.</p>
            </div>
            <div class="col-md-4 mb-4">
                <img src="img/salaconvi.jpeg" alt="Desayuno con café, jugo, croissants y frutas en una mesa" class="circle-img mb-3"/>
                <h2 class="h4 font-weight-bold">DESAYUNO AL DESPERTAR</h2>
                <p>Comienza tu día con un delicioso desayuno en nuestra cafetería, donde te espera una amplia selección de platos frescos y sabrosos.</p>
            </div>
            <div class="col-md-4 mb-4">
                <img src="img/paspici.jpeg" alt="Piscina al aire libre con sillas y sombrillas" class="circle-img mb-3"/>
                <h2 class="h4 font-weight-bold">RELAJACIÓN Y TRANQUILIDAD</h2>
                <p>Disfruta del ambiente tranquilo nuestros jardines o relájate en la piscina mientras descansas y te sumerges en la serenidad de Temax.</p>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row text-center">
            <div class="col-6 col-md-3 mb-4">
                <div class="icon-circle">
                    <i class="fas fa-wifi fa-3x"></i>
                </div>
                <p class="icon-text">WIFI</p>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="icon-circle">
                    <i class="fas fa-swimming-pool fa-3x"></i>
                </div>
                <p class="icon-text">PISCINA</p>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="icon-circle">
                    <i class="fas fa-car fa-3x"></i>
                </div>
                <p class="icon-text">ESTACIONAMIENTO</p>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="icon-circle">
                    <i class="fas fa-coffee fa-3x"></i>
                </div>
                <p class="icon-text">DESAYUNO</p>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="icon-circle">
                    <i class="fas fa-snowflake fa-3x"></i>
                </div>
                <p class="icon-text">AIRE ACONDICIONADO</p>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="icon-circle">
                    <i class="fas fa-smoking-ban fa-3x"></i>
                </div>
                <p class="icon-text">LIBRE DE HUMO</p>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="icon-circle">
                    <i class="fas fa-door-open fa-3x"></i>
                </div>
                <p class="icon-text">SALIDA EXPRES</p>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="icon-circle">
                    <i class="fas fa-concierge-bell fa-3x"></i>
                </div>
                <p class="icon-text">SERVICIO 24 HORAS</p>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="icon-circle">
                    <i class="fas fa-file-invoice fa-3x"></i>
                </div>
                <p class="icon-text">FACTURACIÓN</p>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column align-items-center justify-content-center min-vh-100">
        <h1 class="display-4 font-weight-bold mt-5">TE ESPERAMOS</h1>
        <p class="lead mt-3">¡Elígenos y haz perfecta en tu visita a Temax!</p>
        <a href="reservaciones" class="btn btn-warning text-white font-weight-bold py-2 px-4 rounded-pill mt-4">RESERVAR AHORA</a>
    </div>

@endsection