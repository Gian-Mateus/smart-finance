<div class="flex flex-col h-full">
    <div class="flex gap-4 mt-4">
        <div class="relative">
            @if($avatar)
            <img src="{{ $avatar }}" alt="" class="rounded-full max-w-sm max-h-sm h-24 w-24 ">
            @else
            <div class="rounded-full bg-base-300 h-24 w-24 flex items-center justify-center text-4xl font-bold text-base-content">
                {{ strtoupper(substr($name, 0, 1)) }}
            </div>
            @endif
            <x-button
                icon="o-pencil" 
                class="btn-ghost rounded-full p-2 absolute -top-2 -right-4"
                wire:click="$dispatch('openModal')"
            />
        </div>
        <h1 class="font-bold text-2xl flex items-center">{{ $name }}</h1>
    </div>
    <x-menu-separator />

    <div class="flex flex-col w-full h-full">
        <div class="flex flex-col">
            <div x-data="{ isEditing: false, originalName: @js($name) }">
                <x-input
                    label="Nome"
                    x-bind:disabled="!isEditing"
                    wire:model="name"
                    class="disabled:text-base-content cursor-default w-min">
                    <x-slot:append>
                        <div class="flex join-item">
                            <x-button
                                icon="o-pencil"
                                x-show="!isEditing"
                                @click="isEditing = true"
                                class="btn-secondary" />
                            <x-button
                                icon="o-check"
                                x-show="isEditing"
                                class="btn-success"
                                wire:click="updateName"
                                @click="isEditing = false" />
                            <x-button
                                icon="o-x-mark"
                                x-show="isEditing"
                                @click="isEditing = false; $wire.set('name', originalName)"
                                class="btn-error" />
                        </div>
                    </x-slot:append>
                </x-input>
            </div>

            <x-input
                label="E-mail"
                disabled
                value="{{ $email }}"
                class="disabled:text-base-content cursor-default w-min" />
        </div>

        <div class="mt-10">
            <x-button
                label="Redefinir senha"
                class="btn-primary"
                icon="o-key"
                wire:click="modalResetPassword(true)" />
        </div>

        <div class="mt-10">
            <x-header title="Suas contas" size="text-xl" separator />
            {{-- {{ dd($accounts) }} --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($accounts as $account)
                <a href="{{ route('banks') }}">
                    <x-card title="{{ $account->name }}" shadow separator>
                        <span>Banco: </span>
                        {{ $account->bank->name }}
                    </x-card>
                </a>
                @endforeach
            </div>
        </div>

        <div class="mt-auto">
            <x-button label="Excluir conta" icon="o-trash" class="btn-error" />
        </div>

        <livewire:pages.profile.partials.modal-reset-password />
    </div>
</div>