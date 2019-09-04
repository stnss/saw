<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="skcats">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- CSRF TOKEN -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title -->
        <title>SD Islam Dian Didaktika</title>

        {{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/icomoon/style.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/uniform/css/default.css')}}" rel="stylesheet"/>
        <link href="{{asset('assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet"/>
        <link href="{{asset('assets/plugins/nvd3/nv.d3.min.css')}}" rel="stylesheet">

        <!-- Theme Styles -->
        <link href="{{asset('assets/css/ecaps.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">

        <script src="{{asset('assets/plugins/jquery/jquery-3.1.0.min.js')}}"></script>

        {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        @yield('css')

    </head>
    <body>

        <!-- Page Container -->
        <div class="page-container">
