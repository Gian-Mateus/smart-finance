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
		<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

		{{-- Flatpickr  --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		
		{{-- It will not apply locale yet  --}}
		<script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
		
		{{-- You need to set here the default locale or any global flatpickr settings--}}
		<script>
			flatpickr.localize(flatpickr.l10ns.pt);
		</script>
		
		@livewireStyles
		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>

	<body class="min-h-screen bg-base-200/50 font-sans antialiased dark:bg-base-200">
		{{-- NAVBAR mobile only --}}
		<x-nav sticky class="lg:hidden">
			<x-slot:brand>
				<div class="ml-5 pt-5 text-lg font-semibold">Smart Finance</div>
			</x-slot:brand>
			<x-slot:actions>
				<label for="main-drawer" class="mr-3 lg:hidden">
					<x-icon name="o-bars-3" class="cursor-pointer" />
				</label>
			</x-slot:actions>
		</x-nav>

		{{-- MAIN --}}
		<x-main full-width>
			{{-- SIDEBAR --}}
			<x-slot:sidebar drawer="main-drawer" collapsible collapse-text="Ocultar" class="bg-base-100 lg:bg-inherit">

				{{-- BRAND --}}
				<div class="ml-4 flex items-center pt-4">
					<x-icon name="s-currency-dollar" class="w-10" />
					<div class="px-2 font-bold">SMART FINANCE</div>
				</div>

				{{-- MENU --}}
				<x-menu activate-by-route>
					<x-menu-item title="Dahsboard" icon="o-chart-pie" link="{{ route('dashboard.index') }}" />
					<x-menu-item title="Extratos" icon="c-arrows-up-down" link="{{ route('statements') }}" />
					<x-menu-item title="Recorrentes" icon="o-clock" link="####" />
					<x-menu-item title="Importar arquivo" icon="o-document-arrow-up"
						link="{{ route('imports') }}" />
					<x-menu-item title="Perfil" icon="o-user-circle" />
					<x-menu-sub title="Configurações" icon="o-cog-6-tooth">
						<x-menu-item title="Bancos/Contas" icon="c-building-library" link="{{ route('banks') }}" />
						<x-menu-item title="Categorias/Subcategorias" icon="c-squares-plus" link="{{ route('categories') }}" />
						<x-menu-item title="Orçamentos" icon="o-document-currency-dollar" link="{{ route('budgets') }}" />
						<x-menu-item title="Trans. Recorrentes" icon="m-calendar" link="{{ route('recurrences') }}" />
					</x-menu-sub>
				</x-menu>
			</x-slot:sidebar>

			{{-- The `$slot` goes here --}}
			<x-slot:content>
				{{ isset($slot) ? $slot : 'Nada aqui' }}
			</x-slot:content>
		</x-main>
		
		{{-- Toast --}}
		<x-toast />

		@livewireScripts
	</body>

</html>