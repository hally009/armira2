<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Armira</title>
    {{-- <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        html,
        body,
        #app {
            height: 100%;
        }

    </style>

</head>

<body>
    <div id="app">
        @include('layouts._web-header')
        @yield('body')
        <div id="preloader"></div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="{{ mix('/js/app.js') }}"></script> --}}
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('script')
</body>
</html>
