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

    // #[On('refreshCategories')]
    // public function refreshCategories()
    // {

    // }

    #[Computed]
    public function categories()
    {
        return Category::where('user_id', Auth::id())
            ->select('id', 'name', 'icon')
            ->with(['subcategories' => function($q) {
                $q->where('user_id', Auth::id())
                  ->select('id', 'name', 'category_id');
            }])
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

    #[On('update')]
    public function update($data)
    {
        switch ($data['type']) {
            case 'category':
                Category::where('id', $data["id"])->where('user_id', Auth::id())->update([
                    'name' => $data["name"],
                    'icon' => $data["icon"]
                ]);
                $this->success("Categoria atualizada com sucesso!");
                break;
            
            case 'subcategory':
                Subcategory::where('id', $data["id"])->where('user_id', Auth::id())->update([
                    'name' => $data["name"],
                ]);
                $this->success("Subcategoria atualizada com sucesso!");
                break;

        }
    }

    #[On('delete')]
    public function delete($data)
    {
        switch ($data['type']) {
            case 'category':
                Category::where('id', $data["id"])->where('user_id', Auth::id())->delete();
                $this->success("Categoria excluída com sucesso!");
                break;
            
            case 'subcategory':
                Subcategory::where('id', $data["id"])->where('user_id', Auth::id())->delete();
            $this->success("Subcategoria excluída com sucesso!");
                break;

        }
    }

    #[On("save")]
    public function save($data)
    {
        switch ($data['type']) {
            case 'category':
                Category::create([
                    'name' => $data['name'],
                    'icon' => $data['icon'],
                    'user_id' => Auth::id()
                ]);
                $this->success("Categoria criada com sucesso!");
                break;
            
            case 'subcategory':
                Subcategory::create([
                    'name' => $data['name'],
                    'category_id' => $data['category_id'],
                    'user_id' => Auth::id()
                ]);
                $this->success("Subcategoria criada com sucesso!");
                break;

        }
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.categories-index');
    }
}