<?php

namespace App\Livewire\Pages\Settings\Categories\Partials;

use Livewire\Component;

class Subcategories extends Component
{
    public $subcategories;
    public $category_id;

    public function delete(){
        dd($this->subcategories);
    }
    public function render()
    {
        return view('livewire.pages.settings.categories.partials.subcategories');
    }
}
