<?php

namespace App\Livewire\Pages\Settings\Categories;

use Livewire\Component;
use App\Models\Categories;

class CategoriesIndex extends Component
{
    public function render()
    {
        return view('livewire.pages.settings.categories.categories-index', [
            'categories' => Categories::with('subcategories')->where('user_id', auth()->id())->get()
        ]);    
    }
}