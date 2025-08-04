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

	<x-button label="Nova Categoria" icon="o-plus" class="my-4 btn-primary" wire:click="new('category')"/>

	@foreach ($this->categories as $category)
	<div class="flex gap-1 mb-1 group">
		<x-collapse collapse-plus-minus separator>
		   <x-slot:heading>
			   <div class="flex items-center gap-2">
				   @if ($category->icon)
					   <x-icon name="{{ $category->icon }}"/>
				   @endif
				   <h4>{{ $category->name }}</h4>
			   </div>
		   </x-slot:heading>
		   <x-slot:content>
			   <ul>
				   <li>
				   		<x-button label="Nova Subcategoria" icon="o-plus" class="btn-primary" wire:click="new('subcategory', {{ $category }})"/>
				   </li>
				   {{-- Subcategories --}}
				   @foreach ($category->subcategories as $subcategory)
				   <li class="group/subcat relative flex items-center justify-between rounded p-2 hover:bg-base-300">
					   <div>
						   {{ $subcategory->name }}
					   </div>
					   <x-dropdown right>
							<x-slot:trigger>
								<x-button icon="m-ellipsis-vertical" class="btn-ghost opacity-0 transition-opacity duration-300 group-hover/subcat:opacity-100"/>
							</x-slot:trigger>

							<x-menu-item icon="o-trash" responsive title="Excluir" wire:click="deleteModal('subcategory', {{ $subcategory }})" />
							<x-menu-item icon="c-pencil" label="Editar" responsive 
							wire:click="editModal('subcategory', {{ $subcategory }})" />		
						</x-dropdown>
				   </li>
				   @endforeach
			   </ul>
		   </x-slot:content>
	   	</x-collapse>
		<x-dropdown right>
			<x-slot:trigger>
				<x-button icon="m-ellipsis-vertical" class="btn-ghost opacity-0 transition-opacity duration-300 group-hover:opacity-100"/>
			</x-slot:trigger>

			<x-menu-item icon="o-trash" responsive title="Excluir" wire:click="deleteModal('category', {{ $category }})"/>
			<x-menu-item icon="c-pencil" label="Editar" responsive 
			wire:click="editModal('subcategory', {{ $category }})" />		
		</x-dropdown>
	</div>
	@endforeach
 
	<livewire:pages.settings.categories.partials.modal />
</div>