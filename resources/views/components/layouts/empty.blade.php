<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cupcake">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

		{{-- Google Fonts --}}
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
			rel="stylesheet">
		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>

	<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

		{{-- MAIN --}}
		<x-main full-width>
			<x-slot:content>
				{{ $slot }}
			</x-slot:content>
		</x-main>
	</body>
</html>
