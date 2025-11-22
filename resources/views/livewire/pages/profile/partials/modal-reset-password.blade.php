 <x-modal
     wire:model="modalResetPassword"
     title="Redefinir senha"
     class="backdrop-blur"
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
            }"
        >
         <x-password
             label="Senha atual"
             type="password"
             only-password
             wire:model="currentPassword" />

         <x-password
             label="Nova senha"
             type="password"
             right
             x-model="newPassword"
             @input="checkPasswords()" />

         <x-password
             label="Confirmar senha"
             type="password"
             right
             x-model="confirmPassword"
             @blur="checkPasswords()"
             ::class="{ 'input-error': !passwordsMatch && confirmPassword !== '' }" />

         <div
             x-show="!passwordsMatch && confirmPassword !== ''"
             class="text-error text-sm mt-1">
             As senhas não coincidem
         </div>

         <div class="modal-action mt-6">
             <x-button
                 label="Redefinir"
                 class="btn-primary"
                 icon="o-check"
                 wire:click="resetPassword"
                 x-bind:disabled="!passwordsMatch || newPassword === '' || confirmPassword === ''" />
             <x-button
                 label="Cancelar"
                 class="btn-error"
                 icon="o-x-mark"
                 wire:click="$set('modalResetPassword', false)" />
         </div>
     </div>
 </x-modal>