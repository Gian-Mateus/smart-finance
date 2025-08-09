<?php

namespace App\Livewire\Pages\Settings\Budgets;

use App\Models\Budget;
use Mary\Traits\Toast;

/* Models */
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;

use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class BudgetsIndex extends Component
{
    use Toast;

    #[Computed]
    public function budgets(){
        $budgets = Budget::where('user_id', Auth::id())
        ->with([
            'budgetable' => function(MorphTo $morphto) {
                $morphto->morphWith([
                    Subcategory::class,
                    Category::class
                ]);
            }
            
        ])
        ->orderByDesc('created_at')
        ->get();

        $organizedBudgets = collect();
        $subcategories = collect();

       foreach($budgets as $budget){
           if($budget->budgetable_type == 'App\Models\Category'){
               $organizedBudgets->push($budget);
           }
           
           if($budget->budgetable_type == 'App\Models\Subcategory'){
                $subcategories->push($budget);
           }
        }

        foreach($subcategories as $sb){
            if(isset($organizedBudgets[$sb->budgetable->category_id - 1]->subcategories)){
                $organizedBudgets[$sb->budgetable->category_id - 1]->subcategories->push($sb);
            } else {
                $organizedBudgets[$sb->budgetable->category_id - 1]->subcategories = collect();
                $organizedBudgets[$sb->budgetable->category_id - 1]->subcategories->push($sb);
            };
        }

        return $organizedBudgets;
    }

    public function hasSubcategories(int $category): bool{

        $category = Category::find($category);

        if(!$category){
            return false;
        }
        
        return $category->subcategories()->exists();
    }

    public function newBudget($type, $category = null){
        $this->dispatch('openModal', [
            'type' => $type,
            'function' => 'create',
            'data' => $category ?? null
        ]);
    }

    public function deleteModal($type, $data){
        $this->dispatch('openModal', [
            'type' => $type,
            'function' => 'delete',
            'data' => $data
        ]);
    }

    public function editModal($type, $data){
        $this->dispatch('openModal', [
            'type' => $type,
            'function' => 'edit',
            'data' => $data
        ]);
    }

    #[On('save')]
    public function save($data){
        //dd($data['id']);
        Budget::create([
            'user_id' => Auth::id(),
            'budgetable_type' => $data['type'],
            'budgetable_id' => $data['id'],
            'target_value' => $data['targetValue'],
            'recurrence' => $data['recurrence'],
        ]);

        $this->success("Orçamento criado com sucesso!");
    }

    public function render()
    {
        return view('livewire.pages.settings.budgets.budgets-index');
    }
}