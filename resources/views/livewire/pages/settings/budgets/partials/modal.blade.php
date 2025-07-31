<x-modal wire:model="modalAddBudget" title="Novo Orçamento" subtitle="Define Metas e Orçamentos (de gastos) para cada categoria">
    <x-form no-separator wire:submit="save">

        @if (!$parentId)
        <x-choices
            label="Categoria"
            wire:model="budgetableId"
            :options="$options"
            placeholder="Pesquisar categoria..."
            single
            searchable
            search-function="searchOptions"
        />
        @else
        <x-choices
            label="Subcategoria"
            wire:model="budgetableId"
            :options="$options"
            placeholder="Pesquisar subcategoria..."
            single
            searchable
            search-function="searchOptions"
        />
        @endif

        <x-input
            id="targetValueInput"
            placeholder="0,00"
            prefix="R$"
            wire:model="targetValue"
            oninput="formatCurrency(this)"
        />

        <x-select
            icon="o-clock"
            label="Recorrência"
            placeholder="Selecione a recorrência"
            wire:model="recurrence"
            :options="$recurrences"
        />
        <x-slot:actions>
            <x-button label="Cancelar" wire:click="cancel" />
            <x-button label="Adicionar" class="btn-primary" wire:click="save" />
        </x-slot:actions>
    </x-form>
    {{-- Temporário - não está funcionando no app.js (dentro Firebase Studio) --}}
    <script>
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, ''); // Remove non-digit characters
            value = value.replace(/(\d)(\d{2})$/, '$1,$2'); // Add comma before the last 2 digits (cents)
            value = value.replace(/(?=(\d{3})+(\D))\B/g, '.'); // Add period for thousands separator

            input.value = value;
        }
    </script>
</x-modal>
