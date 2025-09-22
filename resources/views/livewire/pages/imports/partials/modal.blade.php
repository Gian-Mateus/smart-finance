<x-modal wire:model="modalOpen" title="Importação">
    <x-form wire:submit="save">
        {{-- {{dd($accounts)}} --}}
        <x-select 
            label="Selecione sua Conta" 
            wire:model="form.accountSelected" 
            :options="$accounts"
            placeholder-value="1"
        />

        <x-file wire:model="form.file" label="Arquivo OFX" hint="Somente OFX" accept="application/ofx" />

        <div class="mt-2 text-sm">
            <span class="font-semibold">Obs.:</span>
            Se importar um arquivo que conter transações anteriores às já cadastradas, possivelmente terá que ajustar o saldo inicial e o sistema recalculará o histórico de saldos por transação, o que pode demorar alguns minutos.
        </div>
        <x-slot:actions>
            <x-button label="Cancelar" wire:click="cancel" />
            <x-button label="Enviar" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</x-modal>
