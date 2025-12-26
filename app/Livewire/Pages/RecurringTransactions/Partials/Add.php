<?php

namespace App\Livewire\Pages\RecurringTransactions\Partials;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Add extends Component
{    
    public $selectedType = 'monthly';
    
    #[Computed]
    public function daysInMonth($month = null)
    {
        if($month == null){
            return $days = CarbonPeriod::create(
                Carbon::now()->firstOfMonth(),
                Carbon::now()->lastOfMonth()
            );
        }
        
        $days = CarbonPeriod::create(
            Carbon::create(month: $month)->firstOfMonth(),
            Carbon::create(month: $month)->lastOfMonth()
        );
        return $days;
    }
    
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
        
        $optionsMonth = [
            ['id'=>'fixedDay','label'=>'Dia fixo'],
            ['id'=>'dayOfWeek','label'=>'Dia da semana'],
        ];
        
        return view('livewire.pages.recurring-transactions.partials.add',
        [
            'selectsTypes' => $selectsTypes,
            'weekDays' => $weekDays,
            'optionsMonth' => $optionsMonth,
        ]);
    }
}
