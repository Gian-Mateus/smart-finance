<x-modal wire:model="modalAddBudget" title="Novo Orçamento" subtitle="Separe orçamentos por categoria">
        <x-form no-separator wire:submit="save">
            @if (!$category)
            <x-choices
                label="Categoria"
                wire:model="category"
                :options="$categories"
                placeholder="Pesquisar categoria..."
                single
                searchable
                search-function="searchAny"
            />
            @else
            <x-choices
                label="Subcategoria"
                wire:model="subcategory"
                :options="$subcategories"
                placeholder="Pesquisar subcategoria..."
                single
                searchable
                search-function="searchAny"
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
                @if ($category)
                <x-button label="Adicionar" class="btn-primary" wire:click="dispacthSaveBudgetCategory" />
                @else
                <x-button label="Adicionar" class="btn-primary" wire:click="dispacthSaveBudgetSubcategory" />
                @endif
            </x-slot:actions>
        </x-form>
    {{-- Temporário - não está funcionando no app.js
    <script>
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, ''); // Remove non-digit characters
            value = value.replace(/(\d)(\d{2})$/, '$1,$2'); // Add comma before the last 2 digits (cents)
            value = value.replace(/(?=(\d{3})+(\D))\B/g, '.'); // Add period for thousands separator

            input.value = value;
        }
    </script> --}}
</x-modal>