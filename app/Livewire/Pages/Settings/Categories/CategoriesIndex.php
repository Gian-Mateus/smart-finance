<?php

namespace App\Livewire\Pages\Settings\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CategoriesIndex extends Component
{  
    public $categories;

    protected $listeners = ['refreshCategories'];

    public function refreshCategories()
    {
        $this->categories = Category::with('subcategories')
            ->where('user_id', Auth::id())
            ->get();
    }
    public function mount()
    {
        $this->categories = Category::with('subcategories')->where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.categories-index');    
    }
}