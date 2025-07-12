<div class="ml-4 max-w-3xl mt-10">
    <x-header title="Orçamentos/Metas" subtitle="Define Metas e Orçamentos (de gastos) para cada categoria" separator />
    <x-button 
        label="Novo Orçamento" 
        class="btn-primary mb-10" 
        icon="s-plus-small"
        wire:click="addBudgetCategory"
    />

    @foreach ($this->budgets as $budget)
        <x-collapse separator class="mt-0.5">
            <x-slot:heading>
                <div class="flex justify-between items-center">
                    <span>
                        {{ $budget['category']->category->name }}
                    </span>
                    <span>
                       R$ {{ $budget['category']->target_value }}
                    </span>
                </div>
            </x-slot:heading>
            <x-slot:content>
                <x-button 
                    label="Novo Orçamento Subcategoria" 
                    class="btn-primary mb-10" 
                    icon="s-plus-small"
                    wire:click="addBudgetSubcategory({{ $budget['category']->category_id }})"
                />
                @if ($budget['subcategories'])    
                    <ul>
                        @foreach ($budget['subcategories'] as $sub)    
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

    <livewire:pages.settings.budgets.partials.modal />
</div>
