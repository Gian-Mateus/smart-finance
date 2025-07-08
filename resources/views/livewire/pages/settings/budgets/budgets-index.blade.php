<div class="ml-4 max-w-3xl mt-10">
    <x-header title="Orçamentos/Metas" subtitle="Define Metas e Orçamentos (de gastos) para cada categoria" separator />
    <x-button 
        label="Novo Orçamento" 
        class="btn-primary mb-10" 
        icon="s-plus-small"
        @click="$wire.modalAddBudget = true"
    />

    @foreach ($this->budgets as $budget)
        <x-collapse separator class="mt-0.5">
            <x-slot:heading>
                {{-- {{ dd($budget['category']->category->name) }} --}}
                <div class="flex justify-between items-center">
                    <span>
                        {{  $budget['category']->category->name }}
                    </span>
                    <span>
                       R$ {{ $budget['category']->target_value }}
                    </span>
                </div>
            </x-slot:heading>
            <x-slot:content>
                @if ($budget['subcategories'])    
                    <ul>
                        @foreach ($budget['subcategories'] as $sub)    
                        {{-- {{ dd($sub->subcategory) }} --}}
                            <li class="flex justify-between items-center rounded p-2 hover:bg-base-300">
                                <span>{{ $sub->subcategory->name }}</span>
                                <span>R$ {{ $sub->target_value }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
                </x-slot:content>
            </x-collapse>
    @endforeach

    <x-modal wire:model="modalAddBudget" title="Novo Orçamento" subtitle="Separe orçamentos por categoria">
        <x-form no-separator wire:submit="save">
            <x-choices
                label="Categoria"
                wire:model="categoryOrSubcategory"
                :options="$categoriesAndSubcategories"
                placeholder="Pesquisar categoria..."
                single
                searchable
            />

            <x-input 
                id="targetValueInput"
                placeholder="0,00" 
                prefix="R$"
                wire:model="targetValue"
                oninput="formatCurrency(this)"
            />
            
            {{-- {{ dd($recurrences) }} --}}
            <x-select 
                icon="o-clock"
                label="Recorrência"
                placeholder="Selecione a recorrência"
                wire:model="recurrence"
                :options="$recurrences"
            />

            {{-- {{ dd($this->categoriesAndSubcategories[0]->id) }} --}}
            <x-slot:actions>
                <x-button label="Cancelar" @click="$wire.cancel, $wire.modalAddBudget = false" />
                <x-button label="Adicionar" class="btn-primary" wire:click="save" />
            </x-slot:actions>
        </x-form>
    </x-modal>

    {{-- Temporário - não está funcionando no app.js --}}
    <script>
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, ''); // Remove non-digit characters
            value = value.replace(/(\d)(\d{2})$/, '$1,$2'); // Add comma before the last 2 digits (cents)
            value = value.replace(/(?=(\d{3})+(\D))\B/g, '.'); // Add period for thousands separator

            input.value = value;
        }
    </script>
</div>
