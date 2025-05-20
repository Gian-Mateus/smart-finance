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
    public $deleteCategories = [];
    public bool $modalConfirmDelete = false;
    public bool $modalEdit = false;
    public $editing = null;
    public ?string $editingIcon = null;

    use Toast;

    #[On('refreshCategories')]
    public function refreshCategories(){

    }

    #[Computed]
    public function categories(){
        return Category::where('user_id', Auth::id())
            ->select('id', 'name', 'icon')
            ->with(['subcategories' => function($q) {
                $q->where('user_id', Auth::id())
                  ->select('id', 'name', 'category_id');
            }])
            ->orderByDesc('created_at')
            ->get();
    }

    #[On('iconSelected')]
    public function iconSelected($icon){
        $this->editingIcon = $icon;
    }

    public function openModalEdit($editing){
        $this->modalEdit = true;
       //dd($editing);
        $this->editing = $editing;
    }

    public function update(){
        if (!$this->editing) return;

        if(isset($this->editing['subcategories'])){
            Category::where('user_id', Auth::id())->where('id', $this->editing['id'])->update([
                'name' => $this->editing['name'],
                'icon' => $this->editingIcon
            ]);
            $this->success('Categoria atualizada com sucesso!');
        } else{
            Subcategory::where('user_id', Auth::id())->where('id', $this->editing['id'])->update([
                'name' => $this->editing['name'],
            ]);
            $this->success('Subcategoria atualizada com sucesso!');
        }
        
        $this->modalEdit = false;
        $this->dispatch('refreshCategories');
    }

    public function deleteSubcategory($id){

        Subcategory::where('id', $id)->where('user_id', Auth::id())->delete();

        $this->success('Subcategoria excluída com sucesso!');
    }

    public function delete()
    {
        //dd($this->deleteCategories);
        if(empty($this->deleteCategories)){
           $this->error('Selecione uma categoria para excluir!');
           return;
        }

        if(array_all($this->deleteCategories, function($category){
            return $category == false;
        })){
            $this->error('Selecione uma categoria para excluir!');
            return;
        }

        $categoriesForDelete = array_keys($this->deleteCategories);

        $deleteCategoriesCount = Category::whereIn("id", $categoriesForDelete)->where('user_id', Auth::id())->delete();
        
        $this->modalConfirmDelete = false;

        // Toast success
        if($deleteCategoriesCount > 0){
            $this->success("{$deleteCategoriesCount} categoria(s) excluída(s) com sucesso!");
        } else {
            $this->warning('Nenhuma categoria foi excluída. Verifique se você tem permissão para excluir essas categorias.');
        }
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.categories-index');
    }
}