<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class BanksAccountForm extends Form
{
    #[Validate('required', message: 'Este campo é obrigatório.')]
    public $name;

    #[Validate('required', message: 'Este campo é obrigatório.')]
    public $bank_id;

    #[Validate('nullable')]
    #[Validate('min:6', message: 'Este campo deve ter no mínimo :min caracteres.')]
    public $account_number;
}
