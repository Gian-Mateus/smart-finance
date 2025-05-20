<?php

namespace App\Livewire\Pages\Settings\Banks;

use App\Models\Bank;
use Livewire\Component;
use Livewire\Attributes\Computed;

class AddAccount extends Component
{
    #[Computed]
    public function banks(){
        return Bank::all();
    }
    
    public function render()
    {
        return view('livewire.pages.settings.banks.add-account');
    }
}
