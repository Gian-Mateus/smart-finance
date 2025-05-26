<div
	class="ml-4 max-w-3xl mt-10"
	x-data='{ 
		selectCategory: false, 
		selectAllCategory: false, 
		search: ""
	}'
>
	<x-header
		title="Categorias e Subcategorias"
		subtitle="Categorise seus gastos e receitas"
		separator
	/>
	{{-- Search, Delete and Add --}}
	<div class="grid">
		<div class="flex grid-cols-1 items-center gap-2">
			{{-- Search --}}
			<div class="flex-1">
				<x-input
					class="p-2"
					x-model="search"
					placeholder="Pesquisar"
					icon="m-magnifying-glass"
				/>
			</div>
			{{-- Delete Categories--}}
			<x-dropdown>
				<x-slot:trigger>
					<x-button icon="o-ellipsis-vertical" class="btn-circle" />
				</x-slot:trigger>

				<x-menu-item title="Excluir Categorias" @click="selectCategory = true" />
			</x-dropdown>
		</div>
		{{-- Select for delete Categories --}}
		<div
			class="m-2 flex items-center gap-x-2"
			x-show="selectCategory"
		>
			<x-checkbox
				label="Selecionar tudo"
				@click="selectAllCategory = ! selectAllCategory"
			/>
			<x-button
				class="btn-md"
				label="Excluir"
				icon="o-trash"
				@click="$wire.modalConfirmDelete = true"
			/>
			<x-button
				class="btn-md"
				label="Cancelar"
				icon="o-x-mark"
				@click="selectCategory = false; selectAllCategory = false"
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
				<div class="flex justify-between items-center group">
					<div>
						@if ($category->icon)
							<x-icon name="{{ $category->icon }}"/>
						@endif
						{{ $category->name }}
					</div>
					<x-checkbox 
						class="z-10" 
						x-show="$data.selectCategory" 
						x-bind:checked="$data.selectAllCategory"
						wire:model="deleteCategories.{{ $category->id }}"
						:key="uniqid()"
						id="{{ uniqid() }}"
					/>
					<x-button 
						class="btn-sm bg-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100 z-10"
						icon="c-pencil"
						responsive
						x-show="!$data.selectCategory"
						wire:click="openModalEdit({{ $category }})"
					/>
				</div>
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