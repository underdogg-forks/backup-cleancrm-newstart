{{-- @include('layouts._authheader'); --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit="no">
    <meta name="description" content="Laravel Laratrust AdminPanel">
    <meta name="author" content="A. S. Md. Ferdousul Haque">
    <meta name="keyword" content="Laravel, Admin, Adminpanel, Laratrust, Bootstrap">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="#">
    
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
  </head>
  <body class="text-center">
    <div id="app">

  @yield('content')

  {{-- @include('layouts._authfooter'); --}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    </div>
  </body>
</html>