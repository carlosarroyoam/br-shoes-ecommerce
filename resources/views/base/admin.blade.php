<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="noindex, nofollow, noarchive">

    <!-- Favicon/App icons -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

    <livewire:styles />
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />
</head>

<body class="flex flex-col min-h-screen pt-12 antialiased theme-light bg-background-secondary text-header">

    <main class="container flex-grow">
        @yield('content')
    </main>

    <livewire:scripts />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>