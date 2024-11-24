<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

		@livewireStyles
		@vite(['resources/css/app.css', 'resources/js/app.js'])

	</head>

	<body class="min-h-screen bg-base-200/50 font-sans antialiased dark:bg-base-200">
		{{-- NAVBAR mobile only --}}
		<x-mary-nav sticky class="lg:hidden">
			<x-mary-slot:brand>
				<div class="ml-5 pt-5 text-lg font-semibold">Smart Finance</div>
			</x-mary-slot:brand>
			<x-mary-slot:actions>
				<label for="main-drawer" class="mr-3 lg:hidden">
					<x-mary-icon name="o-bars-3" class="cursor-pointer" />
				</label>
			</x-mary-slot:actions>
		</x-mary-nav>

		{{-- MAIN --}}
		<x-mary-main full-width>
			{{-- SIDEBAR --}}
			<x-mary-slot:sidebar drawer="main-drawer" collapsible collapse-text="Ocultar" class="bg-base-100 lg:bg-inherit">

				{{-- BRAND --}}
				<div class="ml-4 flex items-center pt-4">
					<x-mary-icon name="s-currency-dollar" class="w-10" />
					<div class="px-mary-2 font-bold">SMART FINANCE</div>
				</div>

				{{-- MENU --}}
				<x-mary-menu activate-by-route>
					<x-mary-menu-item title="Dahsboard" icon="o-chart-pie" link="/" />
					<x-mary-menu-item title="Extrato" icon="c-arrows-up-down" link="{{ route('extratos.index') }}" />
					<x-mary-menu-item title="Recorrentes" icon="o-clock" link="/" />
					<x-mary-menu-item title="Importar arquivo" icon="o-document-arrow-up"
						link="/" />
					<x-mary-menu-item title="Perfil" icon="o-user-circle" />
					<x-mary-menu-sub title="Configurações" icon="o-cog-6-tooth">
						<x-mary-menu-item title="Bancos" icon="c-building-library" link="/" />
						<x-mary-menu-item title="Categorias/Subcategorias" icon="c-squares-plus" link="/" />
						<x-mary-menu-item title="Orçamentos" icon="o-document-currency-dollar" link="/" />
						<x-mary-menu-item title="Periodicidades" icon="m-calendar" link="/" />
					</x-mary-menu-sub>
				</x-mary-menu>
			</x-mary-slot:sidebar>

			{{-- The `$slot` goes here --}}
			<x-mary-slot:content>
				{{ isset($slot) ? $slot : 'Nada aqui' }}
			</x-mary-slot:content>
		</x-mary-main>

		{{-- Toast --}}
		<x-mary-toast />

		@livewireScripts
	</body>

</html>
