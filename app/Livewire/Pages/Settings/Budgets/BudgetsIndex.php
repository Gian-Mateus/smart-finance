<?php

namespace App\Livewire\Pages\Settings\Budgets;

use App\Models\Budget;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class BudgetsIndex extends Component
{
    public bool $modalAddBudget = false;
    public ?int $categoryOrSubcategory = null;
    public Collection $categoriesAndSubcategories;
    public string $recurrence;

    public array $recurrences = [
        ['id' => 'dayly', 'name' => 'Diário'],
        ['id' => 'weekly', 'name' => 'Semanal'],
        ['id' => 'monthly', 'name' => 'Mensal'],
        ['id'=> 'yearly', 'name' => 'Anual']
    ];

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

    public function search(string $value = ''){
        $selectedOption = Category::where('user_id', Auth::id())->where('id', $this->categoryOrSubcategory)->get();
        
        $this->categoriesAndSubcategories = Category::where('user_id', Auth::id())
        ->where('name', 'like', '%' . $value . '%')
        ->take(5)
        ->orderBy('name')
        ->get()
        ->merge($selectedOption);
    }

    public function mount(){
        $this->search();
    }

    public function render()
    {
        return view('livewire.pages.settings.budgets.budgets-index');
    }
}