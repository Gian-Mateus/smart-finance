<div class="ml-4 max-w-3xl">
	<x-header title="Categorias e Subcategorias" separator />

	{{-- input search (categories and subcategories) and create categories button --}}
	<x-input placeholder="Pesquisar" icon="m-magnifying-glass" class="rounded-md p-4" />

	<x-form class="relative p-4" x-data="{ show: false }" wire:submit="saveCategory">
		<div x-show="!show" x-transition class="flex transition-all duration-300 ease-in-out">
			<x-button label="Adicionar categoria" icon="m-plus-small" class="w-full bg-neutral-content"
				x-on:click="show = true" />
		</div>

		<div x-show="show" x-transition class="flex gap-1 transition-all duration-300 ease-in-out">
			<div class="flex-1">
				<x-input placeholder="Nova categoria" type="text" wire:model="category_name" />
			</div>
			<div>
				<x-button class="btn-primary" icon="c-check" type="submit" responsive />
				<x-button class="btn-secondary" icon="c-x-mark" x-on:click="show = false" responsive />
			</div>
		</div>
	</x-form>

	{{-- Categories and Subcategories view --}}
	@foreach ($categories as $cat)
		<x-collapse wire:key="{{ $cat->id }}" separator class="group m-0.5 bg-base-100">
			<x-slot:heading class="flex items-center justify-between">
				<div>
					{{ $cat->name }}
				</div>
				<div
					class="absolute right-12 top-1/2 z-10 -translate-y-1/2 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
					<x-button class="btn-outline btn-primary" icon="c-pencil" responsive />
					<x-button class="btn-outline btn-secondary" icon="c-x-mark" responsive />
				</div>
			</x-slot:heading>
			<x-slot:content>
				<ul>
					<li x-data="{ show: false }" class="m-3">
						<div x-show="!show">
							<x-button label="Adicionar subcategoria" icon="m-plus-small" class="mb-1 flex w-full justify-start"
								x-on:click="show = true" />
						</div>
						<div x-show="show" x-transition class="flex gap-1 transition-all duration-300 ease-in-out">
							<div class="flex-1">
								<x-input placeholder="Nova subcategoria" type="text" />
							</div>
							<div>
								<x-button class="btn-primary" icon="c-check" />
								<x-button class="btn-secondary" icon="m-x-mark" x-on:click="show = false" />
							</div>
						</div>
					</li>

					@foreach ($cat->subcategories as $sub)
						<li class="group/subcat relative flex items-center justify-between rounded p-2 hover:bg-base-300">
							<div>
								{{ $sub->name }}
							</div>
							<div
								class="absolute right-12 top-1/2 z-10 my-auto -translate-y-1/2 opacity-0 transition-opacity duration-300 group-hover/subcat:opacity-100">
								<x-button class="btn-outline btn-primary btn-sm" icon="c-pencil" responsive />
								<x-button class="btn-outline btn-secondary btn-sm" icon="c-x-mark" responsive />
							</div>
						</li>
					@endforeach

				</ul>
			</x-slot:content>
		</x-collapse>
	@endforeach

</div>
