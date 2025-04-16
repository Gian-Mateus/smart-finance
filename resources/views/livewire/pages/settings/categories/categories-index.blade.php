<div
	class="ml-4 max-w-3xl"
	x-data="{ selectDelete: false, selectAll: false }"
>
	<x-header
		title="Categorias e Subcategorias"
		separator
	/>

	<div class="grid">
		<div class="flex grid-cols-1 items-center gap-2">
			<livewire:pages.settings.categories.partials.search />
			<x-button
				icon="o-trash"
				@click="selectDelete = ! selectDelete"
			/>
		</div>
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

			/>
		</div>
	</div>

	<livewire:pages.settings.categories.partials.add
		type="category"
		labelButton="Nova categoria"
		placeholderInput="Nome da categoria"
		wire:key="add-category"
	/>

	@foreach ($categories as $cat)
		<x-collapse
			class="group m-0.5 bg-base-100"
			wire:key="category-{{ $cat->id }}"
			separator
			x-data="{ checkCategory: false }"
		>
			<x-slot:heading class="flex items-center justify-between">
				<div>
					{{ $cat->name }}
				</div>
				<div class="absolute right-12 flex items-center gap-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100">

					{{-- Button Edit Category --}}
					<x-button
						class="btn-sm"
						x-show="!selectDelete"
						icon="c-pencil"
						responsive
					/>
				</div>
				<x-checkbox
					class="z-20 mr-4"
					x-bind:checked="selectAll"
					x-show="selectDelete"
					right
					@click="checkCategory = ! checkCategory"
				/>
		</x-slot:heading>
		<x-slot:content>
			<ul>
				{{-- Add Subcategory --}}
				<li>
					<livewire:pages.settings.categories.partials.add
						type="subcategory"
						labelButton="Nova subcategoria"
						placeholderInput="Nome da subcategoria"
						:category_id="$cat->id"
						wire:key="add-subcategory-{{ $cat->id }}"
					/>
				</li>
				@foreach ($cat->subcategories as $sub)
					{{-- List Subcategories --}}
					<livewire:pages.settings.categories.partials.subcategories
						:subcategories="$sub"
						:category_id="$cat->id"
					/>
				@endforeach
				</ul>
			</x-slot:content>
		</x-collapse>
	@endforeach

</div>
