<?php

namespace App\Livewire\Pages\Settings\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class CategoriesIndex extends Component
{  
    public $categories;
    public $selected = [];

    // Definindo os listeners para eventos
    #[On('refreshCategories')]
    public function refreshCategories()
    {
        $this->mount();
    }

    public function mount()
    {
        $this->categories = Category::with('subcategories')->where('user_id', Auth::id())->get();
    }

    public function deleteSelected()
    {
        if (count($this->selected) > 0) {
            Category::whereIn('id', $this->selected)->delete();
            $this->selected = [];
            $this->refreshCategories();
        }
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.categories-index');
    }
}