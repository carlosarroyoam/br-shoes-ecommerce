<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('page_title', config('constants.bussines_name'))</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="robots" content="all">

	<!-- Favicon/App icons -->
	{{-- <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}"> --}}

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />
	<livewire:styles>
</head>

<body>

	@include('layouts.navbar')

	@yield('body-content')

	@include('layouts.footer')

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<livewire:scripts>
</body>

</html>