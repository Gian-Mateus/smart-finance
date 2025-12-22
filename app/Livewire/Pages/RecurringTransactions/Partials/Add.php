<?php

namespace App\Livewire\Pages\RecurringTransactions\Partials;

use App\Models\RecurrenceType;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Add extends Component
{    
    public function render()
    {
        return view('livewire.pages.recurring-transactions.partials.add');
    }
}
