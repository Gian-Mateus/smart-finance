<?php

namespace App\Livewire\Pages\Settings\Banks;

use App\Models\BanksAccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class BankIndex extends Component
{
    #[Computed]
    public function bankAccount()
    {
        return BanksAccount::where('user_id', Auth::id())->with('bank')->get();
    }

    public function openModal($function, $data = null)
    {
        $this->dispatch('openModal', [
            'function' => $function,
            'data' => $data,
        ]);
    }

    #[On('refresh')]
    public function mount()
    {
        //
    }

    public function render()
    {
        return view('livewire.pages.settings.banks.bank-index');
    }
}
