<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- Icon --}}
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        type="image/x-icon">
    <title>BeautyZen</title>
    <!-- Theme CSS -->
    <link type="text/css" href="{{ asset('assets/css/material-kit.min.css') }}" rel="stylesheet">
    
    <script src="{{ env('POP_PER_JS_URL') }}"></script>
    <script src="{{ env('BOOTSTRAP_JS_URL') }}"></script>
    <link type="text/css" href="{{ env('MATERIAL_KIT_CSS_URL') }}" rel="stylesheet">
    <link href="{{ env('NUCLEO_ICONS_CSS_URL') }}" rel="stylesheet">
    {{-- Icono --}}
    <link rel="shortcut icon" href="{{ env('ICON_URL') }}" type="image/x-icon">

</head>

<body class="d-flex flex-column bg-white" style="height: 100%;">
    <header>
        @guest
            <!-- Navbar para usuarios no autenticados -->
            @include('components/navbar')
        @else
            <!-- Navbar para usuarios autenticados -->
            @include('components/navbarAuth')
        @endguest
    </header>
    <div id="app" class="flex-grow-1">
        <div class="container-fluid">
        </div>
        <main class="mt-3 mb-3">
            @yield('contenido')
        </main>
    </div>
    @include('components/footer')
    <script src="https://kit.fontawesome.com/fde7e9e13d.js" crossorigin="anonymous"></script>
    <!-- Core -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <!-- Theme JS -->
    <!-- Control Center for Material Kit parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-kit.min.js') }}" type="text/javascript"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Scripts de Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
