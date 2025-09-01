<?php

namespace App\Livewire\Pages\Settings\Banks;

use App\Models\Bank;
use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\BanksAccount;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class BankIndex extends Component
{

    #[Computed]
    public function bankAccount(){
        return BanksAccount::where('user_id', Auth::id())->with('bank')->get();
    }

    public function openModal($function, $data = null){
        $this->dispatch('openModal', [
            'function' => $function,
            'data' => $data
        ]);
    }

    #[On('refresh')]
    public function mount(){
        //
    }
    
    public function render()
    {
        return view('livewire.pages.settings.banks.bank-index');
    }
}
