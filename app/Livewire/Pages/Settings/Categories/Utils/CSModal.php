<?php

namespace App\Livewire\Pages\Settings\Categories\Utils;

use Livewire\Component;

class CSModal extends Component
{
    public ?string $modalType = null;
    public ?string $itemID = null;
    public ?string $itemIDFK = null;
    public array $data = [];

    protected $listners = [
        'callDeleteModal' => 'setDeleteModal',
        'callCreateModal' => 'setCreateModal',
        'callEditModal' => 'setEditModal',
    ];

    public function setDeleteModal($itemID){
        $this->modalType = 'delete';
        $this->itemID = $itemID;
    }
    public function setCreateModal($itemID){
        $this->modalType = 'create';
        $this->itemID = $itemID;
    }
    public function setEditModal($itemID){
        $this->modalType = 'edit';
        $this->itemID = $itemID;
    }

    public function save(){
        $validatedData = $this->validate([
            'data.name' => 'required|string|max:255',
        ]);
        if($this->modalType == 'create'){
            
        }
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.utils.c-s-modal');
    }
}
