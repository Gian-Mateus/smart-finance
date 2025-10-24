<?php

namespace App\Livewire\Pages\Settings\Recurrencetypes\Partials;

use App\Livewire\Forms\RecurrenceTypeForm;
use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{
    public $modalOpen = false;

    public $type;

    public $title;

    // public $selectsTypes = [
    //     ['id' => 'interval', 'label' => 'Intervalo Customizado'],
    //     ['id' => 'day_of_month', 'label' => 'Todo dia do mês'],
    //     ['id' => 'week_day', 'label' => 'Todo dia da semana']
    // ];

    // ATUALIZE esta propriedade com os tipos que vamos usar
    public $selectsTypes = [
        ['id' => 'monthly', 'label' => 'Mês'],
        ['id' => 'weekly', 'label' => 'Semana'],
        ['id' => 'interval', 'label' => 'Intervalo de dias'],
        ['id' => 'yearly', 'label' => 'Ano'],
    ];

    // ADICIONE esta propriedade para os dias da semana
    public $weekDays = [
        ['id' => 'monday', 'label' => 'Segunda-feira'],
        ['id' => 'tuesday', 'label' => 'Terça-feira'],
        ['id' => 'wednesday', 'label' => 'Quarta-feira'],
        ['id' => 'thursday', 'label' => 'Quinta-feira'],
        ['id' => 'friday', 'label' => 'Sexta-feira'],
        ['id' => 'saturday', 'label' => 'Sábado'],
        ['id' => 'sunday', 'label' => 'Domingo'],
    ];

    // ADICIONE esta propriedade para as condições de término
    public $endConditions = [
        ['id' => 'never', 'label' => 'Nunca'],
        ['id' => 'on_date', 'label' => 'Numa data específica'],
        ['id' => 'after_occurrences', 'label' => 'Após um nº de ocorrências'],
    ];

    public RecurrenceTypeForm $form;

    #[On('openModal')]
    public function openModal($data)
    {
        $this->modalOpen = true;

        switch ($data['type']) {
            case 'create':
                $this->title = 'Nova Recorrência';
                break;

            default:
                // code...
                break;
        }
    }

    public function close()
    {
        $this->modalOpen = false;
        $this->form->reset();
        // $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.settings.recurrencetypes.partials.modal');
    }
}
