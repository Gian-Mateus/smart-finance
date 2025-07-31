<div
	class="ml-4 max-w-3xl mt-10"
	x-data='{search: ""}'
>
	<x-header
		title="Categorias e Subcategorias"
		subtitle="Categorise seus gastos e receitas"
		separator
	/>
	{{-- Search, Delete and Add --}}
	<div class="flex items-center gap-2">
		{{-- Search --}}
		<div class="flex-1">
			<x-input
				class="p-2"
				x-model="search"
				placeholder="Pesquisar"
				icon="m-magnifying-glass"
			/>
		</div>
	</div>

	<livewire:pages.settings.categories.partials.add
		type="category"
		labelButton="Nova Categoria"
		placeholderInput="Nome da Categoria"
	/>

	@foreach ($this->categories as $category)
		<x-collapse
			class="group m-0.5 bg-base-100"
			separator
			id="{{ uniqid() }}"
			x-data="{
				name: '{{ strtolower($category->name) }}'
			}"
			x-show="$data.name.includes($data.search.toLowerCase())"
		>
			<x-slot:heading>
				@if ($category->icon)
					<x-icon name="{{ $category->icon }}"/>
				@endif
				<h4>
					{{ $category->name }}
				</h4>
				
				<x-dropdown class="z-10">
					<x-slot:trigger>
						<x-button icon="m-ellipsis-vertical" class="btn-ghost hover:bg-red-500"/>
					</x-slot:trigger>
				
					<x-button
						class="btn-sm"
						icon="o-trash"
						responsive
					/>
					<x-button 
						class="btn-sm"
						icon="c-pencil"
						responsive
						x-show="!$data.selectCategory"
						wire:click="openModalEdit({{ $category }})"
					/>
				</x-dropdown>
			</x-slot:heading>
			<x-slot:content>
				<ul>
					<li>
						<livewire:pages.settings.categories.partials.add
							type="subcategory"
							labelButton="Nova Subcategoria"
							placeholderInput="Nome da Subcategoria"
							:category_id="$category->id"
							:key="uniqid()"
						/>
					</li>
					{{-- Subcategories --}}
					@foreach ($category->subcategories as $subcategory)
					<li class="group/subcat relative flex items-center justify-between rounded p-2 hover:bg-base-300">
						<div>
							{{ $subcategory->name }}
						</div>
						<div class="flex items-center justify-between pr-6 gap-2 opacity-0 transition-opacity duration-300 group-hover/subcat:opacity-100">
							{{-- Button Edit SubCategory --}}
							<x-button
								class="btn-sm"
								icon="c-pencil"
								responsive
								wire:click="openModalEdit({{ $subcategory }})"
							/>
							<x-button
								class="btn-sm"
								icon="o-trash"
								responsive
								wire:click="deleteSubcategory({{ $subcategory->id }})"
							/>
						</div>
					</li>
					@endforeach
				</ul>
			</x-slot:content>
		</x-collapse>
	@endforeach

	{{-- Modal Confirm Delete --}}
	<x-modal 
		wire:model="modalConfirmDelete" 
		title="Excluir Categoria(s)" 
		class="backdrop-blur"
	>
		Ao excluir uma categoria, todas as suas subcategorias serão excluídas.
		<x-slot:actions>
			<x-button
				label="Cancelar"
				wire:click="$set('modalConfirmDelete', false)"
			/>
			<x-button
				label="Confirmar"
				wire:click="delete"
			/>
		</x-slot:actions>
	</x-modal>

	{{-- Modal Confirm Edit/Update --}}
	<x-modal 
		wire:model="modalEdit" 
		title="Editando..." 
		subtitle="{{ $editing['name'] ?? '' }}"
		class="backdrop-blur"
	>
		<x-form no-separator>
			<div class="flex items-center gap-2">
				<livewire:utils.search-icons />
				
				<div class="w-full">
					<x-input
						type="text"
						value="{{ $editing['name'] ?? '' }}"
						wire:model="editing.name"
					/>
				</div>
			</div>

			<x-slot:actions>
				<x-button
					label="Cancelar"
					wire:click="$set('modalEdit', false)"
				/>
				<x-button
					label="Confirmar"
					wire:click="update"
				/>
			</x-slot:actions>
		</x-form>
	</x-modal>
</div>