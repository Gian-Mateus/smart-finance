<?php

namespace App\Livewire\Forms;

use App\Models\Budget;
use App\MoneyBRL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BudgetsForm extends Form
{
    use MoneyBRL;

    #[Validate('required', message: 'Campo é obrigatório.')]
    public $budgetable_type;

    #[Validate('required', message: 'Campo é obrigatório.')]
    public $budgetable_id;

    #[Validate('required', message: 'Campo é obrigatório.')]
    // #[Validate('in:daily,weekly,monthly,yearly', message: 'Opção inválida.')]
    public $recurrence_types_id;

    #[Validate('required', message: 'Campo é obrigatório.')]
    #[Validate('min:1', message: 'Defina o valor maior que zero.')]
    public $target_value;

    public function rules()
    {
        return [
            'recurrence_types_id' => Rule::exists('recurrence_types', 'id')->where('user_id', Auth::id()),
        ];
    }

    public function store()
    {
        $this->validate();
        $this->target_value = $this->toInteger($this->target_value);

        //dd($this->all());
        Budget::create([
            ...$this->all(),
            'user_id' => Auth::id(),
        ]);
    }

    public function update()
    {
        $budget = Budget::where('user_id', Auth::id())->where('id', $this->budgetable_id)->first();
        $budget->update($this->all());
    }

    public function delete()
    {
        $budget = Budget::where('user_id', Auth::id())->where('id', $this->budgetable_id)->delete();
    }
}
