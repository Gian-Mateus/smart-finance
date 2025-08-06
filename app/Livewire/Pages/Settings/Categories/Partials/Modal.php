<?php

namespace App\Livewire\Pages\Settings\Categories\Partials;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class Modal extends Component
{

    public $modalOpen = false;

    public $title;

    public $modal = [
        "function" => '',
        "type" => '',
        "data" => null
    ];

    #[Validate('required|min:3')]
    public $name;

    public $icon;

    #[On('openModal')]
    public function open($data = null){
        $this->modalOpen = true;
    
        switch ($data["function"]) {
            case "create":
                $this->title = $data["type"] == "category" ? "Nova Categoria" : "Nova Subcategoria para " . $data["category"]["name"];
                $this->modal = [
                    "function" => $data["function"],
                    "type" => $data["type"],
                    "data" => $data["category"] ?? null
                ];
                break;

            case "delete":
                $this->title = $data["type"] == "category" ? "Excluir Categoria" : "Excluir Subcategoria";
                $this->modal = [
                    "function" => $data["function"],
                    "type" => $data["type"],
                    "data" => $data["data"]
                ];
                break;
                
            case "edit":
                $this->title = $data["type"] == "category" ? "Editando Categoria" : "Editando Subcategoria";
                $this->modal = [
                    "function" => $data["function"],
                    "type" => $data["type"],
                    "data" => $data["data"]
                ];
                $this->name = $data["data"]["name"];
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

    public function confirm(){
        switch ($this->modal["function"]) {
            case "create":
                $this->dispatch("save", [
                    "name" => $this->name,
                    "icon" => $this->icon,
                    "type" => $this->modal["type"],
                    "category_id" => $this->modal["data"]["id"] ?? null
                ]);
                break;

            case "delete":
                $this->dispatch("delete", [
                    "type" => $this->modal["type"],
                    "id" => $this->modal["data"]["id"]
                ]);
                break;

            case "edit":
                $this->dispatch('update',[
                    "type" => $this->modal["type"],
                    "id" => $this->modal["data"]["id"],
                    "name" => $this->name,
                    "icon" => $this->icon ?? null
                ]);
                break;
        }
    
        $this->close();
    }
    

    public function render()
    {
        return view('livewire.pages.settings.categories.partials.modal');
    }
}
