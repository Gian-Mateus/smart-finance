<div class="ml-4 max-w-3xl mt-10">
    <x-header title="Orçamentos/Metas" subtitle="Define Metas e Orçamentos para cada categoria" separator />
    <x-button 
        label="Novo Orçamento" 
        class="btn-primary" 
        icon="s-plus-small"
        @click="$wire.modalAddBudget = true"
    />
    @foreach ($this->budgets as $budget)
        <x-collapse separator class="mt-10">
            <x-slot:heading>
                <div class="flex justify-between items-center">
                    <span>
                        {{  $budget->category->name }}
                    </span>
                    <span>
                        {{ $budget->formatted_target_value }}
                    </span>
                </div>
                <span>
                    <x-progress value="12" max="100" class="progress-warning h-3" />
                </span>
            </x-slot:heading>
            <x-slot:content>
                <ul>
                    @foreach ($budget->category->subcategories as $subcategory)
                        <li class="flex justify-between items-center rounded p-2 hover:bg-base-300">
                            <span>{{ $subcategory->name }}</span>
                        </li>
                    @endforeach
                </ul>
            </x-slot:content>
        </x-collapse>
    @endforeach

    <x-modal wire:model="modalAddBudget" title="Novo Orçamento" subtitle="Separe orçamentos por categoria ou subcategoria">
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
