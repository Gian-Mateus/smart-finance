<?php

namespace App\Livewire\Pages\RecurringTransactions\Partials;

use Livewire\Component;

class Add extends Component
{    
    public $selectedType = 'monthly';
    
    public function render()
    {
        
        $selectsTypes = [
            ['id'=>'daily','label'=>'Diária'],
            ['id'=>'weekly','label'=>'Semanal'],
            ['id'=>'monthly','label'=>'Mensal'],
            ['id'=>'yearly','label'=>'Anual'],
            ['id'=>'custom','label'=>'Personalizado'],
        ];
        
        $weekDays = [
            ['id'=>'mon','label'=>'Segunda'],
            ['id'=>'tue','label'=>'Terça'],
            ['id'=>'wed','label'=>'Quarta'],
            ['id'=>'thu','label'=>'Quinta'],
            ['id'=>'fri','label'=>'Sexta'],
            ['id'=>'sat','label'=>'Sábado'],
            ['id'=>'sun','label'=>'Domingo'],
        
        ];
        
        return view('livewire.pages.recurring-transactions.partials.add',
        [
            'selectsTypes' => $selectsTypes,
            'weekDays' => $weekDays,
        ]);
    }
}
