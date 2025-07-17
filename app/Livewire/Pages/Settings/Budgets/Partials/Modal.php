<?php

namespace App\Livewire\Pages\Settings\Budgets\Partials;

use App\Models\Budget;
use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class Modal extends Component
{
    use Toast;
    
    public bool $modalAddBudget = false;
    public ?int $category = null;
    public ?int $subcategory = null;
    public $targetValue = null;

    public string $recurrence;
    public array $recurrences = [
        ['id' => 'monthly', 'name' => 'Mensal'],
        ['id' => 'daily', 'name' => 'Diário'],
        ['id' => 'weekly', 'name' => 'Semanal'],
        ['id'=> 'yearly', 'name' => 'Anual']
    ];

    public Collection $categories;
    public Collection $subcategories;

    #[On('addBudgetCategory')]
    public function openModalAddBudgetCategory(){
        $this->modalAddBudget = true;
        $this->searchAny();
    }

    #[On('addBudgetSubcategory')]
    public function openModalAddBudgetSubcategory(int $category){
        $this->modalAddBudget = true;
        $this->category = $category;
        $this->searchAny();
    }

    public function searchAny(string $value = ''){
        if(!$this->category){
            $selectedOption = Category::where('user_id', Auth::id())->where('id', $this->category)->get();
            
            $this->categories = Category::where('user_id', Auth::id())
            ->where('name', 'like', '%' . $value . '%')
            ->take(5)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
        }

        if($this->category){
            $selectedOption = Subcategory::where('user_id', Auth::id())->where('id', $this->subcategory)->get();
    
            $this->subcategories = Subcategory::where('user_id', Auth::id())
            ->where('category_id', $this->category)
            ->where('name', 'like', '%' . $value . '%')
            ->take(5)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
        }
    }

    public function dispacthSaveBudgetCategory(){
        
        $data = $this->validate([
            'category' => 'required',
            'subcategory' => 'nullable',
            'targetValue' => 'required',
            'recurrence' => 'required'
        ]);

        $this->dispatch('save', $data);
        $this->modalAddBudget = false;
        $this->reset(['category', 'targetValue', 'recurrence']);
    }
    
    public function dispacthSaveBudgetSubcategory(){
        $categoryBudget = Budget::where('user_id', Auth::id())
        ->where('category_id', $this->category)
        ->whereNull('subcategory_id')
        ->get();

        $targetValuesSubcategories = Subcategory::where('category_id', $this->category);

        //dd($this->targetValue > $categoryBudget[0]->target_value);
        if($this->targetValue > $categoryBudget[0]->target_value){
            $this->error('O valor do orçamento da subcategoria não pode ser maior que o orçamento da categoria em que ela pertence');
            return;
        }

        $data = $this->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'targetValue' => 'required',
            'recurrence' => 'required'
        ]);
        
        $this->dispatch('save', $data);
        $this->modalAddBudget = false;
        $this->reset(['category', 'subcategory', 'targetValue', 'recurrence']);
    }

    public function cancel(){
        $this->modalAddBudget = false;
        $this->reset(['category', 'targetValue', 'recurrence']);
    }

    public function mount(){
        $this->searchAny();
    }

    public function render()
    {
        return view('livewire.pages.settings.budgets.partials.modal');
    }
}
