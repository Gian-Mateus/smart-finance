<x-modal 
    wire:model="modalOpen" 
    title="{{ $title }}" 
>
    <x-form wire:submit="save" class="flex flex-col gap-2">
        @if ($this->function == "delete")
            <p class="text-md">Tem certeza que deseja excluir este orçamento?</p>
        @else

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
            placeholder="Selecione a recorrência"
            wire:model="form.recurrence_types_id"
            :options="$this->recurrences"
        />

        @endif

        <x-slot:actions>
            <x-button label="Cancelar" wire:click="close" />
            @switch($this->function)
                @case('create')
                    <x-button label="Adicionar" class="btn-primary" type="submit" spinner="save"/>
                    @break
                @case('edit')
                    <x-button label="Salvar" class="btn-primary" type="submit" spinner="save"/>
                    @break
                @case('delete')
                    <x-button label="Excluir" class="btn-primary" type="submit" spinner="save"/>
                    @break
            @endswitch
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
