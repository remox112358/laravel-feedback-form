<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="description" content="Feedback form">
    <meta name="author" content="Artyom Davtyan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/ff-favicon.ico') }}" type="image/x-icon">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/fontawesome-kit.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body>
    @include('layouts.partials.preloader')
    @include('layouts.partials.header')

    <div class="container mb-4">
        @yield('content')
    </div>

    @include('layouts.partials.alert')
</body>
</html>