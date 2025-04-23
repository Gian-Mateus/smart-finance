<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class SearchIcons extends Component
{
    public array $icons = [];
    public string $path;

    public function mount()
    {
        $this->path = __DIR__."/../../../vendor/blade-ui-kit/blade-heroicons/resources/svg";
    
        $this->icons = scandir($this->path);

        $this->icons = array_filter($this->icons, function ($el) {
            return $el != "." && $el != "..";
        });
    }
    
    public function render()
    {
        return view('livewire.utils.search-icons');
    }
}
