<?php

namespace App\Livewire\Pages\Settings\Recurrencetypes;

use Livewire\Component;
use App\Models\RecurrenceType;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class RecurrencetypesIndex extends Component
{
    #[Computed]
    public function recurrencetypes()
    {
        return RecurrenceType::where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.pages.settings.recurrencetypes.recurrencetypes-index');
    }
}
