<div>
	<x-modal wire:model="modalCS" title="Hello" subtitle="Livewire example" separator>
		<div>Hey!</div>

		<x-slot:actions>
			<x-button label="Cancel" @click="$wire.modalCS = false" />
			<x-button label="Confirm" class="btn-primary" />
		</x-slot:actions>
	</x-modal>
</div>
