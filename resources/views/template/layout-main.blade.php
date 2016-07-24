<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    {{-- Jquery --}}
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    @if (Request::segment(1) == 'login')
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @elseif (Request::segment(1) != '')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/advisory.css') }}">
        {{-- SB Admin Dashboard --}}
        <link rel="stylesheet" href="{{ asset('sb-admin/css/sb-admin-2.css') }}">
        <script type="text/javascript" src="{{ asset('sb-admin/js/sb-admin-2.js') }}"></script>
        <link href="{{ asset('sb-admin/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('sb-admin/metisMenu/dist/metisMenu.min.css') }}"></script>

        {{-- Web Socket --}}
    @endif
    {{-- Google Font --}}
    <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    
</head>
<body>

    @if (Request::segment(1) != '' && Request::segment(1) != 'login')
        <div id="wrapper">
            @yield('content')
        </div>
    @else
        @yield('content')
    @endif

</body>
</html>
