<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{-- TODO add CSS with Collectivehtml --}}
    {{ Html::style('css/app.css') }}

    {{-- TODO for take @push for multiple prints --}}
    @stack('stylesheets')
</head>
<body>
    <div id="app">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- TODO add dynamic JS --}}
    @stack('scripts')
</body>
</html>
