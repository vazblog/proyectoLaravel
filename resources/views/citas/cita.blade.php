@extends('layouts.app')
@section('title', 'Citas')
@section('contenido')
    <section class="py-5">
        <div class="container">
            <div class="row  mb-5">
                <div class="col-md-7 mx-auto text-center">
                    <h3>Para pedir una cita</h3>
                    <p>
                        Si tiene alguna duda no dudes en preguntar.
                    </p>
                </div>
            </div>
            <div class="row mt-sm-0 mt-5">
                <div class="col-lg-3 col-md-4 position-relative ms-lg-auto">
                    <div class="p-3 text-center border-right-after">
                        <i class="fas fa-phone fa-3x mb-3 color-iconos"></i>
                        <h6 class="mb-0">Llámanos</h6>
                        <p class="text-dark font-weight-normal">900 00 00 00</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 position-relative">
                    <div class="p-3 text-center border-right-after">
                        <i class="fas fa-calendar-alt fa-3x mb-3 color-iconos"></i>
                        <h6 class="mb-0">Solicita una cita con nosotros</h6>
                        <p class="text-dark font-weight-normal"><a href="{{ route('login') }}">Pide tu cita aquí</a></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 me-lg-auto">
                    <div class="p-3 text-center">
                        <i class="fab fa-whatsapp fa-3x mb-3 color-iconos"></i>
                        <h6 class="mb-0">Envíanos un Whatsapp</h6>
                        <p class="text-dark font-weight-normal">+34 600 000 000</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
