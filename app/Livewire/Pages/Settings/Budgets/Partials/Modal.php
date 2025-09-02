<?php

namespace App\Livewire\Pages\Settings\Budgets\Partials;

use App\Models\Budget;
use Mary\Traits\Toast;
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
    use Toast;
    
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
                $this->form->budgetable_type = $data['type'] == "category" ? Category::class : Subcategory::class;
                $this->form->recurrence = $this->recurrences[0]['id']; // Define valor padrão
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
                break;
                
            case 'delete':
                $this->title = $data['type'] == "category" ? "Deletar Orçamento" : "Deletar Sub-Orçamento";
                $this->function = $data['function'];
                $this->type = $data['type'];
                $this->form->recurrence = collect($this->recurrences)->firstWhere('name', $data['data']['recurrence'])['id'];
                $this->form->target_value = $data['data']['target_value'];
                $this->form->budgetable_id = $data['data']['id'];
                $this->form->budgetable_type = $data['data']['budgetable_type'];
                break;

        }

        $this->searchOptions();
    }

    // Função genérica para buscar opções (categorias ou subcategorias)
    public function searchOptions(string $value = ''){
        switch ($this->function) {
            case 'create':
                $this->options = Category::where('user_id', Auth::id())
                    ->where('name', 'like', '%' . $value . '%')
                    ->take(5)
                    ->orderBy('name')
                    ->get();
                break;

            case 'edit':
                switch ($this->type) {
                    case 'category':
                        $this->form->budgetable_id ? $selectedOption = Category::find($this->form->budgetable_id)->get() : '';
                        $this->options = Category::where('user_id', Auth::id())
                            ->where('name', 'like', '%' . $value . '%')
                            ->take(5)
                            ->orderBy('name')
                            ->get()
                            ->merge($selectedOption);
                        break;
                        
                    case 'subcategory':
                        $this->form->budgetable_id ? $selectedOption = Subcategory::find($this->form->budgetable_id)->get() : '';
                        $this->options = Subcategory::where('user_id', Auth::id())
                            ->where('category_id', $this->budgetable_id)
                            ->where('name', 'like', '%' . $value . '%')
                            ->take(5)
                            ->orderBy('name')
                            ->get()
                            ->merge($selectedOption);
                        break;            
                }
                break;
        }
    }


    public function save(){
        
        $validated = $this->validate();

        switch ($this->function) {
            case 'create':
                //dd($validated);
                Budget::create([
                    ...$validated,
                    'user_id' => Auth::id()
                ]);
                $this->success("Orçamento criado com sucesso.");
                $this->close();
                break;

            case 'edit':
                $budget = Budget::where('user_id', Auth::id())->where('id', $this->form->budgetable_id)->first();
                $budget->update($validated);
                $this->success("Orçamento atualizado com sucesso.");
                $this->close();
                break;

            case 'delete':
                $budget = Budget::where('user_id', Auth::id())->where('id', $this->form->budgetable_id)->delete();
                $this->success("Orçamento deletado com sucesso.");
                $this->close();
                break;
        }

        $this->dispatch('refresh');
    }

    public function close(){
        $this->modalOpen = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.settings.budgets.partials.modal');
    }
}
