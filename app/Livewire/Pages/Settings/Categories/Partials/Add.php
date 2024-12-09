<?php

namespace App\Livewire\Pages\Settings\Categories\Partials;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Pages\Settings\Categories\CategoriesIndex;

class Add extends Component
{
    public string $labelButton;
    public string $placeholderInput;
    
    #[Validate('required|min:3|max:50')]
    public string $type;
    public string $name;

    public ?int $category_id = null;    

    public function save()
    {
        if($this->type == "category"){
            Category::create([
                'user_id' => Auth::id(),
                'name' => $this->name
            ]); 
        } 
        elseif($this->type == "subcategory"){
            Subcategory::create([
                'user_id' => Auth::id(),
                'name' => $this->name,
                'category_id' => $this->category_id
            ]);
        }
        $this->reset(['name']);
        $this->dispatch('refreshCategories');
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.partials.add');
    }
}
