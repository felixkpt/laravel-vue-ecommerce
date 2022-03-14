<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/bootstrap.bundle.js') }}" defer></script>

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chosen.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-01.css') }}">

        @if (11 > 2)
          <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/dashboard.css') }}"> 
        @endif
    </head>
    <body class="font-sans antialiased">
        @inertia

        @env ('local')
        @endenv

        <script src="{{ asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
        <script src="{{ asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.flexslider.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
        <script src="{{ asset('assets/js/functions.js') }}"></script>
    </body>
    <style>
        .regular-price{
            font-weight: 300;
            color:#aaaaaa!important;
            font-size: 13px!important;
            text-decoration: line-through;
            padding-left: 10px;
        }
      /* You only need this if you use :fixed-height="true". */
      .vueperslides--fixed-height { height: 300px; }
      @media (max-width: 767px)  {
        .vueperslides--fixed-height { height: 350px; }
      }
    </style>
</html>
