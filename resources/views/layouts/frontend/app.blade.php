<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Karman Store">
    <meta name="keywords" content="keywords">
    <meta name="author" content="Karman">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>{{ ucfirst($header['page_title']) }}</title>

    <!-- Fevicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- Start css -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Switchery css -->
    <link href="{{asset('assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
    @stack('shop_styles')
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/flag-icon.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->

    <!-- Styles -->
    @livewireStyles

    @stack('homepage_styles')
</head>
<body class="horizontal-layout">

<div class="min-h-screen bg-gray-100">

    <!-- Start Containerbar -->
    <div id="containerbar" class="">
        <!-- Start Rightbar -->
        <div class="rightbar">
            <div>
                @guest
                    <a href="{{route('login')}}">Login</a>
                @else
                    <a href="{{route('backend.cashier')}}">Dashboard</a>
                @endguest
            </div>

        @include('vendor.frontend.header')

        @if(isset($header))
            @if($header['page_title'] != 'home')

                @include('vendor.frontend.breadcrumb')
            @endif
        @endif

        <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            @include('vendor.frontend.footer')

        </div>
        <!-- End Rightbar -->
    </div>
    <!-- End Containerbar -->
</div>




{{--        @stack('modals')--}}

<!-- Start js -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/modernizr.min.js')}}"></script>
<script src="{{asset('assets/js/detect.js')}}"></script>
<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('assets/js/horizontal-menu.js')}}"></script>
<!-- Switchery js -->
<script src="{{asset('assets/plugins/switchery/switchery.min.js')}}"></script>
@stack('shop_scripts')
<!-- Core js -->
<script src="{{asset('assets/js/core.js')}}"></script>
<!-- End js -->
@livewireScripts
@stack('homepage_scripts')
</body>
</html>
