<x-modal 
    wire:model="modalOpen" 
    title="{{ $title }}" 
>
    <x-form no-separator wire:submit="save">
        @if ($this->function == 'delete')
            <p>Deseja realmente excluír a conta {{ $this->form->name }}?</p>
            <span class="text-sm text-error">Todas as transações relacionadas a essa conta serão excluídas</span>
        @else

        <x-input 
            label="Nome" 
            placeholder="Conta Principal"
            hint="{{ $this->function == 'create' ? 'Coloque o nome que quiser, será vinculado o banco caso queira separar por banco em outras abas.' : '' }}" 
            wire:model="form.name"
        />

        <x-choices 
            label="Banco" 
            wire:model="form.bank_id" 
            :options="$results" 
            single 
            clearable 
            searchable
            placeholder="Pesquisar..."
            no-result-text="Nenhum resultado encontrado"
        >
            @scope('item', $r)
                <x-list-item :item="$r" sub-value="full_name">
                    <x-slot:avatar>
                        <x-icon name="o-user" class="bg-primary/10 p-2 w-9 h-9 rounded-full" />
                    </x-slot:avatar>
                </x-list-item>
            @endscope
        </x-choices>

        <x-input
            label="Número da Conta"
            hint="Campo opcional"
            type="number"
            placeholder="00000"
            wire:model="form.account_number"
        />

        @endif
        
        <x-slot:actions>
            <x-button label="Cancelar" wire:click="close" />
            @switch($this->function)
                @case('create')
                    <x-button label="Adicionar" class="btn-primary" type="submit" spinner="save" />
                    @break
            
                @case('edit')
                    <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
                    @break

                @case('delete')
                    <x-button label="Excluir" class="btn-primary" type="submit" spinner="save" />
                    @break
                    
            @endswitch
        </x-slot:actions>
    </x-form>
</x-modal>
