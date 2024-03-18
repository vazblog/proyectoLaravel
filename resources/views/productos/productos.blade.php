@extends('layouts.app')
@section('title', 'Productos')
@section('contenido')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto text-center">
                    <h3>Nuestros productos</h3>
                    <p>Tu cuidado es nuestro compromiso</p>
                </div>
            </div>
            <div class="row justify-space-between py-2">
                <div class="card card-plain card-blog mt-5 border h-100">
                    <div class="row my-4">
                        <div class="col-md-4">
                            <div class="card-image position-relative border-radius-lg ">
                                <div class="blur-shadow-image">
                                    <img class="img  bd-placeholder-img img-fluid rounded"
                                        src="{{ asset('images/productos/cremaFacial.jpg') }}" title="producto" alt="producto">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 my-auto ms-md-3 mt-md-auto mt-4 text-justify">
                            <p class="text-xs text-uppercase font-weight-bold text-gradient text-success mb-2">Cremas</p>
                            <h3 class="text-dark">Crema Natural Hidratante</h3>
                            <p>
                                Experimenta la suavidad natural y el alivio relajante con nuestra crema elaborada con
                                ingredientes naturales. Diseñada para suavizar la piel y ofrecer un alivio calmante, nuestra
                                crema es una opción indulgente para revitalizar tu piel y tu mente. Disfruta de una
                                sensación de frescura y bienestar con cada aplicación, mientras te sumerges en la suavidad
                                natural que tu piel merece.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-space-between py-2">
                <div class="card card-plain card-blog mt-5 border h-100">
                    <div class="row my-4">
                        <div class="col-md-4">
                            <div class="card-image position-relative border-radius-lg">
                                <div class="blur-shadow-image">
                                    <img class="img  bd-placeholder-img img-fluid rounded-start"
                                        src="{{ asset('images/productos/aceiteMasajeNatural.jpg') }}" title="producto" alt="producto">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 my-auto ms-md-3 mt-md-auto mt-4 text-justify">
                            <p class="text-xs text-uppercase font-weight-bold text-gradient text-success mb-2">Aceites de
                                Masaje</p>
                            <h3 class="text-dark">Aceite de Masaje Relajante</h3>
                            <p>
                                Disfruta de un momento de calma y relajación con nuestro Aceite de Masajes Relajante.
                                Formulado con ingredientes naturales seleccionados por sus propiedades calmantes, este
                                aceite te ayuda a liberar tensiones y a revitalizar tu cuerpo y mente.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-space-between py-2">
                <div class="card card-plain card-blog mt-5 border">
                    <div class="row my-4">
                        <div class="col-md-4">
                            <div class="card-image position-relative border-radius-lg">
                                <div class="blur-shadow-image">
                                    <img class="img  bd-placeholder-img img-fluid rounded-start"
                                        src="{{ asset('images/productos/cera.jpg') }}" title="producto" alt="producto">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 my-auto ms-md-3 mt-md-auto mt-4 text-justify">
                            <p class="text-xs text-uppercase font-weight-bold text-gradient text-success mb-2">Ceras</p>
                            <h3 class="text-dark">Cera de Abeja Natural</h3>
                            <p>
                                Descubre el poder de la naturaleza con nuestra Cera de Abeja Natural. Extraída con cuidado y
                                respeto de las colmenas, nuestra cera de abeja pura es un tesoro de bondades para la piel.
                                Con su textura suave y nutritiva, esta cera es ideal para hidratar y proteger la piel de
                                forma natural. Ya sea para suavizar áreas secas, para crear productos cosméticos caseros o
                                para brindar un cuidado delicado a la piel.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-space-between py-2">
                <div class="card card-plain card-blog mt-5 border">
                    <div class="row my-4">
                        <div class="col-md-4">
                            <div class="card-image position-relative border-radius-lg">
                                <div class="blur-shadow-image">
                                    <img class="img  bd-placeholder-img img-fluid rounded-start"
                                        src="{{ asset('images/productos/maquillaje.jpg') }}" title="producto" alt="producto">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 my-auto ms-md-3 mt-md-auto mt-4 text-justify">
                            <p class="text-xs text-uppercase font-weight-bold text-gradient text-success mb-2">Maquillajes</p>
                            <h3 class="text-dark">Maquillaje Profesional</h3>
                            <p>
                                Sumérgete en el mundo del maquillaje con nuestra línea de Maquillaje de Calidad
                                Profesional. Diseñada para satisfacer las necesidades tanto de expertos en
                                belleza como de aficionados al maquillaje, nuestra colección ofrece una combinación perfecta
                                de rendimiento, versatilidad y calidad.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
