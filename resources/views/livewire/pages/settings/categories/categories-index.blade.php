<div class="ml-4 max-w-3xl">
	<x-header title="Categorias e Subcategorias" separator />

	{{-- input search (categories and subcategories) and create categories button --}}
	<x-input placeholder="Pesquisar" icon="m-magnifying-glass" class="rounded-md p-4" />

	<x-form class="relative p-4" x-data="{ show: false }" wire:submit="saveCategory">
		<div x-show="!show" x-transition class="flex transition-all duration-300 ease-in-out">
			<x-button label="Adicionar categoria" icon="m-plus-small" class="w-full rounded-md bg-neutral-content"
				x-on:click="show = true" />
		</div>

		<div x-show="show" x-transition class="flex gap-1 transition-all duration-300 ease-in-out">
			<div class="flex-1">
				<x-input placeholder="Nova categoria" type="text" class="rounded-md" wire:model="category_name"/>
			</div>
			<div>
				<x-button class="btn-success" icon="c-check" type="submit" />
				<x-button class="btn-error" icon="m-x-mark" x-on:click="show = false" />
			</div>
		</div>
	</x-form>

	{{-- Categories and Subcategories view --}}
	@foreach ($categories as $cat)
		<x-collapse wire:key="{{ $cat->id }}" separator class="m-0.5 bg-base-100">
			<x-slot:heading>{{ $cat->name }}</x-slot:heading>
			<x-slot:content>
				<ul>
					<li x-data="{ show: false }">
						<div x-show="!show">
							<x-button label="Adicionar subcategoria" icon="m-plus-small" class="mb-1 flex w-full justify-start rounded-md"
								x-on:click="show = true" />
						</div>
						<div x-show="show" x-transition class="flex gap-1 transition-all duration-300 ease-in-out">
							<div class="flex-1">
								<x-input placeholder="Nova subcategoria" type="text" class="rounded-md" />
							</div>
							<div>
								<x-button class="btn-success" icon="c-check" />
								<x-button class="btn-error" icon="m-x-mark" x-on:click="show = false" />
							</div>
						</div>
					</li>

					@foreach ($cat->subcategories as $sub)
						<li class="flex items-center justify-between rounded p-2 hover:bg-base-300">
							<div>
								{{ $sub->name }}
							</div>
							<div>
								<x-button class="" icon="m-pencil" />
							</div>
						</li>
					@endforeach

				</ul>
			</x-slot:content>
		</x-collapse>
	@endforeach

</div>
