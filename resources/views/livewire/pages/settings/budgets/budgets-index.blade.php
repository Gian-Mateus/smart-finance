<div class="ml-4 max-w-3xl mt-10">
    <x-header title="Orçamentos/Metas" subtitle="Define Metas e Orçamentos (de gastos) para cada categoria" separator />
    <x-button 
        label="Novo Orçamento" 
        class="btn-primary mb-10" 
        icon="s-plus-small"
        @click="$wire.modalAddBudget = true"
    />

    {{-- {{ dd($this->budgets) }} --}}
        
    @foreach ($this->budgets as $budget)
        <x-collapse separator class="mt-0.5">
            <x-slot:heading>
                {{-- {{ dd($budget['category']->category->name) }} --}}
                <div class="flex justify-between items-center">
                    <span>
                        {{  $budget['category']->category->name }}
                    </span>
                    <span>
                       R$ {{ $budget['category']->target_value_formatted }}
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
                                <span>R$ {{ $sub->target_value_formatted }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
                </x-slot:content>
            </x-collapse>
    @endforeach

    <x-modal wire:model="modalAddBudget" title="Novo Orçamento" subtitle="Separe orçamentos por categoria">
        <x-form no-separator>
        <!-- <x-choices
            label="Categoria ou Subcategoria"
            wire:model="categoryOrSubcategory"
           // :options="$categoriesAndSubcategories"
            placeholder="Pesquisar categoria ou subcategoria..."
            single
            searchable 
        /> -->
    
            <x-slot:actions>
                <x-button label="Cancelar" @click="$wire.modalAddBudget = false" />
                <x-button label="Adicionar" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-modal>

</div>
