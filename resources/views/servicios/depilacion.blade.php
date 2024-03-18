@extends('layouts.app')
@section('title', 'Servicios Depilación')
@section('contenido')

    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 text-center mx-auto">
                    <p class="mb-1 text-success text-uppercase font-weight-bold">Nuestros Servicios</p>
                    <h3>Depilación Unisex</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 position-relative">
                    <img class="image-left border-radius-lg img-fluid shadow position-relative top-0 end-0 ms-md-5 bg-cover"
                        src="{{ asset('images/servicios/servicio5.jpg') }}" title="depilación" alt="depilación">

                    <p class="blockquote border border-success rounded w-50 p-3 text-sm  float-md-end mx-auto mt-4 me-md-n2">
                        "Cada vez que visito, sé que recibiré un servicio impecable y sentiré una gran comodidad. Realmente
                        hacen que cada sesión de depilación sea una experiencia rejuvenecedora que espero con ansias."
                        <br>
                        <br>
                        <small>Carlos</small>
                    </p>

                </div>
                <div class="col-md-5">
                    <img class="image-right border-radius-lg img-fluid shadow ms-md-n4 mb-4 mt-md-8 position-relative bg-cover"
                        src="{{ asset('images/servicios/servicio6.jpg') }}" title="depilación" alt="depilación">
                    <div class="px-4">
                        <p class="text-gradient text-success">Depilación</p>
                        <h3 class="mb-4">Corporal</h3>
                        <p>
                            Explora nuestra gama de servicios de depilación corporal unisex, diseñados para ofrecerte
                            resultados impecables. Desde técnicas tradicionales hasta métodos innovadores, te brindamos una
                            experiencia de depilación sin igual. Nuestro equipo de expertos te garantiza un servicio
                            profesional y cómodo en un entorno relajante. Déjanos cuidar de ti y disfruta de una piel suave
                            y sin vello en cada visita. </p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6 position-relative">
                    <img class="image-left border-radius-lg img-fluid shadow position-relative top-0 end-0 ms-md-5 bg-cover"
                        src="{{ asset('images/servicios/servicio7.jpg') }}" title="depilación" alt="depilación">
                    <p
                        class="blockquote border border-success rounded w-50 p-3 text-sm  float-md-end mt-4 me-md-n2 mx-auto">
                        "¡La depilación láser es increíble! Resultados duraderos y piel suave al instante. ¡Gracias al
                        centro por hacer cada sesión cómoda y efectiva!"
                        <br>
                        <br>
                        <small>Sara</small>
                    </p>

                </div>
                <div class="col-md-5">
                    <img class="image-right border-radius-lg img-fluid shadow ms-md-n4 mb-4 mt-md-8 position-relative bg-cover"
                        src="{{ asset('images/servicios/servicio8.jpg') }}" title="depilacion_laser" alt="depilación laser">
                    <div class="px-4">
                        <p class="text-gradient text-success">Depilación</p>
                        <h3 class="mb-4">Láser</h3>
                        <p>
                            Descubre la revolucionaria depilación láser en nuestro centro, una solución avanzada para una
                            piel suave y sin vello de forma duradera. Con tecnología de última generación y un equipo
                            altamente capacitado, te ofrecemos un tratamiento seguro y efectivo para eliminar el vello no
                            deseado. Confía en nosotros para transformar tu rutina de belleza y sentirte seguro en tu propia
                            piel.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
