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
        $budgets = Budget::where('user_id', Auth::id())->get();
        $organizedBudgets = [];
        
        foreach($budgets as $budget){
            if (!isset($organizedBudgets[$budget->category_id])) {
                $organizedBudgets[$budget->category_id] = [
                    'category' => $budget,
                    'subcategories' => []
                ];
            }
            
            if ($budget->subcategory_id) {
                $organizedBudgets[$budget->category_id]['subcategories'][$budget->subcategory_id] = $budget;
            } else {
                $organizedBudgets[$budget->category_id]['category_budget'] = $budget;
            }
        }
        return $organizedBudgets;
    }

    public function save(){
        
    }

    public function render()
    {
        return view('livewire.pages.settings.budgets.budgets-index');
    }
}
