<?php

namespace App\Livewire\Pages\Settings\Budgets\Partials;

use App\Models\Budget;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use App\Livewire\Forms\BudgetsForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class Modal extends Component
{
    public BudgetsForm $form;
    public $modalOpen = false;
    public $function;
    public $type;
    public $title = '';
    public array $recurrences = [
        ['id' => 'monthly', 'name' => 'Mensal'],
        ['id' => 'daily', 'name' => 'Diário'],
        ['id' => 'weekly', 'name' => 'Semanal'],
        ['id'=> 'yearly', 'name' => 'Anual']
    ];

    public Collection $options; // Coleção genérica para categorias ou subcategorias

    #[On('openModal')]
    public function openModal($data){
        $this->modalOpen = true;

        switch ($data["function"]) {
            case 'create':
                $this->title = $data['type'] == "category" ? "Novo Orçamento" : "Novo Sub-Orçamento";
                $this->function = $data['function'];
                $this->type = $data['type'];
                $this->searchOptions();
                break;
                
            case 'edit':
                //dd($data);
                $this->title = $data['type'] == "category" ? "Editando Orçamento" : "Editando Sub-Orçamento";
                $this->function = $data['function'];
                $this->type = $data['type'];
                $this->form->recurrence = collect($this->recurrences)->firstWhere('name', $data['data']['recurrence'])['id'];
                $this->form->target_value = $data['data']['target_value'];
                $this->form->budgetable_id = $data['data']['id'];
                $this->form->budgetable_type = $data['data']['budgetable_type'];

                $this->searchOptions();
                break;
                
            case 'delete':
                break;

        }

        $this->searchOptions();
    }

    // Função genérica para buscar opções (categorias ou subcategorias)
    public function searchOptions(string $value = ''){
        switch ($this->type) {
            case 'category':
                $this->options = Category::where('user_id', Auth::id())
                    ->where('name', 'like', '%' . $value . '%')
                    ->take(5)
                    ->orderBy('name')
                    ->get();
                break;
            
            case 'subcategory':
                $this->options = Subcategory::where('user_id', Auth::id())
                    ->where('category_id', $this->budgetable_id)
                    ->where('name', 'like', '%' . $value . '%')
                    ->take(5)
                    ->orderBy('name')
                    ->get();
                break;            
        }

    }


    public function save(){
        
        $validated = $this->validate();

        switch ($this->function) {
            case 'create':
                $this->dispatch('save', [
                    'type' => $budgetableType,
                    'id' => $data['budgetableId'],
                    'targetValue' => $data['targetValue'],
                    'recurrence' => $data['recurrence']
                ]);
                $this->close();
                break;

            case 'edit':
                dd($data);
                $this->dispatch('update', [
                    'type' => $budgetableType,
                    'id' => $data['budgetId'],
                    'targetValue' => $data['targetValue'],
                    'recurrence' => $data['recurrence']
                ]);
                $this->close();
                break;

            case 'delete':
                $this->dispatch('delete', [
                    'type' => $budgetableType,
                    'id' => $data['budgetableId'],
                    'targetValue' => $data['targetValue'],
                    'recurrence' => $data['recurrence']
                ]);
                $this->close();
                break;
        }
    }

    public function close(){
        $this->modalAddBudget = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.settings.budgets.partials.modal');
    }
}
