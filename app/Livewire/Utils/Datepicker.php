<?php

namespace App\Livewire\Utils;

use Carbon\Carbon;
use Livewire\Component;
use Carbon\CarbonPeriod;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;

class Datepicker extends Component
{
    public $months = [
        ['id' => '1', 'name' => 'Janeiro'],
        ['id' => '2', 'name' => 'Fevereiro'],
        ['id' => '3', 'name' => 'Março'],
        ['id' => '4', 'name' => 'Abril'],
        ['id' => '5', 'name' => 'Maio'],
        ['id' => '6', 'name' => 'Junho'],
        ['id' => '7', 'name' => 'Julho'],
        ['id' => '8', 'name' => 'Agosto'],
        ['id' => '9', 'name' => 'Setembro'],
        ['id' => '10', 'name' => 'Outubro'],
        ['id' => '11', 'name' => 'Novembro'],
        ['id' => '12', 'name' => 'Dezembro'],
    ];

    public bool $range;

    public $month;

    #[Modelable]
    public $value;

    #[Computed]
    public function period($month = null, $year = null)
    {
        $month = $month ?? Carbon::now()->month;
        $year = $year ?? Carbon::now()->year;

        $start = Carbon::parse($year . '-' . $month - 1)->startOfMonth();
        $end = Carbon::parse($year . '-' . $month)->endOfMonth();

        return CarbonPeriod::create($start, $end);
    }

    public function mount()
    {
        $this->month = Carbon::now()->month;
    }


    public function render()
    {
        return view('livewire.utils.datepicker');
    }
}
