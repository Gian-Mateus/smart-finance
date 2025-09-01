<div class="ml-4 max-w-3xl mt-10">
    <x-header title="Contas" subtitle="Organize quantas suas contas" separator />

    <x-button 
        label="Adicionar Conta" 
        class="btn-primary" 
        icon="s-plus-small"
        wire:click="openModal('create')"
    />
    
    <div class="grid gap-4 grid-cols-1 md:grid-cols-2 mt-10">
        {{-- List Accounts Created --}}

        @foreach ($this->bankAccount as $ba)     
        <x-card title="{{ $ba->name }}" shadow separator class="relative">
            <div class="absolute top-2 right-2">
                <x-button 
                    icon="c-pencil" 
                    class="btn-circle btn-ghost btn-sm"
                    wire:click="openModal('edit', {{ $ba }})"
                />
                <x-button 
                    icon="o-trash" 
                    class="btn-circle btn-ghost btn-sm"
                    wire:click="openModal('delete', {{ $ba }})"
                />
            </div>
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

    <livewire:pages.settings.banks.partials.modal />

</div>
