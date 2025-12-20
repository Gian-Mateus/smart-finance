<?php

namespace App\Livewire;

use Livewire\Component;

class Test extends Component
{
    /**
     * Render the component.
     *
     * @return string
     */
    public function render(): string
    {
        return <<<'HTML'
        <div>
            <x-utils.date-picker label="Período personalizado"  range/>
        </div>
        HTML;
    }
}
