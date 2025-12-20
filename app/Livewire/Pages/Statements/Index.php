<?php

namespace App\Livewire\Pages\Statements;

use App\Models\BanksAccount;
use App\Models\Transaction;
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

    public ?BanksAccount $account = null;

    public array $headers = [
        ["key" => "date_format", "label" => "Data"],
        ["key" => "description", "label" => "Descrição"],
        ["key" => "type_format", "label" => "Tipo"],
        ["key" => "value_format", "label" => "Valor"],
    ];

    public ?int $month = null;

    public ?int $year = null;

    public ?int $range = 15;

    public array $dateRange = [];

    public ?Carbon $initialDate = null;

    public ?Carbon $endDate = null;

    public string $currentFilter = "Últimos 15 dias";

    /**
     * Get all bank accounts for the authenticated user
     *
     * @return Collection<int, BanksAccount>
     */
    #[Computed]
    public function accounts(): Collection
    {
        $accounts = BanksAccount::query()->where("user_id", Auth::id())->get();

        if ($accounts->count() === 1) {
            $this->account = $accounts->first();
        }

        return $accounts;
    }

    /**
     * Get array of years for filtering
     *
     * @return array<int, array{id: int, name: int}>
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
     * Get array of months for filtering
     *
     * @return array<int, array{id: int, name: string}>
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
     * Get filtered transactions for the selected account and date range
     *
     * @return Collection<int, Transaction>|array<empty, empty>
     */
    #[Computed]
    public function transactions(): Collection|array
    {
        if (!$this->account) {
            return [];
        }

        if ($this->range !== null) {
            $this->initialDate = Carbon::now()->subDays($this->range);
            $this->endDate = Carbon::now();
        }

        // Fallback in case dates are not set
        if (!$this->initialDate || !$this->endDate) {
            return [];
        }

        return Transaction::query()
            ->where("user_id", Auth::id())
            ->where("bank_account_id", $this->account->id)
            ->whereBetween("date", [
                $this->initialDate->startOfDay(),
                $this->endDate->endOfDay(),
            ])
            ->get()
            ->map(function ($i) {
                $i->date_format = $i->date->format("d/m/Y");
                $i->type_format = $i->type == 1 ? "C" : "D";
                $i->value_format = $this->showBRL($i->value);

                return $i;
            });
    }

    /**
     * Apply filters to transactions based on date range or month/year selection
     *
     * @return void
     */
    public function filter(): void
    {
        if (!empty($this->dateRange[0]) && !empty($this->dateRange[1])) {
            $this->initialDate = Carbon::createFromFormat(
                "Y-m-d",
                $this->dateRange[0],
            );
            $this->endDate = Carbon::createFromFormat(
                "Y-m-d",
                $this->dateRange[1],
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

        if ($this->year !== null && $this->month !== null) {
            $this->initialDate = Carbon::parse(
                $this->year . "-" . ($this->month + 1),
            )->startOfMonth();
            $this->endDate = Carbon::parse(
                $this->year . "-" . ($this->month + 1),
            )->endOfMonth();
            $this->currentFilter =
                "Mês de " .
                $this->months()[$this->month]["name"] .
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
     * Initialize component
     *
     * @return void
     */
    public function mount(): void
    {
        $this->accounts();
        $this->transactions();
    }

    /**
     * Render the component
     *
     * @return View
     */
    public function render(): View
    {
        return view("livewire.pages.statements.index");
    }
}
