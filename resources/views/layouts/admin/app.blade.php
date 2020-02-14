<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="admin-layout">
    <div id="app" class="d-flex">

        @include('layouts.admin.partials.sidebar')

        <main class="p-lg-5 py-3">
            @include('layouts.admin.partials.flash-message')
            @yield('content')
        </main>


    </div>
</body>
</html>
