<div class="ml-4 max-w-3xl mt-10">
    <x-header title="Contas" subtitle="Organize quantas suas contas" separator />

    <x-button 
        label="Adicionar Conta" 
        class="btn-primary" 
        icon="s-plus-small"
        @click="$wire.modalAddAccount = true"
    />
    
    <div class="grid gap-4 grid-cols-2 mt-10">
        {{-- List Accounts Created --}}

        @foreach ($this->bankAccount as $ba)     
        <x-card title="{{ $ba->name }}" shadow separator class="relative group/card">
            <x-button 
                icon="c-pencil" 
                class="btn-circle absolute top-2 right-4 group-hover/card:opacity-100 opacity-0 transition-all durantion-300 ease-in"
                @click="$wire.openModalEdit({{ $ba }}); $wire.modalEditAccount = true"
            />
            <x-list-item :item="$ba">
                <x-slot:avatar>
                    <x-icon name="o-user" class="bg-primary/10 p-2 w-9 h-9 rounded-full" />
                </x-slot:avatar>
                <x-slot:value>
                    {{ $ba->bank->name }}
                </x-slot:value>
                <x-slot:sub-value>
                    <div class="flex flex-col">
                        <span>
                            {{ $ba->bank->full_name }}
                        </span>
                        <span>
                            Conta: {{ $ba->account_number ?? "Não informado" }}
                        </span>
                    </div>
                </x-slot:sub-value>
            </x-list-item>
        </x-card>
        @endforeach
    </div>

    {{-- Modal to Add Account --}}
    <x-modal 
        wire:model="modalAddAccount" 
        title="Adicionar Conta" 

    >
        <x-form no-separator wire:submit="save">
            <x-input 
                label="Nome" 
                placeholder="Conta Principal"
                hint="Coloque o nome que quiser, será vinculado o banco caso queira separar por banco em outras abas." 
                wire:model="name"
            />

            <x-choices 
                label="Banco" 
                wire:model="bankSearchableID" 
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
                wire:model="account_number"
            />

            <x-slot:actions>
                <x-button label="Cancelar" @click="$wire.modalAddAccount = false" />
                <x-button label="Adicionar" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-form>
    </x-modal>

    {{-- Modal to Edit Account --}}
    <x-modal 
        wire:model="modalEditAccount" 
        title="Editando: {{ $accountEditing['name'] ?? '' }}"
    >
        <x-form no-separator wire:submit="update">
            <x-input 
                label="Nome" 
                value="{{ $accountEditing['name'] ?? '' }}" 
                wire:model="accountEditing.name"
            />
            <x-choices 
                label="Banco"
                wire:model="bankEditing" 
                :options="$results"
                single 
                clearable 
                searchable
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
                wire:model="accountEditing.account_number"
            />

            <x-slot:actions>
                <x-button label="Cancelar" @click="$wire.modalEditAccount = false" />
                <x-button label="Salvar" class="btn-primary" type="submit" spinner="update" />
            </x-slot:actions>
        </x-form>
    </x-modal>

</div>
