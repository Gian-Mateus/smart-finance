<div>
	<x-modal 
		wire:model="modalOpen" 
		title="{{ $title }}" 
		class="backdrop-blur"
	>
	@if($modal['function'] == "create")
	<div class="flex gap-2 w-full">
		@if($modal['type'] == "category")
		<div class="self-end">
			<livewire:utils.searchIcons/>
		</div>
		@endif
		<div class="flex-1">
			<x-input label="Nome" placeholder="Ex.: Alimentação" wire:model="name"/>
		</div>
	</div>
	@endif
	@if($modal['function'] == "delete")
	<div>
		Você realmente deseja excluír {{ $modal['data']['name'] }}?
	</div>
		@if($modal["type"] == "category")
		<span class="text-sm text-error">Ao excluir uma categoria, todas suas subcategorias serão excluídas também.</span>
		@endif
	@endif

	@if($modal['function'] == "edit")
	<div class="flex gap-2 w-full">
		@if($modal["type"] == "category")
		<div class="self-end">
			<livewire:utils.searchIcons :iconSelect="$modal['data']['icon']"/>
		</div>
		@endif
		<div class="flex-1">
			<x-input label="Nome" wire:model="name" />
		</div>
	</div>
	@endif
	<x-slot:actions>
		<x-button
			label="Cancelar"
			wire:click="close"
		/>
		<x-button
			label="Confirmar"
			wire:click="confirm"
		/>
	</x-slot:actions>
	</x-modal>
</div>
