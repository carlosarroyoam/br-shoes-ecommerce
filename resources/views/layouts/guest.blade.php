<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="BR SHOES, Ama tu estilo">
    <meta name="keywords" content="Zapatos, Zapateria, BR Shoes, Guanajuato, Calzado, Zapatos de Leon, Hecho en Mexico">
    <meta name="robots" content="all">

    <livewire:styles />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="font-sans antialiased text-gray-900">
        {{ $slot }}
    </div>

    <livewire:scripts />
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
