<?php

namespace App\Livewire\Pages\Settings\Categories\Partials;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\CategoriesForm;

class Modal extends Component
{

    use Toast;

    public $modalOpen = false;
    public $title;
    public $function;
    public $type;
    public $id;
    public CategoriesForm $form;

    #[On('openModal')]
    public function open($data = null){
        $this->modalOpen = true;
    
        switch ($data["function"]) {
            case "create":
                $this->title = $data["type"] == "category" ? "Nova Categoria" : "Nova Subcategoria para " . $data["category"]["name"];
                $this->function = $data["function"];
                $this->type = $data["type"];
                $this->form->category_id = $data["category"]["id"] ?? null;
                break;

            case "edit":
                $this->title = $data["type"] == "category" ? "Editando Categoria" : "Editando Subcategoria";
                $this->function = $data["function"];
                $this->type = $data["type"];
                switch($data["type"]){
                    case 'category':
                        $this->form->name = $data["data"]["name"];
                        $this->form->icon = $data["data"]["icon"] ?? null;
                        $this->id= $data["data"]["id"];
                    break;
                    
                    case 'subcategory':
                        $this->form->name = $data["data"]["name"];
                        $this->form->icon = $data["data"]["icon"] ?? null;
                        $this->id = $data["data"]["id"];
                        $this->form->category_id = $data["data"]["category_id"];
                    break;
                }
                break;

            case "delete":
                $this->title = $data["type"] == "category" ? "Excluir Categoria" : "Excluir Subcategoria";
                $this->function = $data["function"];
                $this->type = $data["type"];
                switch($data['type']){
                    case 'category':
                        $this->form->category_id = $data["data"]["id"];
                        $this->form->name = $data["data"]["name"];
                        $this->id = $data['data']['id'];
                    break;

                    case 'subcategory':
                        $this->form->subcategory_id = $data["data"]["id"];
                        $this->form->name = $data["data"]["name"];
                        $this->id = $data['data']['id'];
                        $this->form->category_id = $data["data"]["category_id"];
                    break;
                }
                break;
        }

        $this->form->type = $this->type;
    }
    
    public function close(){
        $this->modalOpen = false;
        $this->reset();
    }

    #[On("iconSelected")]
    public function setIcon($icon){
        $this->icon = $icon;
    }

    public function save(){

        $validated = $this->validate();

        switch ($this->function) {
            case "create":
                switch($this->type){
                    case 'category':
                        Category::create([
                            ...$validated,
                            "user_id" => Auth::id()
                        ]);
                        $this->success('Categoria criada com sucesso!');
                    break;
                case 'subcategory':
                    Subcategory::create([
                        ...$validated,
                        "user_id" => Auth::id(),
                        "category_id" => $this->form->category_id
                    ]);
                    $this->success('Subcategoria criada com sucesso!');
                break;
                }     
                break;

            case "edit":
                switch($this->type){
                    case 'category':
                        Category::where('user_id', Auth::id())->where('id', $this->id)->update($validated);
                        $this->success('Categoria editada com sucesso!');
                    break;
                    case 'subcategory':
                        Subcategory::where('user_id', Auth::id())->where('id', $this->id)->update($validated);
                        $this->success('Subcategoria editada com sucesso!');
                    break;
                } 
                break;
                
            case "delete":
                switch($this->type){
                    case 'category':
                        $category = Category::where('user_id', Auth::id())->find($this->id);
                        $category->delete();
                        $this->success('Categoria deletada com sucesso!');
                    break;
                    case 'subcategory':
                        $subcategory = Subcategory::where('user_id', Auth::id())->find($this->id);
                        $subcategory->delete();
                        $this->success('Subcategoria deletada com sucesso!');
                    break;
                } 
                break;
        }
    
        $this->close();
        $this->dispatch('refresh');
    }
    

    public function render()
    {
        return view('livewire.pages.settings.categories.partials.modal');
    }
}
