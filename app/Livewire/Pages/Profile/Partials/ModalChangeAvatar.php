<?php

namespace App\Livewire\Pages\Profile\Partials;

use Livewire\Attributes\On;
use Livewire\Component;

class ModalChangeAvatar extends Component
{

    public $openModal = false;
    
    #[On('openModal')]
    public function openModal()
    {
        $this->openModal = true;
    }

    public function render()
    {
        return view('livewire.pages.profile.partials.modal-change-avatar');
    }
}
