<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> Rádio Cipoense - @yield('htmlheader_title', 'Your title here') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('home/css/app.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.5/bluebird.min.js"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>

<div id="app"></div>

<script src="{{ mix('/home/js/app.js') }}" type="text/javascript"></script>

</body>
</html>
