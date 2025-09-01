<x-modal 
    wire:model="modalOpen" 
    title="{{ $title }}" 
>
    <div class="flex flex-col gap-2">
        @switch($this->type)
            @case('category')
                <x-choices
                    label="Categoria"
                    wire:model="form.budgetable_id"
                    :options="$options"
                    placeholder="Pesquisar categoria..."
                    single
                    searchable
                    search-function="searchOptions"
                />
                @break

            @case('subcategory')
                <x-choices
                    label="Subcategoria"
                    wire:model="form.budgetable_id"
                    :options="$options"
                    placeholder="Pesquisar subcategoria..."
                    single
                    searchable
                    search-function="searchOptions"
                />
                @break
        @endswitch

        <x-input
            id="targetValueInput"
            placeholder="0,00"
            prefix="R$"
            wire:model="form.target_value"
            oninput="formatCurrency(this)"
        />

        <x-select
            icon="o-clock"
            label="Recorrência"
            wire:model="form.recurrece"
            :options="$recurrences"
        />

        <x-slot:actions>
            <x-button label="Cancelar" wire:click="close" />
            <x-button label="Adicionar" class="btn-primary" wire:click="save" />
        </x-slot:actions>
    </div>
    
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
