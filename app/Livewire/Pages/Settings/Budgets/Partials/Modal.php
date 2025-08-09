<?php

namespace App\Livewire\Pages\Settings\Budgets\Partials;

use App\Models\Budget;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Rule;

class Modal extends Component
{

    public bool $modalOpen = false;

    public $modal = [
        "function" => '',
        "type" => '',
        "data" => null
    ];

    public $title = '';

    #[Rule('required')]
    public ?int $budgetableId = null;

    #[Rule('required')]
    public $targetValue = null;

    #[Rule('required')]
    public string $recurrence = '';

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
                $this->modal = [
                    "type" => $data['type'],
                    "function" => $data['function'],
                    "data" => $data['data'] ?? null
                ];
                $this->searchOptions();
                break;
                
            case 'edit':
                $this->title = $data['type'] == "category" ? "Editando Orçamento" : "Editando Sub-Orçamento";
                $this->modal = [
                    "type" => $data['type'],
                    "function" => $data['function'],
                    "data" => $data['data'] ?? null
                ];
                $this->recurrence = $data['data']['recurrence'];
                $this->targetValue = $data['data']['target_value'];
                $this->searchOptions();
                break;
                
            case 'delete':
                break;

        }
    }

    // Função genérica para buscar opções (categorias ou subcategorias)
    public function searchOptions(string $value = ''){
        switch ($this->modal['type']) {
            case 'category':
                $this->options = Category::where('user_id', Auth::id())
                ->where('name', 'like', '%' . $value . '%')
                ->take(5)
                ->orderBy('name')
                ->get();
                break;
            
            case 'subcategory':
                $this->options = Subcategory::where('user_id', Auth::id())
                ->where('category_id', $this->modal['data']['id'])
                ->where('name', 'like', '%' . $value . '%')
                ->take(5)
                ->orderBy('name')
                ->get();
                break;            
        }

    }


    public function save(){

        $data = $this->validate();
        $budgetableType = $this->modal['type'] == "category" ? 'App\Models\Category' : 'App\Models\Subcategory';

        switch ($this->modal['function']) {
            case 'create':
                $this->dispatch('save', [
                    'type' => $budgetableType,
                    'id' => $data['budgetableId'],
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

            case 'edit':
                $this->dispatch('update', [
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

    public function mount(){
        $this->searchOptions('', $this->modal['type']);
    }

    public function render()
    {
        return view('livewire.pages.settings.budgets.partials.modal');
    }
}
