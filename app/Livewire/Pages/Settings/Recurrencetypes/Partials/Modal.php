<?php

namespace App\Livewire\Pages\Settings\Recurrencetypes\Partials;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\RecurrenceTypeForm;

class Modal extends Component
{
    public $modalOpen = false;
    public $type;
    public $title;

    public $selectsTypes = [
        ['id' => 'interval', 'label' => 'Intervalo Customizado'],
        ['id' => 'day_of_month', 'label' => 'Todo dia do mês'],
        ['id' => 'week_day', 'label' => 'Todo dia da semana']
    ];

    public RecurrenceTypeForm $form;

    #[On('openModal')]
    public function openModal($data)
    {
        $this->modalOpen = true;

        switch ($data['type']) {
            case 'create':
                $this->title = "Nova Recorrência";
                break;
            
            default:
                # code...
                break;
        }
    }

    public function close()
    {
        $this->modalOpen = false;
        $this->form->reset();
        //$this->reset();
    }

    public function render()
    {
        return view('livewire.pages.settings.recurrencetypes.partials.modal');
    }
}
