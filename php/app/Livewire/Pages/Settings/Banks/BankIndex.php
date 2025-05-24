<?php

namespace App\Livewire\Pages\Settings\Banks;

use App\Models\Bank;
use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\BanksAccount;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class BankIndex extends Component
{
    use Toast;

    public bool $modalAddAccount    = false;
    public bool $modalEditAccount   = false;
    public bool $modalDeleteAccount = false;

    #[Validate('required|min:3')]
    public string $name;

    #[Validate('nullable|integer')]
    public ?int $account_number = null;

    #[Validate('required|integer|exists:banks,id')]
    public ?int $bankSearchableID = null;

    #[Validate('required|integer|exists:banks,id')]
    public ?int $bankEditing = null;

    public Collection $results;

    public ?array $accountEditOrDelete = null;

    #[Computed]
    public function bankAccount(): Collection
    {
        return BanksAccount::where('user_id', Auth::id())
                           ->with('bank')
                           ->get();
    }

    #[Validate([
        'bankSearchableID'   => 'required|integer|exists:banks,id',
        'name'               => 'required|string|min:3',
        'account_number'     => 'nullable|integer',
    ])]
    public function save(): void
    {
        BanksAccount::create([
            'user_id'        => Auth::id(),
            'bank_id'        => $this->bankSearchableID,
            'name'           => $this->name,
            'account_number' => $this->account_number,
        ]);

        $this->success('Conta adicionada com sucesso!');
        $this->modalAddAccount = false;
        $this->reset(['name', 'account_number', 'bankSearchableID']);
    }

    #[Validate([
        'accountEditOrDelete.id'             => 'required|integer|exists:banks_accounts,id',
        'accountEditOrDelete.user_id'        => 'required|integer|in:' . Auth::id(),
        'accountEditOrDelete.name'           => 'required|string|min:3',
        'bankEditing'                        => 'required|integer|exists:banks,id',
        'accountEditOrDelete.account_number' => 'nullable|integer',
    ])]
    public function update(): void
    {
        BanksAccount::where('id', $this->accountEditOrDelete['id'])
                    ->update([
                        'bank_id'        => $this->bankEditing,
                        'name'           => $this->accountEditOrDelete['name'],
                        'account_number' => $this->accountEditOrDelete['account_number'],
                    ]);

        $this->modalEditAccount = false;
        $this->success('Conta atualizada com sucesso!');
    }

    #[Validate([
        'accountEditOrDelete.id'      => 'required|integer|exists:banks_accounts,id',
        'accountEditOrDelete.user_id' => 'required|integer|in:' . Auth::id(),
    ])]
    public function delete(): void
    {
        BanksAccount::where('id', $this->accountEditOrDelete['id'])->delete();

        $this->modalDeleteAccount = false;
        $this->success('Conta excluída com sucesso!');
    }

    public function openModalEdit(array $editing): void
    {
        $this->modalEditAccount    = true;
        $this->accountEditOrDelete = $editing;
        $this->bankEditing         = $editing['bank_id'];
        $this->search();
    }

    public function openModalDelete(array $deleting): void
    {
        $this->modalDeleteAccount  = true;
        $this->accountEditOrDelete = $deleting;
    }

    public function search(string $value = ''): void
    {
        $selectedOption = collect();
        if ($this->bankEditing) {
            $selectedOption = Bank::where('id', $this->bankEditing)->get();
        } elseif ($this->bankSearchableID) {
            $selectedOption = Bank::where('id', $this->bankSearchableID)->get();
        }

        $this->results = Bank::where('name', 'like', "%{$value}%")
                             ->orWhere('full_name', 'like', "%{$value}%")
                             ->orderBy('name')
                             ->take(5)
                             ->get()
                             ->merge($selectedOption);
    }

    public function mount(): void
    {
        $this->search();
    }

    public function render()
    {
        return view('livewire.pages.settings.banks.bank-index');
    }
}