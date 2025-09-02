<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoriesForm extends Form
{
    public $name;
    public $icon;
    public $category_id;
    public $subcategory_id;
    public $type = 'category';

    public function rules()
    {
        switch ($this->type) {
            case 'category':
                return [
                    'name' => ['required', 'min:3'],
                    'icon' => ['nullable']
                ];
                break;
            
            case 'subcategory':
                return [
                    'name' => ['required', 'min:3'],
                    'category_id' => ['required', 'exists:categories,id']
                ];
                break;
        }
    }
}
