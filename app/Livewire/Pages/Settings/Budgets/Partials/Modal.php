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
use Livewire\Attributes\Rule;

class Modal extends Component
{
    use Toast;

    public bool $modalAddBudget = false;

    // Usamos $parentId para armazenar o ID da categoria pai quando adicionando uma subcategoria
    public ?int $parentId = null;

    // Usamos $budgetableId para armazenar o ID da categoria ou subcategoria selecionada
    #[Rule('required')]
    public ?int $budgetableId = null;

    #[Rule('required')]
    public $targetValue = null;

    #[Rule('required')]
    public string $recurrence = ''; // Inicializado para evitar erro de required na renderização inicial

    public array $recurrences = [
        ['id' => 'monthly', 'name' => 'Mensal'],
        ['id' => 'daily', 'name' => 'Diário'],
        ['id' => 'weekly', 'name' => 'Semanal'],
        ['id'=> 'yearly', 'name' => 'Anual']
    ];

    public Collection $options; // Coleção genérica para categorias ou subcategorias
    public string $budgetableType; // Para armazenar o tipo do orçamento (Category ou Subcategory)


    #[On('newBudget')]
    public function openModal(?int $parentId = null){
        $this->parentId = $parentId;
        $this->modalAddBudget = true;
        // Reseta o budgetableId para garantir que o choices seja limpo ao abrir o modal
        $this->budgetableId = null;
        $this->searchOptions(); // Busca as opções iniciais (categorias ou subcategorias)
    }

    // Função genérica para buscar opções (categorias ou subcategorias)
    public function searchOptions(string $value = ''){
        if(!$this->parentId){
            // Buscando categorias
            $this->options = Category::where('user_id', Auth::id())
                ->where('name', 'like', '%' . $value . '%')
                ->take(5)
                ->orderBy('name')
                ->get();
            $this->budgetableType = 'App\Models\Category';
        } else {
            // Buscando subcategorias
             $this->options = Subcategory::where('user_id', Auth::id())
                ->where('category_id', $this->parentId)
                ->where('name', 'like', '%' . $value . '%')
                ->take(5)
                ->orderBy('name')
                ->get();

            $this->budgetableType = 'App\Models\Subcategory';
        }
    }


    public function save(){

        $data = $this->validate();
        $budgetableType = $this->parentId ? 'App\Models\Subcategory' : 'App\Models\Category';

        $this->dispatch('save', [
            'type' => $budgetableType,
            'id' => $data['budgetableId'],
            'targetValue' => $data['targetValue'],
            'recurrence' => $data['recurrence']
        ]);
        $this->modalAddBudget = false;
        $this->reset(['parentId', 'budgetableId', 'targetValue', 'recurrence']);
    }

    public function cancel(){
        $this->modalAddBudget = false;
        $this->reset(['parentId', 'budgetableId', 'targetValue', 'recurrence']);
    }

    public function mount(){
        $this->searchOptions();
    }

    public function render()
    {
        return view('livewire.pages.settings.budgets.partials.modal');
    }
}
