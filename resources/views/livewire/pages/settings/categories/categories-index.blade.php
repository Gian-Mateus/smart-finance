<div>
	<x-header title="Categorias e Subcategorias" separator />

	{{-- Form search (categories and subcategories) and create categories --}}
	<x-form class="p-4">
		<x-input placeholder="Pesquisar" >
			<x-slot:append>
				<x-button icon="m-magnifying-glass" class="rounded-s-none btn-neutral"/>
			</x-slot:append>
		</x-input>
	</x-form>
	<x-form>
		<x-button label="Adicionar categoria" icon="m-plus-small" class="bg-neutral-content" />
	</x-form>

	{{-- Categories and Subcategories view --}}
	@foreach ($categories as $cat)
		<x-collapse wire:key="$cat->id" separator class="m-0.5 bg-base-100">
			<x-slot:heading>{{ $cat->name }}</x-slot:heading>
			<x-slot:content>
				<ul>
					<li>
						<x-button label="Adicionar subcategoria" icon="m-plus-small" class="flex w-full justify-start rounded-md"  @click="$wire.modalCS = true" />
					</li>

					@foreach ($cat->subcategories as $sub)
						<li class="rounded p-2 hover:bg-base-300">{{ $sub->name }}</li>
					@endforeach

				</ul>
			</x-slot:content>
		</x-collapse>
	@endforeach

	{{-- Modal --}}


</div>
