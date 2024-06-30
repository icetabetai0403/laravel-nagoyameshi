<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/3a94e45220.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="{{ asset('css/nagoyameshi.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}"/>
    </head>
    <body>
        <div id="app">
            @component('components.header')
            @endcomponent

            <main class="py-4 mb-5">
                @yield('content')
            </main>

            @component('components.footer')
            @endcomponent
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
    </body>
</html>
