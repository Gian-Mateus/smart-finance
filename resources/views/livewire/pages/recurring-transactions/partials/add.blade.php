<div>
    <x-form wire:submit.prevent="save" class="max-w-2xl space-y-6">
        <x-input
            label="Nome"
            required
            placeholder="Ex: Aluguel, Netflix, Plano de Internet"
            wire:model.defer="name"
        />

        <x-textarea
            label="Descrição"
            placeholder="Opcional: informações sobre a transação"
            wire:model.defer="description"
        />
        
        <x-select
            label="Tipo"
            wire:model.defer="selectedType"
            :options="$selectsTypes"
            optionLabel="label"
            optiooptionValue="id"
        />

        <x-slot:actions>
            <x-button label="Cancelar" type="button" icon="o-x-mark"/>
            <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" icon="o-check-circle"/>
        </x-slot:actions>
    </x-form>
</div>
