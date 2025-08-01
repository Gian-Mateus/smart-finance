<div>
    @if($modal && $modal["function"] == "create" && $modal["type"] == "category")
	<x-modal 
		wire:model="modalOpen" 
		title="Nova Categoria" 
		class="backdrop-blur"
	>
	<livewire:utils.searchIcons/>
	<x-input label="Nome" placeholder="Ex.: Alimentação" wire:model="name"/>
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
	@endif
</div>
