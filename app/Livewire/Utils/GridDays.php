<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class GridDays extends Component
{
    public array $days = [];

    public function mount()
    {
        $range = range(1, 31);

        $this->days = array_map(function ($day) {
            return ['value' => $day];
        }, $range);
    }


    public function render()
    {
        return view('livewire.utils.grid-days');
    }
}
