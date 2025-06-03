<?php

namespace App\Livewire\Pages\Settings\Budgets;

use App\Models\Budget;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class BudgetsIndex extends Component
{
    public bool $modalAddBudget = false;

    #[Computed]
    public function budgets(){
        return Budget::where('user_id', Auth::id())
        ->with('category.subcategories')
        ->get();
    }

    public function save(){
        
    }

    public function render()
    {
        return view('livewire.pages.settings.budgets.budgets-index');
    }
}
