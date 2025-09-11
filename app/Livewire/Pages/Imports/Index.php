<?php

namespace App\Livewire\Pages\Imports;

use Livewire\Component;

class Index extends Component
{
    public function openModal($type)
    {
        $this->dispatch('openModal', ['type' => $type]);
    }
    
    public function render()
    {
        return view('livewire.pages.imports.index');
    }
}
