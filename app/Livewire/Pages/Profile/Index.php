<?php

namespace App\Livewire\Pages\Profile;

use App\Models\BanksAccount;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Mary\Traits\Toast;

class Index extends Component
{
    use Toast;

    public $name;
    public $email;
    public $avatar;
    public $accounts;

    public function modalResetPassword($value)
    {
        $this->dispatch("modalResetPassword", $value);
    }

    public function updateName()
    {
        // dd($this->name);
        $user = Auth::user();
        $user->name = $this->name;
        $user->save();
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

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->avatar = Auth::user()->avatar;
        $this->accounts = BanksAccount::where("user_id", Auth::id())
            ->with("bank")
            ->get();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return \view("livewire.pages.profile.index");
    }
}
