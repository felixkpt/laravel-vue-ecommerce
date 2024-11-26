<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="">

        <!-- Fonts -->
{{--        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">--}}

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ asset('js/app.js?v=').date('H:i:s') }}" defer></script>
        <script src="{{ asset('js/bootstrap.bundle.js') }}" defer></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/fontawesome-all.css') }}">
        

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
        <!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet"> -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}"> -->
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chosen.min.css') }}"> -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-01.css') }}">

        <link rel="stylesheet" href="{{ asset('owlcarousel/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('owlcarousel/owl.theme.default.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('owlcarousel/owl.carousel.min.js') }}"></script>
</head>
    <body class="font-sans antialiased">

    <div class="container">
        <div class="bg-success">
        1. Success div
        </div>
        <div class="bg-danger" v-model="firtName">
        2. Danger div
        </div>
        <button class="btn btn-success">Our success button</button>
        <button class="btn btn-danger">Our danger button</button>
        <button class="btn btn-primary">Our primary button</button>
 
        <!-- <input v-model="email" :class="{'is-invalid': emailShort, 'bg-success'}"> -->
</body>
    </html>
    <script>
        export default {
            data() {
                return {
                    firstName: null,
                    email: null,
                    emailShort: false
                }
            },
            methods: {

                validateEmail() {
                    if (this.email.length < 5) {
                        this.emailShort = "email is short";
                    }
                }


            }
        }
    </script>
