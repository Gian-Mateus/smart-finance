<?php

namespace App\Livewire\Utils;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class Datepicker extends Component
{
    public $uuid;

    public $label;

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

    public ?bool $range = null;

    #[Modelable]
    public $value;

    public $now;

    // Controla qual view está sendo mostrada: 'days', 'months', 'years'
    public string $view = 'days';

    // Range de anos para a view de anos (ex: 2020-2029)
    public int $yearRangeStart = 2020;

    #[Computed]
    public function period($month = null, $year = null)
    {
        $month ??= Carbon::now()->month;
        $year ??= Carbon::now()->year;

        $start = Carbon::parse($year.'-'.$month - 1)->startOfMonth();
        $end = Carbon::parse("{$year}-{$month}")->endOfMonth();

        return CarbonPeriod::create($start, $end);
    }

    public function setMonth($direc)
    {
        $this->now = match ($direc) {
            'inc' => $this->now->copy()->addMonth(),
            'dec' => $this->now->copy()->subMonth(),
            default => $this->now,
        };
    }

    public function setYear($direc)
    {
        $this->now = match ($direc) {
            'inc' => $this->now->copy()->addYear(),
            'dec' => $this->now->copy()->subYear(),
            default => $this->now,
        };
    }

    public function setYearRange($direc)
    {
        $this->yearRangeStart = match ($direc) {
            'inc' => $this->yearRangeStart + 9,
            'dec' => $this->yearRangeStart - 9,
            default => $this->yearRangeStart,
        };
    }

    public function navigate($direction)
    {
        match ($this->view) {
            'days' => $this->setMonth($direction),
            'months' => $this->setYear($direction),
            'years' => $this->setYearRange($direction),
            default => null,
        };
    }

    public function setView($view)
    {
        $this->view = $view;
    }

    public function selectMonth($month)
    {
        $this->now = $this->now->copy()->month($month);
        $this->view = 'days';
    }

    public function selectYear($year)
    {
        $this->now = $this->now->copy()->year($year);
        $this->view = 'months';
    }

    public function calendarDays($month = null, $year = null)
    {
        $month ??= Carbon::now()->month;
        $year ??= Carbon::now()->year;

        // Primeiro e último dia do mês atual
        $startOfMonth = Carbon::create($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        // Dia da semana do primeiro dia (0 = domingo, 6 = sábado)
        $startDayOfWeek = $startOfMonth->dayOfWeek;

        // Dias do mês anterior para preencher o início
        $days = [];
        if ($startDayOfWeek > 0) {
            $prevMonth = $startOfMonth->copy()->subMonth();
            $prevMonthEndDay = $prevMonth->daysInMonth;
            for ($i = $startDayOfWeek - 1; $i >= 0; $i--) {
                $days[] = [
                    'date' => $prevMonth->copy()->day($prevMonthEndDay - $i),
                    'current' => false,
                    'isToday' => false,
                ];
            }
        }

        // Dias do(s) mês(es) atual(is)
        $currentDate = $startOfMonth->copy();
        while ($currentDate <= $endOfMonth) {
            $days[] = [
                'date' => $currentDate->copy(),
                'current' => true,
                'isToday' => $currentDate->isToday(),
            ];
            $currentDate->addDay();
        }

        // Dias do mês seguinte para preencher o final
        $remaining = 7 - (count($days) % 7);
        if ($remaining < 7) {
            $nextMonth = $startOfMonth->copy()->addMonth();
            for ($i = 1; $i <= $remaining; $i++) {
                $days[] = [
                    'date' => $nextMonth->copy()->day($i),
                    'current' => false,
                    'isToday' => false,
                ];
            }
        }

        return $days;
    }

    public function mount($label = 'Data', $range = false)
    {
        $this->uuid = uniqid();
        $this->now = Carbon::now();
        $this->label = $label;
        $this->range = $range;
        $this->view = 'days';
        $this->yearRangeStart = floor($this->now->year / 9) * 9;

        // Inicializa a propriedade modelável com o tipo correto
        if ($this->range) {
            if (! is_array($this->value)) {
                $this->value = ['start' => null, 'end' => null];
            }
        } else {
            if (is_array($this->value)) {
                $this->value = null;
            }
        }
    }

    public function render()
    {
        return view('livewire.utils.datepicker');
    }
}
