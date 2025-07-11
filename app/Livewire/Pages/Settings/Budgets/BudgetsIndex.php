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

    public bool $modalAddBudget = false;
    public ?int $category = null;
    public ?int $subcategory = null;
    public Collection $categories;
    public Collection $subcategories;
    
    public string $targetValue;
    
    public string $recurrence;
    public array $recurrences = [
        ['id' => 'daily', 'name' => 'Diário'],
        ['id' => 'weekly', 'name' => 'Semanal'],
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
        $selectedOption = Category::where('user_id', Auth::id())->where('id', $this->category)->get();
        
        $this->categories = Category::where('user_id', Auth::id())
        ->where('name', 'like', '%' . $value . '%')
        ->take(5)
        ->orderBy('name')
        ->get()
        ->merge($selectedOption);
    }

    public function searchSubcategories(string $value = ""){
        $selectedOption = Subcategory::where('user_id', Auth::id())->where('id', $this->subcategory)->get();

        $this->subcategories = Subcategory::where('user_id', Auth::id())
        ->where('category_id', $this->category)
        ->where('name', 'like', '%' . $value . '%')
        ->take(5)
        ->orderBy('name')
        ->get()
        ->merge($selectedOption);
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
        $this->cancel();
        $this->modalAddBudget = false;
        //dd($this->category);
    }

    public function mount(){
        $this->search();
        $this->searchSubcategories();
    }

    public function cancel(){
        $this->reset(['targetValue', 'category']);
    }

    public function render()
    {
        return view('livewire.pages.settings.budgets.budgets-index');
    }
}