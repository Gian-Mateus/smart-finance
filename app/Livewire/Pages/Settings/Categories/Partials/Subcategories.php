<?php

namespace App\Livewire\Pages\Settings\Categories\Partials;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

class Subcategories extends Component
{
    public Subcategory $subcategory;
    use Toast;

    public function delete()
    {   
        // Delete subcategory
        $this->subcategory->delete();

        // Dispatch event to refresh categories
        $this->dispatch('refreshCategories');
        $this->success('Subcategoria excluída com sucesso!');
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.partials.subcategories');
    }
}