<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@if(isset($breadcrumbs[0]['title'])) {{$breadcrumbs[0]['title']}} @else {{$breadcrumbs[0]['index']}} @endif</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Favicon -->
        <link rel="icon" href="{{asset('assets/img/brand/favicon.png')}}" type="image/png">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
        <!-- Icons -->
        <link rel="stylesheet" href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">

        <!-- Page plugins -->

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Styles -->
{{--        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">--}}

    @livewireStyles
    {{--        @powerGridStyles--}}

        <!-- Argon CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/argon.css?v=1.2.0')}}" type="text/css">

        @vite('resources/css/app.css')
        @stack('styles')
    </head>
    <body class="font-sans antialiased">


        <!-- Main content -->
        @include('livewire.backend.user.component.user-side-bar-component')
        <div class="main-content" id="panel">

            <!-- Top nav -->
                @include('top-navbar')

            <!-- Page content -->
                {{$slot}}
        </div>

        <!-- Argon Scripts -->
        <!-- Core -->
        <script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/vendor/js-cookie/js.cookie.js')}}"></script>
        <script src="{{asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
        <script src="{{asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>

        <!-- Argon JS -->
        <script src="{{asset('assets/js/argon.js?v=1.2.0')}}"></script>

        @livewireScripts
        @stack('scripts')
        <script src="{{asset('assets/js/plugins.js')}}"></script>
        @vite('resources/js/app.js')
        {{--        @powerGridScripts--}}
    </body>
</html>
