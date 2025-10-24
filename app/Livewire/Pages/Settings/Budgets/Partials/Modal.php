<?php

namespace App\Livewire\Pages\Settings\Budgets\Partials;

use App\Livewire\Forms\BudgetsForm;
use App\Models\Category;
use App\Models\RecurrenceType;
use App\Models\Subcategory;
use App\MoneyBRL;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Modal extends Component
{
    use MoneyBRL;
    use Toast;

    public BudgetsForm $form;

    public $modalOpen = false;

    public $function;

    public $type;

    public $title = '';

    public Collection $options; // Coleção genérica para categorias ou subcategorias

    #[Computed]
    public function recurrences()
    {
        return RecurrenceType::where('user_id', Auth::id())->get();
    }

    #[On('openModal')]
    public function openModal($data)
    {
        $this->modalOpen = true;

        switch ($data['function']) {
            case 'create':
                $this->title = $data['type'] == 'category' ? 'Novo Orçamento' : 'Novo Sub-Orçamento';
                $this->function = $data['function'];
                $this->type = $data['type'];
                $this->form->budgetable_type = $data['type'] == 'category' ? Category::class : Subcategory::class;
                // $this->form->recurrence = $this->recurrences[0]['id'];
                break;

            case 'edit':
                // dd($data);
                $this->title = $data['type'] == 'category' ? 'Editando Orçamento' : 'Editando Sub-Orçamento';
                $this->function = $data['function'];
                $this->type = $data['type'];
                $this->form->recurrence_types_id = $data['data']['recurrence_types_id'];
                $this->form->target_value = $this->showBRL($data['data']['target_value']);
                $this->form->budgetable_id = $data['data']['id'];
                $this->form->budgetable_type = $data['data']['budgetable_type'];
                break;

            case 'delete':
                $this->title = $data['type'] == 'category' ? 'Deletar Orçamento' : 'Deletar Sub-Orçamento';
                $this->function = $data['function'];
                $this->type = $data['type'];
                $this->form->recurrence_types_id = $data['data']['recurrence_types_id'];
                $this->form->target_value = $data['data']['target_value'];
                $this->form->budgetable_id = $data['data']['id'];
                $this->form->budgetable_type = $data['data']['budgetable_type'];
                break;

        }

        $this->searchOptions();
    }

    // Função genérica para buscar opções (categorias ou subcategorias)
    public function searchOptions(string $value = '')
    {
        switch ($this->function) {
            case 'create':
                $this->options = Category::where('user_id', Auth::id())
                    ->where('name', 'like', '%'.$value.'%')
                    ->take(5)
                    ->orderBy('name')
                    ->get();
                break;

            case 'edit':
                switch ($this->type) {
                    case 'category':
                        $this->form->budgetable_id ? $selectedOption = Category::find($this->form->budgetable_id)->get() : '';
                        $this->options = Category::where('user_id', Auth::id())
                            ->where('name', 'like', '%'.$value.'%')
                            ->take(5)
                            ->orderBy('name')
                            ->get()
                            ->merge($selectedOption);
                        break;

                    case 'subcategory':
                        $this->form->budgetable_id ? $selectedOption = Subcategory::find($this->form->budgetable_id)->get() : '';
                        $this->options = Subcategory::where('user_id', Auth::id())
                            ->where('category_id', $this->budgetable_id)
                            ->where('name', 'like', '%'.$value.'%')
                            ->take(5)
                            ->orderBy('name')
                            ->get()
                            ->merge($selectedOption);
                        break;
                }
                break;
        }
    }

    public function save()
    {

        switch ($this->function) {
            case 'create':
                $this->form->store();
                $this->success('Orçamento criado com sucesso.');
                $this->close();
                break;

            case 'edit':
                $this->form->update();
                $this->success('Orçamento atualizado com sucesso.');
                $this->close();
                break;

            case 'delete':
                $this->form->delete();
                $this->success('Orçamento deletado com sucesso.');
                $this->close();
                break;
        }

        $this->dispatch('refresh');
    }

    public function close()
    {
        $this->modalOpen = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.settings.budgets.partials.modal');
    }
}
