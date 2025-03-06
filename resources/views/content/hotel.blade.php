@extends('layout.app')
@section('titulo','Hotel')
@section('content')
<style>
    #fondo {
        font-family: 'Roboto', sans-serif;
        background: url('img/paspici.jpeg') no-repeat center center fixed;
        background-size: cover;
        min-height: 135vh; /* Asegura que el fondo cubra toda la altura de la ventana */
    }

    h1 {
        font-family: 'Playfair Display', serif;
    }

    .content {
        background-color: rgba(255, 255, 255, 0.9); /* Fondo semi-transparente para mejorar la legibilidad */
        padding: 4rem 2rem;
        margin: 2rem auto; /* Centrar el contenido y dar margen */
    }
</style>
<div id="fondo">
    <div class="content text-center">
        <h1 class="display-4 mb-4">NUESTRO HOTEL</h1>
        <p class="mb-4">En nuestro hotel, te ofrecemos mucho más que un simple alojamiento; te brindamos una experiencia única de descanso y tranquilidad en el corazón de Temax, Yucatán.</p>
        <p class="mb-4">Ubicado en este encantador pueblo con historia y tradición, nuestro hotel te permite sumergirte en la esencia auténtica de la región, mientras disfrutas de un ambiente seguro, cómodo y acogedor.</p>
        <p class="mb-4">Aunque estamos cerca de los principales atractivos y sitios de interés de Temax y sus alrededores, nuestro entorno sereno te invita a desconectar del ritmo cotidiano y disfrutar de momentos de relajación y renovación.</p>
        <p class="mb-4">Desde nuestras acogedoras habitaciones hasta nuestros espacios al aire libre, cada rincón ha sido diseñado para ofrecerte una estancia inolvidable llena de confort y bienestar.</p>
    </div>

    
</div>
<div class="container py-5">
        <h1 class="text-center display-4 fw-bold mb-5">AMENIDADES PARA TU COMODIDAD</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
                <div class="text-center">
                    <h2 class="h4 fw-bold mb-3">Cafetería y desayunos</h2>
                    <p>Comienza tu día de la mejor manera en nuestra acogedora cafetería, donde te espera un delicioso desayuno que te llenará de energía para disfrutar de un día lleno de actividades explorando Temax.</p>
                </div>
            </div>
            <div class="col">
                <div class="text-center">
                    <h2 class="h4 fw-bold mb-3">Piscina al aire libre</h2>
                    <p>Sumérgete en nuestra relajante piscina al aire libre. Disfruta del cálido sol de Yucatán mientras te refrescas o simplemente relájate en los cómodos camastros junto a la piscina mientras disfrutas de tus bebidas favoritas.</p>
                </div>
            </div>
            <div class="col">
                <div class="text-center">
                    <h2 class="h4 fw-bold mb-3">Jardines relajantes</h2>
                    <p>Nuestros jardines son el lugar perfecto para pasear, meditar o simplemente relajarse y disfrutar de la paz y tranquilidad que ofrecen.</p>
                </div>
            </div>
            <div class="col">
                <div class="text-center">
                    <h2 class="h4 fw-bold mb-3">Terraza con amplia vista</h2>
                    <p>Disfruta de un rato agradable en nuestra terraza. Ya sea al amanecer o al atardecer este espacio es un escenario único para capturar recuerdos inolvidables.</p>
                </div>
            </div>
            <div class="col">
                <div class="text-center">
                    <h2 class="h4 fw-bold mb-3">Espacios para tomar fotos</h2>
                    <p>Nuestros espacios coloniales son el escenario perfecto para capturar fotografías que te transportarán a otra época mientras creas recuerdos únicos de tu visita a Temax Yuc.</p>
                </div>
            </div>
        </div>
    </div>
@endsection