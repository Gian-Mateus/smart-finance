<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoriesForm extends Form
{
    #[Validate('required|min:3')]
    public $name;

    #[Validate('nullable')]
    public $icon;
}
