<!doctype html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.laravel = { csrf_token: '{{ csrf_token() }}' } </script>
        <title>Nikan Store</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <link rel="stylesheet" href="/css/nikan.css">
        
    </head>
    <body>
        <div id="app">
            <!-- <example-component></example-component> -->
           <mega-menu-component></mega-menu-component>
        </div>
        <script src="{{ mix('js/app.js') }}" ></script>
    </body>
    
</html>
