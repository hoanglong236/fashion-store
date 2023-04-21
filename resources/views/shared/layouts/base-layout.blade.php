<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $data['pageTitle'] }}</title>

    <!-- Font awesome -->
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-spacer.css') }}" rel="stylesheet">

    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="{{ asset('assets/css/jquery.smartmenus.bootstrap.css') }}" rel="stylesheet">

    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.simpleLens.css') }}">

    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">

    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/nouislider.css') }}">

    <!-- Theme color -->
    <link id="switcher" href="{{ asset('assets/css/theme-color/default-theme.css') }}" rel="stylesheet">

    <!-- Top Slider CSS -->
    <link href="{{ asset('assets/css/sequence-theme.modern-slide-in.css') }}" rel="stylesheet" media="all">

    <!-- Main style sheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- Google Font -->
    {{-- <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'> --}}
</head>

<body>
    @yield('body-content')

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>

    <!-- SmartMenus jQuery plugin -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery.smartmenus.js') }}"></script>

    <!-- SmartMenus jQuery Bootstrap Addon -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery.smartmenus.bootstrap.js') }}"></script>

    <!-- To Slider JS -->
    <script src="{{ asset('assets/js/sequence.js') }}"></script>
    <script src="{{ asset('assets/js/sequence-theme.modern-slide-in.js') }}"></script>

    <!-- Product view slider -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery.simpleGallery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.simpleLens.js') }}"></script>

    <!-- slick slider -->
    <script type="text/javascript" src="{{ asset('assets/js/slick.js') }}"></script>

    <!-- Price picker slider -->
    <script type="text/javascript" src="{{ asset('assets/js/nouislider.js') }}"></script>

    <!-- Custom js -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @stack('scripts')
</body>

</html>
