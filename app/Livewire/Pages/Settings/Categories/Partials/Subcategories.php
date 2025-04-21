<?php

namespace App\Livewire\Pages\Settings\Categories\Partials;

use Livewire\Component;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

class Subcategories extends Component
{
    public Subcategory $subcategory;

    public function delete()
    {
        // Armazena o ID da categoria pai antes de excluir
        $categoryId = $this->subcategory->category_id;
        
        // Exclui a subcategoria
        $this->subcategory->delete();

        // Emite evento para o componente pai atualizar
        $this->dispatch('refreshCategories');
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.partials.subcategories');
    }
}
