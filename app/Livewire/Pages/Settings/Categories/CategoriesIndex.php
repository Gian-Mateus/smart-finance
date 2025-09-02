<?php

namespace App\Livewire\Pages\Settings\Categories;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class CategoriesIndex extends Component
{  
    use Toast;


    #[Computed]
    public function categories()
    {
        return Category::where('user_id', Auth::id())
            ->with('subcategories')
            ->orderByDesc('created_at')
            ->get();
    }

    public function new($type, $category = null){
        $this->dispatch('openModal', [
            "function" => "create",
            "type" => $type,
            "category" => $category ?? null
        ]);
    }

    public function deleteModal($type, $data)
    {
        $this->dispatch('openModal', [
            "function" => "delete",
            "type" => $type,
            "data" => $data
        ]);
    }

    public function editModal($type, $data)
    {
        $this->dispatch('openModal', [
            "function" => "edit",
            "type" => $type,
            "data" => $data
        ]);
    }

    #[On('refresh')]
    public function mount(){
        //
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.categories-index');
    }
}