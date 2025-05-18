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

    use Toast;

    #[On('refreshCategories')]
    public function refreshCategories(){

    }

    #[Computed]
    public function categories(){
        return Category::with('subcategories')->where('user_id', Auth::id())->get()->sortByDesc('created_at');
    }

    public function deleteSubcategory($id){

        Subcategory::where('id', $id)->where('user_id', Auth::id())->delete();

        $this->success('Subcategoria excluída com sucesso!');
    }

    public function delete()
    {
        //dd(array_keys($this->deleteCategories));
        if(empty($this->deleteCategories)){
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