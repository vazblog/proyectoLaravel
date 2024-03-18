@extends('layouts.app')
@section('title', 'Servicios Tratamientos')
@section('contenido')


    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 text-center mx-auto">
                    <p class="mb-1 text-success text-uppercase font-weight-bold">Nuestros Servicios</p>
                    <h3>Todos los Tratamientos </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 position-relative">
                    <img class="image-left border-radius-lg img-fluid shadow position-relative top-0 end-0 ms-md-5 bg-cover"
                        src="{{ asset('images/servicios/servicio1.jpg') }}" title="trtamiento_corporal" alt="trtamiento corporal">

                    <p class="blockquote border border-success rounded w-50 p-3 text-sm  float-md-end mx-auto mt-4 me-md-n2">
                        "¡Increíbles tratamientos! Mi piel nunca se ha visto tan radiante y rejuvenecida. Gracias al centro
                        por cuidar de mí y hacer que cada visita sea una experiencia rejuvenecedora."
                        <br>
                        <br>
                        <small>Carmen</small>
                    </p>

                </div>
                <div class="col-md-5">
                    <img class="image-right border-radius-lg img-fluid shadow ms-md-n4 mb-4 mt-md-8 position-relative bg-cover"
                        src="{{ asset('images/servicios/servicio2.jpg') }}" title="trtamiento_corporal" alt="trtamiento corporal">
                    <div class="px-4">
                        <p class="text-gradient text-success">Tratamiento</p>
                        <h3 class="mb-4">Corporal</h3>
                        <p>
                            Ofrecemos una amplia gama de tratamientos corporales diseñados para promover tu bienestar. Desde
                            envolturas corporales rejuvenecedoras hasta
                            masajes relajantes y técnicas avanzadas de tonificación, estamos comprometidos a proporcionarte
                            una experiencia transformadora. En un ambiente tranquilo y acogedor, nuestros expertos
                            terapeutas te guiarán en un viaje de renovación y revitalización. </p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6 position-relative">
                    <img class="image-left border-radius-lg img-fluid shadow position-relative top-0 end-0 ms-md-5 bg-cover"
                        src="{{ asset('images/servicios/servicio3.jpg') }}" title="trtamiento_facial" alt="tratamiento facial">
                    <p
                        class="blockquote border border-success rounded w-50 p-3 text-sm  float-md-end mt-4 me-md-n2 mx-auto">
                        "Los tratamientos faciales aquí son simplemente increíbles! Desde que empecé a venir, mi piel ha
                        experimentado una transformación asombrosa"
                        <br>
                        <br>
                        <small>Luis</small>
                    </p>

                </div>
                <div class="col-md-5">
                    <img class="image-right border-radius-lg img-fluid shadow ms-md-n4 mb-4 mt-md-8 position-relative bg-cover"
                        src="{{ asset('images/servicios/servicio4.jpg') }}" title="trtamiento_facial" alt="tratamiento facial">
                    <div class="px-4">
                        <p class="text-gradient text-success">Tratamiento</p>
                        <h3 class="mb-4">Facial</h3>
                        <p>
                            Te ofrecemos desde limpiezas profundas hasta terapias de hidratación intensiva, cada tratamiento
                            está
                            diseñado para revitalizar tu cutis y resaltar tu belleza natural. Nuestros especialistas en
                            cuidado de la piel utilizarán técnicas avanzadas y productos de alta calidad para brindarte
                            resultados visibles y duraderos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
