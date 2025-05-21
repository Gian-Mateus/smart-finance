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

    public bool $modalAddAccount = false;
    public bool $modalEditAccount = false;

    #[Validate('required|min:3')] 
    public string $name;
    public ?int $account_number;
    public ?int $bankSearchableID = null;
    public Collection $results;
    public $accountEditing = null;

    #[Computed]
    public function bankAccount(){
        return BanksAccount::where('user_id', Auth::id())->with('bank')->get();
    }

    public function save(){
        $this->validate();

        BanksAccount::create([
            'user_id' => Auth::id(),
            'bank_id' => $this->bankSearchableID,
            'name' => $this->name,
            'account_number' => $this->account_number ?? null,
        ]);

        $this->success('Conta adicionada com sucesso!');
        $this->modalAddAccount = false;
    }

    public function openModalEdit($editing){
        $this->modalEditAccount = true;
        $this->accountEditing = $editing;
    }
    
    public function search(string $value = ''){

        if($this->accountEditing){
            $selectedOption = Bank::where('id', $this->accountEditing)->get();
        } else{
            $selectedOption = Bank::where('id', $this->bankSearchableID)->get();
        }
        
        $this->results = Bank::where('name', 'like', '%'.$value.'%')
                                ->orWhere('full_name', 'like', '%'.$value.'%')
                                ->take(5)
                                ->orderBy('name')
                                ->get()
                                ->merge($selectedOption);
    }
    
    public function mount(){
        $this->search();
    }

    public function render()
    {
        return view('livewire.pages.settings.banks.bank-index');
    }
}
