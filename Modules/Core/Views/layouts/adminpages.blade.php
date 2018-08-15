<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} || AdminPanel</title>

    @include('layouts._head')

    @include('layouts._js_global')

    @yield('head')

    @yield('javascript')

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/cover.css') }}" rel="stylesheet">




</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

@include('layouts._header')

<div class="app-body">

    @include('layouts._sidebar')

    <main class="main">
        <div class="container-fluid pt-3">
            @yield('content')
        </div>
    </main>

</div>

<div id="modal-placeholder"></div>

</body>
</html>