<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ $title ?? config('app.name') }} </title>
    <!doctype html>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css') }}">
    <style>
        body{
            background-color:rgb(243 244 246 / 1);
            background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body>
    <div class="container mb-4">
        @yield('content')
    </div>
    
    <script type="text/javascript" src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lib/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lib/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/api.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
</body>
</html>
