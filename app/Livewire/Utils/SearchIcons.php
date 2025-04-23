<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class SearchIcons extends Component
{
    public array $icons = [];
    public string $path;

    public function mount()
    {
        $this->path = "/vendor/blade-ui-kit/blade-heroicons/resources/svg";
        $this->icons = scandir($this->path);
    }
    
    public function render()
    {
        return view('livewire.utils.search-icons');
    }
}
