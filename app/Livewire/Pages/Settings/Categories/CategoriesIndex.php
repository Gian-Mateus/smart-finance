<?php

namespace App\Livewire\Pages\Settings\Categories;

use Livewire\Component;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;

class CategoriesIndex extends Component
{
    public bool $modalCS = false;
    public function render()
    {
        return view('livewire.pages.settings.categories.categories-index')->with([
            'categories' => Categories::with('subcategories')->where('user_id', Auth::id())->get()
        ]);    
    }
}