@extends('layouts.app')
@section('title', 'Inicio')
@section('contenido')
    <section class="py-5">
        <div class="container">

            @if(Session::has('message'))
            <div class="position-fixed top-50 start-50 translate-middle" style="z-index: 1050;">
                <div class="toast fade show p-2 mx-auto mt-7" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: #fff;">
                    <div class="toast-body text-center">
                        <p>{{ Session::get('message') }}</p>
                        <hr class="horizontal dark">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn bg-gradient-primary btn-sm me-2 mb-0" data-bs-dismiss="toast">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        


            <div class="text-center bg-body-tertiary rounded-3">
                <img src="{{ asset('images/beautyzencorto.svg') }}" class="img-fluid mt-4 mb-3" alt="beautyzen icono">
                <p class="col-lg-8 mx-auto fs-5 text-muted">
                    <em>Descubre la belleza que hay en ti. Con nuestros tratamientos conseguirás tu mejor versión.</em>
                </p>
            </div>
        </div>
    </section>
@endsection
