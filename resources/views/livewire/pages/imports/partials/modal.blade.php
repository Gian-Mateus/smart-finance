<x-modal wire:model="modalOpen" title="Importação">
    <x-form wire:submit="save">
        {{-- {{dd($accounts)}} --}}
        <x-select 
            label="Selecione sua Conta" 
            wire:model="form.accountSelected" 
            :options="$accounts" 
        />

        <x-file wire:model="form.file" label="Arquivo OFX" hint="Only PDF" accept="application/ofx" />
        <x-slot:actions>
            <x-button label="Cancelar" wire:click="cancel" />
            <x-button label="Enviar" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</x-modal>
