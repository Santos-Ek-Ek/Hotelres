@extends('layout.app')
@section('titulo','Habitaciones')
@section('content')
<div class="container py-5">
        <h1 class="text-center font-weight-bold mb-4">Nuestras Habitaciones</h1>
        <p class="text-center mb-4">
            Disfruta de la serenidad y el encanto colonial en cada una de nuestras cómodas habitaciones. Sumérgete en un ambiente que te invita a relajarte. Cada detalle ha sido cuidadosamente diseñado para ofrecerte la máxima tranquilidad y descanso durante tu estancia en Temax.
        </p>
        <p class="text-center mb-5">
            Con una combinación perfecta entre tradición y modernidad, nuestras habitaciones te brindarán el refugio perfecto para recargar energías y continuar disfrutando de todo lo que Temax tiene para ofrecerte.
        </p>
        <div class="row text-center">

            <div class="col-md-6 mb-4">
                <img src="img/familiar.jpeg" style="width: 200px; height: 200px;" class="rounded-circle mb-3" alt="Habitación JR Suite con cama grande y decoración colonial">
                <h2 class="h4 font-weight-bold">Habitación Familiar</h2>
                <p class="font-italic mb-3">Ideal para un máximo de 5 personas</p>
                <ul class="list-unstyled">
                    <li>Wifi</li>
                    <li>Calefacción</li>
                    <li>Servicios de aseo</li>
                    <li>Escritorio</li>
                    <li>Televisión por cable</li>
                    <li>Plancha para ropa</li>
                    <li>Secador de pelo</li>
                    <li>Minibar</li>
                    <li>Ducha independiente</li>
                    <li>Adaptadores AC/DC</li>
                </ul>
            </div>
            <div class="col-md-6 mb-4">
                <img src="img/basica.jpeg" style="width: 200px; height: 200px;" class="rounded-circle mb-3" alt="Habitación JR Suite con cama grande y decoración colonial">
                <h2 class="h4 font-weight-bold">Habitación Básica</h2>
                <p class="font-italic mb-3">Ideal para un máximo de 3 personas</p>
                <ul class="list-unstyled">
                    <li>Bañera o ducha</li>
                    <li>Plancha</li>
                    <li>Internet inalámbrico (Wi-Fi)</li>
                    <li>Servicios de aseo</li>
                    <li>Televisión por cable</li>
                    <li>Baño adicional</li>
                    <li>Minibar</li>
                    <li>Adaptadores AC/DC</li>
                    <li>Cunas</li>
                </ul>
            </div>
        </div>

        @endsection
