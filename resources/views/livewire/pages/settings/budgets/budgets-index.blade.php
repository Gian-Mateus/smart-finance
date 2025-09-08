<div class="ml-4 max-w-3xl mt-10">
    <x-header title="Orçamentos" subtitle="Define Orçamentos (teto de gastos) para cada categoria" separator />
    <x-button 
        label="Novo Orçamento" 
        class="btn-primary mb-10" 
        icon="s-plus-small"
        wire:click="newBudget('category')"
    />

    @foreach ($this->budgets as $budget)
    <div class="flex gap-1 mb-1 group">
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
                            <span>Recorrência:</span> {{ $budget->recurrenceTypes->type == 'custom' ? 'Customizado: '.$budget->recurrenceTypes->name : $budget->recurrenceTypes->name }}
                        </div>
                        <div>
                            Valor: R$ {{ $this->showBRL($budget->target_value) }}
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
                    wire:click="newBudget('subcategory', {{ $budget }})"
                />
                @endif
                <ul>
                    {{-- $sb == Subcategory Budget --}}
                    @if ($budget->subcategories)
                    @foreach ($budget->subcategories as $sb)
                    <li class="flex justify-between items-center rounded p-2 hover:bg-base-300">
                        <div>
                            <span>{{ $sb->budgetable->name }}</span>
                            <span>{{ $sb->recurrence }}:</span>
                            <span>R$ {{ $sb->target_value }}</span>
                        </div>
                        <x-dropdown>
                            <x-slot:trigger>
                                <x-button icon="m-ellipsis-vertical" class="btn-ghost opacity-0 transition-opacity duration-300 group-hover:opacity-100"/>
                            </x-slot:trigger>

                            <x-menu-item icon="o-trash" responsive title="Excluir" wire:click="deleteModal('subcategory', {{ $sb }})" />
                            <x-menu-item icon="c-pencil" label="Editar" responsive wire:click="editModal('subcategory', {{ $sb }})" />
                        </x-dropdown>
                    </li>
                    @endforeach
                    @endif
                </ul>

                @if (!$this->hasSubcategories($budget->budgetable_id))
                <span>Não há subcategorias cadastradas</span>
                @endif
            </x-slot:content>
        </x-collapse>
        <x-dropdown>
            <x-slot:trigger>
                <x-button icon="m-ellipsis-vertical" class="btn-ghost opacity-0 transition-opacity duration-300 group-hover:opacity-100"/>
            </x-slot:trigger>

            <x-menu-item icon="o-trash" responsive title="Excluir" wire:click="deleteModal('category', {{ $budget }})" />
            <x-menu-item icon="c-pencil" label="Editar" responsive wire:click="editModal('category', {{ $budget }})" />
        </x-dropdown>
    </div>
        @endforeach

    <livewire:pages.settings.budgets.partials.modal />
</div>
