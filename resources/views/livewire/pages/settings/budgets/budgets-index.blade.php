<div class="ml-4 max-w-3xl mt-10">
    <x-header title="Orçamentos/Metas" subtitle="Define Metas e Orçamentos (de gastos) para cada categoria" separator />
    <x-button 
        label="Novo Orçamento" 
        class="btn-primary mb-10" 
        icon="s-plus-small"
        wire:click="addBudgetCategory"
        />
        {{ dd($this->budgets) }}
        @foreach ($this->budgets as $budget)
        <x-collapse separator class="mt-0.5">
            <x-slot:heading>
                <div class="flex justify-between items-center">
                    <span>
                        {{ $budget->name }}
                    </span>
                    <div>
                        <span>
                            {{ $budget->recurrence }}:
                        </span>
                        <span>
                           R$ {{ $budget->target_value }}
                        </span>
                    </div>
                </div>
            </x-slot:heading>
            <x-slot:content>
                {{-- @if ($this->hasSubcategories($budget->category_id))
                <x-button 
                    label="Novo Orçamento Subcategoria" 
                    class="btn-primary mb-10" 
                    icon="s-plus-small"
                    wire:click="addBudgetSubcategory({{ $budget->category_id }})"
                />
                @endif
                @if ($budget->subcategory)    
                    <ul>
                        @foreach ($budget->subcategory as $sub)    
                            <li class="flex justify-between items-center rounded p-2 hover:bg-base-300">
                                <span>{{ $sub->subcategory->name }}</span>
                                <div>
                                    <span>{{ $sub->recurrence }}:</span>
                                    <span>R$ {{ $sub->target_value }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if (!$this->hasSubcategories($budget['category']->category_id))
                <span>Não há subcategorias cadastradas</span>
                @endif --}}
                </x-slot:content>
            </x-collapse>
    @endforeach

    <livewire:pages.settings.budgets.partials.modal />
</div>
