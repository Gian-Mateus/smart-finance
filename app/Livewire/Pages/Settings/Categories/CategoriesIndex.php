<?php

namespace App\Livewire\Pages\Settings\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

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

    public function new($type, $category = null)
    {
        $this->dispatch('openModal', [
            'function' => 'create',
            'type' => $type,
            'category' => $category ?? null,
        ]);
    }

    public function deleteModal($type, $data)
    {
        $this->dispatch('openModal', [
            'function' => 'delete',
            'type' => $type,
            'data' => $data,
        ]);
    }

    public function editModal($type, $data)
    {
        $this->dispatch('openModal', [
            'function' => 'edit',
            'type' => $type,
            'data' => $data,
        ]);
    }

    #[On('refresh')]
    public function mount()
    {
        //
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.categories-index');
    }
}
