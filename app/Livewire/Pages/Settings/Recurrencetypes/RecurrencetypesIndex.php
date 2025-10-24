<?php

namespace App\Livewire\Pages\Settings\Recurrencetypes;

use App\Models\RecurrenceType;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class RecurrencetypesIndex extends Component
{
    #[Computed]
    public function recurrencetypes()
    {
        return RecurrenceType::where('user_id', Auth::id())->get();
    }

    public function newRecurrence()
    {
        $this->dispatch('openModal', ['type' => 'create']);
    }

    public function render()
    {
        return view('livewire.pages.settings.recurrencetypes.recurrencetypes-index');
    }
}
