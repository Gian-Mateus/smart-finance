<?php

namespace App\Livewire\Pages\Settings\Budgets;

use Mary\Traits\Toast;
use Livewire\Component;

/* Models */
use App\Models\Budget;
use App\Models\Category;
use App\Models\Subcategory;

use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class BudgetsIndex extends Component
{
    use Toast;

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

    public function addBudgetCategory(){
        $this->dispatch('addBudgetCategory');
    }

    public function addBudgetSubcategory(int $category){
        $this->dispatch('addBudgetSubcategory', $category);
    }

    public function save($isSubcategory = false, $category = null){
        Budget::create([
            'user_id' => Auth::id(),
            'category_id' => $isSubcategory ? $category : $this->category,
            'subcategory_id' => $isSubcategory ? $this->category : null,
            'target_value' => $this->targetValue,
            'recurrence' => $this->recurrence,
            'types' => 'budget'
        ]);

        $this->success("Orçamento criado com sucesso!");
    }

    public function render()
    {
        return view('livewire.pages.settings.budgets.budgets-index');
    }
}