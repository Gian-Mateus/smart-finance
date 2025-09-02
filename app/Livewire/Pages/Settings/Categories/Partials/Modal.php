<?php

namespace App\Livewire\Pages\Settings\Categories\Partials;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use App\Livewire\Forms\CategoriesForm;

class Modal extends Component
{

    public $modalOpen = false;
    public $title;
    public $function;
    public $type;
    public CategoriesForm $form;

    #[On('openModal')]
    public function open($data = null){
        $this->modalOpen = true;
    
        switch ($data["function"]) {
            case "create":
                $this->title = $data["type"] == "category" ? "Nova Categoria" : "Nova Subcategoria para " . $data["category"]["name"];
                $this->function = $data["function"];
                $this->type = $data["type"];
                break;

            case "edit":
                $this->title = $data["type"] == "category" ? "Editando Categoria" : "Editando Subcategoria";
                $this->function = $data["function"];
                $this->type = $data["type"];
                $this->form->name = $data["data"]["name"];
                $this->form->icon = $data["data"]["icon"] ?? null;
                break;

            case "delete":
                $this->title = $data["type"] == "category" ? "Excluir Categoria" : "Excluir Subcategoria";
                $this->function = $data["function"];
                $this->type = $data["type"];
                $this->form->name = $data["data"]["name"];
                $this->form->icon = $data["data"]["icon"] ?? null;
                break;
        }
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
        switch ($this->function) {
            case "create":
                
                break;

            case "delete":
                
                break;

            case "edit":
                
                break;
        }
    
        $this->close();
    }
    

    public function render()
    {
        return view('livewire.pages.settings.categories.partials.modal');
    }
}
