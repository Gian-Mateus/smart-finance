<?php

namespace App\Livewire\Pages\Settings\Categories\Partials;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Pages\Settings\Categories\CategoriesIndex;

class Add extends Component
{
    public string $labelButton;
    public string $placeholderInput;
    
    public string $type;
    #[Validate('required|min:3|max:50')]
    public string $name;
    public ?string $icon = null;
    public ?int $category_id = null;
    
    use Toast;

    #[On('iconSelected')]
    public function iconSelected($icon)
    {
        $this->icon = $icon;
    }
    
    public function save()
    {
        if($this->type == "category"){
            Category::create([
                'user_id' => Auth::id(),
                'name' => $this->name,
                'icon' => $this->icon
            ]);
            
            // Toast success
            $this->success('Categoria criada com sucesso!');
        } 
        elseif($this->type == "subcategory"){
            Subcategory::create([
                'user_id' => Auth::id(),
                'name' => $this->name,
                'category_id' => $this->category_id
            ]);
            
            // Toast success
            $this->success('Subcategoria criada com sucesso!');
        } else{
            // Toast error
            $this->error('Erro ao criar categoria ou subcategoria!');
        }
        
        $this->reset(['name', 'icon']);
        $this->dispatch('resetIcon');
        $this->dispatch('refreshCategories');
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.partials.add');
    }
}
