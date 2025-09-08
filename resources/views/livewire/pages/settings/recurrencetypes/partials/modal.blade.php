<x-modal wire:model="modalOpen" title="{{ $title }}">
    <x-form>

        <x-select
            label="Tipos de recorrência"
            placeholder="Selecione o tipo"
            wire:model.live="form.typeSelected"
            :options="$selectsTypes"
            option-label="label"
        />

        @if ($form->typeSelected == "interval")
        <x-input label="A cada quantos dias?" placeholder="Ex.: 45" type="number"/>
        @endif

        @if ($form->typeSelected == "day_of_month")
        <x-input label="Todo dia:" placeholder="Ex.: 3" type="number"/>
        @endif

        <x-slot:actions>
            <x-button label="Cancel" wire:click="close" />
            <x-button label="Confirm" class="btn-primary" />
        </x-slot:actions>
    </x-form>
</x-modal>
