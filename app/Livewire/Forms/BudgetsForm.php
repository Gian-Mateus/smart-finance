<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class BudgetsForm extends Form
{
    #[Validate('required', message: 'Este campo é obrigatório.')] 
    #[Validate('min:3', message: 'Este campo deve ter pelo menos :min caracteres.')] 
    public string $name;
    
    #[Validate('nullable')]
    #[Validate('min:4', message: 'Este campo deve ter pelo menos :min caracteres.')] 
    public ?int $account_number;

    #[Validate('required', message: 'Este campo é obrigatório.')]
    public ?int $bankSearchableID = null;
    public ?int $bankEditing = null;
    public Collection $results;
}
