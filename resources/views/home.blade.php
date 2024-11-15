<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Smart Finance @yield('title')</title>

		<!-- Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
			rel="stylesheet">
            
		@vite(['resources/css/app.css', 'resources/js/app.js'])

	</head>

	<body class="font-sans antialiased">
		<x-sidebar />
		<main class="p-4 sm:ml-64">
			@yield('content')
		</main>
	</body>

</html>
