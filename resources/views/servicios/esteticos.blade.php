@extends('layouts.app')
@section('title', 'Servicios Estéticos')
@section('contenido')

    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 text-center mx-auto">
                    <p class="mb-1 text-success text-uppercase font-weight-bold">Nuestros Servicios</p>
                    <h3>Masajes y Belleza</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 position-relative">
                    <img class="image-left border-radius-lg img-fluid shadow position-relative top-0 end-0 ms-md-5 bg-cover"
                        src="{{ asset('images/servicios/servicio9.jpg') }}"title="masaje" alt="masaje">

                    <p class="blockquote border border-success rounded w-50 p-3 text-sm  float-md-end mx-auto mt-4 me-md-n2">
                        "¡Los masajes son maravillosos! Cada sesión es un oasis de relajación y alivio del estrés. Gracias
                        al centro por ofrecer experiencias tan rejuvenecedoras y revitalizantes."
                        <br>
                        <br>
                        <small>Cristina</small>
                    </p>

                </div>
                <div class="col-md-5">
                    <img class="image-right border-radius-lg img-fluid shadow ms-md-n4 mb-4 mt-md-8 position-relative bg-cover"
                        src="{{ asset('images/servicios/servicio10.jpg') }}" title="masaje" alt="masaje">
                    <div class="px-4">
                        <p class="text-gradient text-success">Masajes</p>
                        <h3 class="mb-4">Corporal</h3>
                        <p>
                            Ofrecemos una variedad de masajes diseñados para brindarte bienestar y relajación. Desde masajes
                            terapéuticos para aliviar la tensión muscular hasta masajes de aromaterapia para estimular tus
                            sentidos, nuestro equipo de terapeutas expertos está comprometido a proporcionarte una
                            experiencia rejuvenecedora. Deja que cada sesión de masaje te lleve a un
                            estado de calma y renovación. </p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6 position-relative">
                    <img class="image-left border-radius-lg img-fluid shadow position-relative top-0 end-0 ms-md-5 bg-cover"
                        src="{{ asset('images/servicios/servicio11.jpg') }}" title="maquillaje" alt="maquillaje">
                    <p
                        class="blockquote border border-success rounded w-50 p-3 text-sm  float-md-end mt-4 me-md-n2 mx-auto">
                        "Cada vez que salgo de aquí, me siento transformado. Los profesionales saben exactamente cómo
                        realzar mis rasgos naturales y crear looks impresionantes para cualquier ocasión"
                        <br>
                        <br>
                        <small>Roberto</small>
                    </p>

                </div>
                <div class="col-md-5">
                    <img class="image-right border-radius-lg img-fluid shadow ms-md-n4 mb-4 mt-md-8 position-relative bg-cover"
                        src="{{ asset('images/servicios/servicio12.jpg') }}" title="maquillaje" alt="maquillaje">
                    <div class="px-4">
                        <p class="text-gradient text-success">Estética</p>
                        <h3 class="mb-4">Estética y Maquillaje</h3>
                        <p>
                            Descubre nuestros servicios de maquillaje y retoques estéticos, diseñados para realzar tu
                            belleza natural y resaltar tus mejores rasgos. Nuestros expertos en maquillaje utilizan técnicas
                            avanzadas y productos de alta calidad para lograr resultados impresionantes que te harán lucir
                            radiante en cualquier ocasión. Ya sea para un evento especial o simplemente para mimarte,
                            estamos aquí para ayudarte a lucir y sentirte lo mejor posible.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
