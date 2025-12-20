<?php

namespace App\Livewire\Pages\RecurringTransactions;

use App\Models\BanksAccount;
use App\Models\RecurringTransaction;
use App\MoneyBRL;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    use MoneyBRL;

    public $account;

    public $headers = [
        ["key" => "date_format", "label" => "Data"],
        ["key" => "description", "label" => "Descrição"],
        ["key" => "type_format", "label" => "Tipo"],
        ["key" => "value_format", "label" => "Valor"],
    ];

    public $month;

    public $year;

    public $range = 15;

    public ?array $dateRange = ["start" => null, "end" => null];

    public $initialDate;

    public $endDate;

    public $currentFilter = "Últimos 15 dias";

    /**
     * Get all bank accounts for the authenticated user.
     *
     * @return Collection<int,\Illuminate\Database\Eloquent\Model>
     */
    #[Computed]
    public function accounts(): Collection
    {
        $accounts = BanksAccount::query()->where("user_id", Auth::id())->get();

        if (count($accounts) == 1) {
            $this->account = $accounts[0];
        }

        return $accounts;
    }

    /**
     * Get array of years for filtering.
     *
     * @return array<int,array<string,int>>
     */
    #[Computed]
    public function years(): array
    {
        $currentYear = Carbon::now()->year;
        $years = [];
        for ($i = 0; $i <= 10; $i++) {
            $years[$i] = [
                "id" => $currentYear - $i,
                "name" => $currentYear - $i,
            ];
        }

        return $years;
    }

    /**
     * Get array of months for filtering.
     *
     * @return array<int,array<string,mixed>>
     */
    #[Computed]
    public function months(): array
    {
        $months = [];
        $labels = [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro",
        ];
        for ($i = 0; $i <= 11; $i++) {
            $months[$i] = ["id" => $i, "name" => $labels[$i]];
        }

        return $months;
    }

    /**
     * Get filtered transactions.
     *
     * @return array|\Illuminate\Support\Collection
     */
    #[Computed]
    public function transactions(): array|\Illuminate\Support\Collection
    {
        if ($this->range != null) {
            $this->initialDate = Carbon::now()->subDays($this->range);
            $this->endDate = Carbon::now();
        }

        // Fallback in case dates are not set
        if (!$this->initialDate || !$this->endDate) {
            return [];
        }

        return RecurringTransaction::query()
            ->where("user_id", Auth::id())
            ->with([
                "bank_account_id" => function ($query) {
                    $query->whereBetween("date", [
                        $this->initialDate->startOfDay(),
                        $this->endDate->endOfDay(),
                    ]);
                },
            ])
            ->get()
            ->map(function ($i) {
                /** @var \App\Models\RecurringTransaction $i */
                $i->date_format = $i->date->format("d/m/Y");
                $i->type_format = $i->type == 1 ? "C" : "D";
                $i->value_format = $this->showBRL($i->value);

                return $i;
            });
    }

    /**
     * Filter transactions based on selected criteria.
     */
    public function filter(): void
    {
        // dd($this->dateRange);

        if (
            !empty($this->dateRange["start"]) &&
            !empty($this->dateRange["end"])
        ) {
            $this->initialDate = Carbon::createFromFormat(
                "d/m/Y",
                $this->dateRange["start"],
            );
            $this->endDate = Carbon::createFromFormat(
                "d/m/Y",
                $this->dateRange["end"],
            );

            $this->currentFilter =
                $this->initialDate->format("d/m/Y") .
                " até " .
                $this->endDate->format("d/m/Y");
            $this->range = null;
            $this->reset("year", "month");
            unset($this->transactions);

            return;
        }

        if ($this->year != null && $this->month != null) {
            $this->initialDate = Carbon::parse(
                $this->year . "-" . $this->month + 1,
            )->startOfMonth();
            $this->endDate = Carbon::parse(
                $this->year . "-" . $this->month + 1,
            )->endOfMonth();
            $this->currentFilter =
                "Mês de " .
                $this->months[$this->month]["name"] .
                " de " .
                $this->year;

            $this->range = null;
            $this->reset("dateRange");
            unset($this->transactions);

            return;
        }

        unset($this->transactions);
    }

    /**
     * Initialize the component.
     */
    public function mount(): void
    {
        $this->accounts();
        $this->transactions();
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view("livewire.pages.recurring-transactions.index");
    }
}
