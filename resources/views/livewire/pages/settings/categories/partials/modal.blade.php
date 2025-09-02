<x-modal 
		wire:model="modalOpen" 
		title="{{ $title }}" 
		class="backdrop-blur"
	>
	<x-form wire:submit="save">

	@switch($this->function)
		@case('create')
			<div class="flex gap-2 w-full">
				@if($this->type == 'category')
					<div class="self-end">
						<livewire:utils.searchIcons/>
					</div>
				@endif
				<div class="flex-1">
					<x-input label="Nome" placeholder="Ex.: Alimentação" wire:model="form.name"/>
				</div>
			</div>
			@break
		@case('edit')
			<div class="flex gap-2 w-full">
				@if($this->type == 'category')
					<div class="self-end">
						<livewire:utils.searchIcons :iconSelect="$this->form->icon"/>
					</div>
				@endif
				<div class="flex-1">
					<x-input label="Nome" wire:model="form.name" />
				</div>
			</div>
			@break
		@case('delete')
			<div>
				Você realmente deseja excluír {{ $this->form->name }}?
			</div>
			@if($this->type == 'category')
				<span class="text-sm text-error">Ao excluir uma categoria, todas suas subcategorias serão excluídas também.</span>
			@endif
			@break
	@endswitch
	<x-slot:actions>
		<x-button
			label="Cancelar"
			wire:click="close"
		/>
		@switch($this->function)
			@case('create')
				<x-button
					label="Adicionar"
					type="submit"
					spinner="save"
				/>
				@break

			@case('edit')
				<x-button
					label="Salvar"
					type="submit"
					spinner="save"
				/>
				@break

			@case('delete')
				<x-button
					label="Excluir"
					type="submit"
					spinner="save"
				/>
				@break
				
		@endswitch
	</x-slot:actions>
	
	</x-form>
</x-modal>
