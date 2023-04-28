<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/favicon.ico')}}">
    <link rel="icon" type="image/png" href="{{asset('img/favicon.ico')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> 14th November Studio | Etobicoke Videography</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $meta->meta_description }}">
    <meta name="keyword" content="{{ $meta->meta_key_word }}">

 @include('frontend.includes.meta') 

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <link rel="icon" type="image/ico" href="{{asset('img/favicon.ico')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    @stack('before-styles')

    <!--<link rel="stylesheet" href="{{ mix('css/frontend.css') }}">-->

    @stack('after-styles')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    @include('frontend.includes.header')

  

    <main>
        @yield('content')
    </main>

    @include('frontend.includes.footer')


</body>

<!-- Scripts -->
@stack('before-scripts')

<!--<script src="{{ mix('js/frontend.js') }}"></script>-->

@stack('after-scripts')

</html>