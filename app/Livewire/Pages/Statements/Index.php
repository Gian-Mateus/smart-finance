<?php

namespace App\Livewire\Pages\Statements;

use App\Models\BanksAccount;
use App\Models\Transaction;
use App\MoneyBRL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    use MoneyBRL;

    public $account;

    public $headers = [
        ['key' => 'date_format', 'label' => 'Data'],
        ['key' => 'description', 'label' => 'Descrição'],
        ['key' => 'type_format', 'label' => 'Tipo'],
        ['key' => 'value_format', 'label' => 'Valor'],
    ];

    public $month;

    public $year;

    public $range = 15;

    public $dateRange;

    public $configDatePicker = ['mode' => 'range', 'altFormat' => 'd/m/Y'];

    public $initialDate;

    public $endDate;

    public $currentFilter = 'Últimos 15 dias';

    #[Computed]
    public function accounts()
    {
        $accounts = BanksAccount::where('user_id', Auth::id())->get();

        if (count($accounts) == 1) {
            $this->account = $accounts[0];
        }

        return $accounts;
    }

    #[Computed]
    public function years()
    {
        $currentYear = Carbon::now()->year;
        $years = [];
        for ($i = 0; $i <= 10; $i++) {
            $years[$i] = ['id' => $currentYear - $i, 'name' => $currentYear - $i];
        }

        return $years;
    }

    #[Computed]
    public function months()
    {
        $months = [];
        $labels = [
            'Janeiro',
            'Fevereiro',
            'Março',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro',
        ];
        for ($i = 0; $i <= 11; $i++) {
            $months[$i] = ['id' => $i, 'name' => $labels[$i]];
        }

        return $months;
    }

    #[Computed]
    public function transactions()
    {
        if ($this->range != null) {
            $this->initialDate = Carbon::now();
            $this->endDate = $this->initialDate->subDays($this->range);
        }

        return Transaction::where('user_id', Auth::id())
            ->where('bank_account_id', $this->account->id)
            ->whereBetween('date', [$this->initialDate, $this->endDate])
            ->get()
            ->map(function ($i) {
                $i->date_format = $i->date->format('d/m/Y');
                $i->type_format = $i->type == 1 ? 'C' : 'D';
                $i->value_format = $this->showBRL($i->value);

                return $i;
            });
    }

    public function filter()
    {
        // dd($this->dateRange);

        if ($this->dateRange) {
            $dateRange = explode('até', $this->dateRange);
            $this->initialDate = $dateRange[0];
            $this->endDate = $dateRange[1];
            $this->range = null;
            $this->reset('year', 'month');
            $this->transactions();

            return;
        }

        if ($this->year != null && $this->month != null) {
            $this->initialDate = Carbon::parse($this->year.'-'.$this->month + 1)->startOfMonth()->format('Y-m-d');
            $this->endDate = Carbon::parse($this->year.'-'.$this->month + 1)->endOfMonth()->format('Y-m-d');
            // dd($this->year, $this->month,$this->initialDate, $this->endDate);
            $this->range = null;
            $this->reset('dateRange');
            $this->transactions();

            return;
        }
        // dd($this->range, $this->year, $this->month);

    }

    public function mount()
    {
        $this->accounts();
        $this->transactions();
    }

    public function render()
    {
        return view('livewire.pages.statements.index');
    }
}
