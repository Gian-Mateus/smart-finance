<?php

namespace App\Livewire;

use Livewire\Component;

class Test extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div>
            <x-utils.date-picker label="Período personalizado"  range/>
        </div>
        HTML;
    }
}
