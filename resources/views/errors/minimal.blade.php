<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="{{ asset('assets/css/material-kit.min.css') }}" rel="stylesheet">
    <title>@yield('title')</title>


</head>

<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-center pt-5">
                <div class="text-center bg-body-tertiary rounded-3">
                    <img src="{{ asset('images/beautyzencorto.svg') }}" class="img-fluid mt-4 mb-3" alt="beautyzen icono">
                </div>
                <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider text-center">
                    @yield('code')
                </div>
                <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider text-center">
                    @yield('message')
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
