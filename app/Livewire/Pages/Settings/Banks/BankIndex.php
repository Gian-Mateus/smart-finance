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
    public bool $modalDeleteAccount = false;

    #[Validate('required', message: 'Este campo é obrigatório.')] 
    #[Validate('min:3', message: 'Este campo deve ter pelo menos :min caracteres.')] 
    public string $name;
    
    #[Validate('nullable')]
    #[Validate('min:4', message: 'Este campo deve ter pelo menos :min caracteres.')] 
    public ?int $account_number;

    #[Validate('required', message: 'Este campo é obrigatório.')]
    public ?int $bankSearchableID = null;
    public ?int $bankEditing = null;
    public Collection $results;

    // Aqui está dando problema ao persistir os dados
    // #[Validate([
    //     'accountEditOrDelete.name' => 'required|min:3',
    //     'accountEditOrDelete.account_number' => 'nullable|min:3|integer',
    // ], message: [
    //     'required' => "Este campo é obrigatório.",
    //     'min' => "Este campo deve ter pelo menos :min caracteres.",
    //     'integer' => "Este campo deve ser numérico.",
    // ])]
    public $accountEditOrDelete = null;

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
        $this->reset(['name', 'account_number', 'bankSearchableID']);
    }

    public function update(){
        //bankSearchableID sempre está null, mesmo mudando o banco na edição, porém bankEditing é alterado conforme a seleção do usuário.
        //dd($this->accountEditOrDelete);
        $this->validate([
            'accountEditOrDelete.name' => 'required|min:3',
            'accountEditOrDelete.account_number' => 'nullable|min:4',
            'bankEditing' => 'required'
        ], [
            'required' => "Este campo é obrigatório.",
            'min' => "Este campo deve ter pelo menos :min caracteres.",
            'integer' => "Este campo deve ser numérico.",
        ]);

        if(Auth::id() !== $this->accountEditOrDelete['user_id']){
            return $this->error('Você não tem permissão para editar essa conta!');
        }
        
        BanksAccount::where('id', $this->accountEditOrDelete['id'])->update([
            'bank_id' => $this->bankEditing,
            'name' => $this->accountEditOrDelete['name'],
            'account_number' => $this->accountEditOrDelete['account_number'] ?? null,
        ]);

        $this->modalEditAccount = false;
        //$this->reset();
        $this->success('Conta atualizada com sucesso!');
    }

    public function delete(){
        if(Auth::id() !== $this->accountEditOrDelete['user_id']){
            return $this->error('Você não tem permissão para excluir essa conta!');
        }

        BanksAccount::where('id', $this->accountEditOrDelete['id'])->delete();
        $this->modalDeleteAccount = false;
        $this->success('Conta excluída com sucesso!');
    }

    public function openModalEdit($editing){
        $this->modalEditAccount = true;
        $this->accountEditOrDelete = $editing;
        $this->bankEditing = $editing["bank_id"];
        $this->search();
    }

    public function openModalDelete($deleting){
        $this->modalDeleteAccount = true;
        $this->accountEditOrDelete = $deleting;
    }
    
    public function search(string $value = ''){

       if($this->bankEditing !== null){
           $selectedOption = Bank::where('user_id', Auth::id())->where('id', $this->bankEditing)->get();
       } else{
           $selectedOption = Bank::where('user_id', Auth::id())->where('id', $this->bankSearchableID)->get();
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
