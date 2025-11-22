<?php

namespace App\Livewire\Pages\Profile\Partials;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class ModalResetPassword extends Component
{
    use Toast;

    public $modalResetPassword = false;
    public $currentPassword;
    public $newPassword;

    #[On('modalResetPassword')]
    public function showModal($value){
        $this->modalResetPassword = $value;
    }

     public function resetPassword()
    {
        $this->validate([
            "currentPassword" => [
                "required",
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail("A senha atual está incorreta.");
                    }
                },
            ],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($this->newPassword);
        $user->save();
        $this->modalResetPassword(false);
        $this->success("Senha redefinida com sucesso!");
    }

    public function render()
    {
        return view('livewire.pages.profile.partials.modal-reset-password');
    }
}
