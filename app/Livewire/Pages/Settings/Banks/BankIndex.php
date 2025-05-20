<?php

namespace App\Livewire\Pages\Settings\Banks;

use App\Models\Bank;
use Livewire\Component;
use App\Models\BanksAccount;
use Livewire\Attributes\Computed;

class BankIndex extends Component
{
    #[Computed]
    public function banksAccount(){
        return BanksAccount::where('user_id', Auth::id())->get();
    }
    
    public function render()
    {
        return view('livewire.pages.settings.banks.bank-index');
    }
}
