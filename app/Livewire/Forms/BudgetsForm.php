<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class BudgetsForm extends Form
{
    #[Validate('required', message: 'Campo é obrigatório.')]
    public $budgetable_type;

    #[Validate('required', message: 'Campo é obrigatório.')]
    public $budgetable_id;

    #[Validate('required', message: 'Campo é obrigatório.')]
    #[Validate('in:daily,weekly,monthly,yearly', message: 'Opção inválida.')]
    public $recurrence;

    #[Validate('required', message: 'Campo é obrigatório.')]
    #[Validate('min:1', message: 'Defina o valor maior que zero.')]
    public $target_value;
}
