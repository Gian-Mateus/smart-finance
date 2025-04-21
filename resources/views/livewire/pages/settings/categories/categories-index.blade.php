<div
	class="ml-4 max-w-3xl mt-10"
	x-data="{ selectDelete: false, selectAll: false }"
>
	<x-header
		title="Categorias e Subcategorias"
		separator
	/>
	{{-- Search, Delete and Add --}}
	<div class="grid">
		<div class="flex grid-cols-1 items-center gap-2">
			{{-- Search --}}
			<div class="flex-1">
				<x-input
					class="p-2"
					placeholder="Pesquisar"
					icon="m-magnifying-glass"
				/>
			</div>
			{{-- Delete Categories--}}
			<x-dropdown>
				<x-slot:trigger>
					<x-button icon="o-ellipsis-vertical" class="btn-circle" />
				</x-slot:trigger>

				<x-menu-item title="Excluir todos" @click="selectDelete = true" />
			</x-dropdown>
		</div>
		{{-- Select for delete Categories --}}
		<div
			class="m-2 flex items-center gap-x-2"
			x-show="selectDelete"
		>
			<x-checkbox
				label="Selecionar tudo"
				@click="selectAll = ! selectAll"
			/>
			<x-button
				class="btn-md"
				label="Excluir"
				icon="o-trash"
				wire:click="deleteSelected"
			/>
			<x-button
				class="btn-md"
				label="Cancelar"
				icon="o-x-mark"
				@click="selectDelete = false; selectAll = false"
			/>
		</div>
	</div>

	<livewire:pages.settings.categories.partials.add
		type="category"
		labelButton="Nova Categoria"
		placeholderInput="Nome da Categoria"
		wire:key="add-category"
	/>

	@foreach ($categories as $cat)
		<x-collapse
			class="group m-0.5 bg-base-100"
			wire:key="category-{{ $cat->id }}"
			separator
			x-data="{ checkCategory: false }"
		>
			<x-slot:heading>
				{{ $cat->name }}
			</x-slot:heading>
			<x-slot:content>
				<ul>
					<li>
						<livewire:pages.settings.categories.partials.add
							type="subcategory"
							labelButton="Nova Subcategoria"
							placeholderInput="Nome da Subcategoria"
							:category_id="$cat->id"
							:key="'add-subcategory-'.$cat->id"
						/>
					</li>
					{{-- Subcategories --}}
					@foreach ($cat->subcategories as $subcategory)
						<livewire:pages.settings.categories.partials.subcategories 
							:subcategory="$subcategory"
							:key="$subcategory->id"
						/>
					@endforeach
				</ul>
			</x-slot:content>
		</x-collapse>
	@endforeach

</div>
