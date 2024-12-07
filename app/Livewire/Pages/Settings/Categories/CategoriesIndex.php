<?php

namespace App\Livewire\Pages\Settings\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CategoriesIndex extends Component
{
    public $categories;

    #[Validate('required|min:3|max:50')]
    public string $category_name;

    public function mount()
    {
        $this->categories = Category::with('subcategories')->where('user_id', Auth::id())->get();
    }

    public function saveCategory()
    {
        Category::create([
            'user_id' => Auth::id(),
            'name' => $this->category_name
        ]); 
        $this->reset();
        $this->categories = Category::with('subcategories')->where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.categories-index');    
    }
}