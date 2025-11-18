<div class="flex flex-col h-full">
    <div class="flex gap-4 mt-4">
        <img src="https://picsum.photos/200/300" alt="" class="rounded-full max-w-sm max-h-sm h-24 w-24 ">
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
                    class="disabled:text-base-content cursor-default w-min"
                >
                    <x-slot:append>
                        <div class="flex join-item">
                            <x-button
                                icon="o-pencil"
                                x-show="!isEditing"
                                @click="isEditing = true"
                                class="btn-secondary"
                            />
                            <x-button
                                icon="o-check"
                                x-show="isEditing"
                                class="btn-success"
                                wire:click="updateName"
                                @click="isEditing = false"
                            />
                            <x-button
                                icon="o-x-mark"
                                x-show="isEditing"
                                @click="isEditing = false; $wire.set('name', originalName)"
                                class="btn-error"
                            />
                        </div>
                    </x-slot:append>
                </x-input>
            </div>

            <x-input
                label="E-mail"
                disabled
                value="{{ $email }}"
                class="disabled:text-base-content cursor-default w-min"
            />
        </div>

        <div class="mt-10">
            <x-button
                label="Redefinir senha"
                class="btn-primary"
                icon="o-key"
                wire:click="$set('modalResetPassword', true)"
            />
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

        <x-modal
            wire:model="modalResetPassword"
            title="Redefinir senha"
            class="backdrop-blur00"
        >
            <div x-data="{
                newPassword: '',
                confirmPassword: '',
                passwordsMatch: true,
                checkPasswords() {
                    if (this.confirmPassword !== '') {
                        this.passwordsMatch = this.newPassword === this.confirmPassword;
                        $wire.set('newPassword', this.newPassword);
                    }
                }
            }">
                <x-password
                    label="Senha atual"
                    type="password"
                    only-password
                    wire:model="currentPassword"
                />

                <x-password
                    label="Nova senha"
                    type="password"
                    right
                    x-model="newPassword"
                    @input="checkPasswords()"
                />

                <x-password
                    label="Confirmar senha"
                    type="password"
                    right
                    x-model="confirmPassword"
                    @blur="checkPasswords()"
                    ::class="{ 'input-error': !passwordsMatch && confirmPassword !== '' }"
                />

                <div
                    x-show="!passwordsMatch && confirmPassword !== ''"
                    class="text-error text-sm mt-1"
                >
                    As senhas não coincidem
                </div>

                <div class="modal-action mt-6">
                    <x-button
                        label="Redefinir"
                        class="btn-primary"
                        icon="o-check"
                        wire:click="resetPassword"
                        x-bind:disabled="!passwordsMatch || newPassword === '' || confirmPassword === ''"
                    />
                    <x-button
                        label="Cancelar"
                        class="btn-error"
                        icon="o-x-mark"
                        wire:click="$set('modalResetPassword', false)"
                    />
                </div>
            </div>
        </x-modal>
    </div>
</div>
