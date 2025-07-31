<div class="ml-4 max-w-3xl mt-10">
    <x-header title="Orçamentos/Metas" subtitle="Define Metas e Orçamentos (de gastos) para cada categoria" separator />
    <x-button 
        label="Novo Orçamento" 
        class="btn-primary mb-10" 
        icon="s-plus-small"
        wire:click="newBudget"
    />
        
    {{-- {{ dd($this->budgets) }} --}}
    @foreach ($this->budgets as $budget)
    {{-- {{ dd($budget->subcategories) }} --}}
        <x-collapse separator class="mt-0.5">
            <x-slot:heading>
                <div>
                    <div class="flex items-center gap-4 mb-2">
                        @if($budget->budgetable->icon != null)
                            <x-icon :name="$budget->budgetable->icon"/>
                        @endif
                        <div class="font-bold">
                            {{ $budget->budgetable->name }}
                        </div>
                    </div>
                    <div class="text-sm">
                        <div>
                            <span>Recorrência:</span> {{ $budget->recurrence }}
                        </div>
                        <div>
                            Valor: R$ {{ $budget->target_value }}
                        </div>
                    </div>
                </div>
            </x-slot:heading>
            <x-slot:content>
                @if ($this->hasSubcategories($budget->budgetable_id))
                <x-button 
                    label="Novo Orçamento Subcategoria" 
                    class="btn-primary mb-10" 
                    icon="s-plus-small"
                    wire:click="newBudget({{ $budget->budgetable_id }})"
                />
                @endif
                <ul>
                    {{-- $sb == Subcategory Budget --}}
                    @if ($budget->subcategories)
                    @foreach ($budget->subcategories as $sb)
                    <li class="flex justify-between items-center rounded p-2 hover:bg-base-300">
                        <span>{{ $sb->budgetable->name }}</span>
                        <div>
                            <span>{{ $sb->recurrence }}:</span>
                            <span>R$ {{ $sb->target_value }}</span>
                        </div>
                    </li>
                    @endforeach
                    @endif
                </ul>

                @if (!$this->hasSubcategories($budget->budgetable_id))
                <span>Não há subcategorias cadastradas</span>
                @endif
                </x-slot:content>
            </x-collapse>
        @endforeach

    <livewire:pages.settings.budgets.partials.modal />
</div>
