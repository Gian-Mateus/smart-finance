<?php

namespace App\Livewire\Transactions;

use Livewire\Component;

class Banks extends Component
{
    //** Alterar futuramente para que esse atributo seja dinâmico */
    // public $selectedTab = 'nubank-tab';
    public function render()
    {
        return view('livewire.transactions.banks');
    }
}
