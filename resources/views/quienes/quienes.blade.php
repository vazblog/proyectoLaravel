@extends('layouts.app')
@section('title', 'Quienes')
@section('contenido')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto text-center">
                    <h3>Nuestro Equipo de BeautyZen</h3>
                    <p>Los mejores profesionales en sus áreas para ofrecerte el mejor tratamiento</p>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-4 col-md-6 col-sm-12 mt-6">
                    <div class="card card-profile mt-md-0">
                        <div class="card-header mt-n4 mx-3 p-0 bg-transparent position-relative z-index-2">
                            <a class="d-block blur-shadow-image">
                                <img src="{{ asset('images/personal1.jpg') }}" alt="doctora"
                                    class="img-fluid border-radius-lg">
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <h4 class="mb-0">Ana Rodríguez</h4>
                            <div class="row justify-content-center text-center mt-2">
                                <p>Doctora</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-6">
                    <div class="card card-profile mt-md-0 mt-5">
                        <div class="card-header mt-n4 mx-3 p-0 bg-transparent position-relative z-index-2">
                            <a class="d-block blur-shadow-image">
                                <img src="{{ asset('images/personal5.jpg') }}" alt="estetico"
                                    class="img-fluid border-radius-lg">
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <h4 class="mb-0">Carlos Jiménez</h4>
                            <div class="row justify-content-center text-center mt-2">
                                <p>Estético</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-6">
                    <div class="card card-profile mt-md-0 mt-5">
                        <div class="card-header mt-n4 mx-3 p-0 bg-transparent position-relative z-index-2">
                            <a class="d-block blur-shadow-image">
                                <img src="{{ asset('images/personal6.jpg') }}" alt="recepcionista"
                                    class="img-fluid border-radius-lg">
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <h4 class="mb-0">Isabel Montero</h4>
                            <div class="row justify-content-center text-center mt-2">
                                <p>Recepcionista</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-6">
                    <div class="card card-profile mt-md-0 mt-5">
                        <div class="card-header mt-n4 mx-3 p-0 bg-transparent position-relative z-index-2">
                            <a class="d-block blur-shadow-image">
                                <img src="{{ asset('images/personal4.jpg') }}" alt="auxiliar"
                                    class="img-fluid border-radius-lg">
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <h4 class="mb-0">Javier Martínez</h4>
                            <div class="row justify-content-center text-center mt-2">
                                <p>Auxiliar de estética</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-6">
                    <div class="card card-profile mt-md-0 mt-5">
                        <div class="card-header mt-n4 mx-3 p-0 bg-transparent position-relative z-index-2">
                            <a class="d-block blur-shadow-image">
                                <img src="{{ asset('images/personal2.jpg') }}" alt="auxiliar"
                                    class="img-fluid border-radius-lg">
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <h4 class="mb-0">Claudia García</h4>
                            <div class="row justify-content-center text-center mt-2">
                                <p>Auxiliar de masajes</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-6">
                    <div class="card card-profile mt-md-0 mt-5">
                        <div class="card-header mt-n4 mx-3 p-0 bg-transparent position-relative z-index-2">
                            <a class="d-block blur-shadow-image">
                                <img src="{{ asset('images/personal3.jpg') }}" alt="auxiliar"
                                    class="img-fluid border-radius-lg">
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <h4 class="mb-0">Paloma Navarro</h4>
                            <div class="row justify-content-center text-center mt-2">
                                <p>Auxiliar de estética</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
