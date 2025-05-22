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
    public ?int $bankEditing = null;
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

    public function update(){
        //bankSearchableID sempre está null, mesmo mudando o banco na edição, porém bankEditing é alterado conforme a seleção do usuário.
        //dd($this->bankSearchableID, $this->bankEditing);
        //dd($this->accountEditing['id'], $this->accountEditing['name'], $this->accountEditing['account_number']);

        if(Auth::id() !== $this->accountEditing['user_id']){
            return $this->error('Você não tem permissão para editar essa conta!');
        }
        
        BanksAccount::where('id', $this->accountEditing['id'])->update([
            'bank_id' => $this->bankEditing,
            'name' => $this->accountEditing['name'],
            'account_number' => $this->accountEditing['account_number'] ?? null,
        ]);

        $this->modalEditAccount = false;
        $this->success('Conta atualizada com sucesso!');
    }

    public function openModalEdit($editing){
        $this->modalEditAccount = true;
        $this->accountEditing = $editing;
        $this->bankEditing = $editing["bank_id"];
        $this->search();
    }
    
    public function search(string $value = ''){

       if($this->bankEditing !== null){
           $selectedOption = Bank::where('id', $this->bankEditing)->get();
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
