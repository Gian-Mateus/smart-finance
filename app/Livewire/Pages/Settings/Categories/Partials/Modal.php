<?php

namespace App\Livewire\Pages\Settings\Categories\Partials;

use Livewire\Component;
use Livewire\Attributes\On;

class Modal extends Component
{

    public $modalOpen = false;

    public $modal;

    public $name;

    #[On('openModal')]
    public function open($data = null){
        $this->modalOpen = true;

        $this->modal = [
            "function" => $data["function"],
            "type" => $data["type"],
        ];
    }

    public function close(){
        $this->modalOpen = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.settings.categories.partials.modal');
    }
}
