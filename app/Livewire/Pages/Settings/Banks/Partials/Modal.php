<?php

namespace App\Livewire\Pages\Settings\Banks\Partials;

use App\Models\Bank;
use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\BanksAccount;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\BanksAccountForm;

class Modal extends Component
{
    use Toast;
    
    public BanksAccountForm $form;
    public $account;
    public $modalOpen = false;
    public $title = "";
    public $function;
    public $results = [];

    #[On('openModal')]
    public function open($data){
        $this->modalOpen = true;
        switch ($data['function']) {
            case 'create':
                $this->title = 'Adicionar nova conta';
                $this->function = $data['function'];
                break;

            case 'edit':
                $this->title = 'Editando conta';
                $this->function = $data['function'];
                $this->form->name = $data['data']['name'];
                $this->form->bank_id = $data['data']['bank_id'];
                $this->form->account_number = $data['data']['account_number'];
                $this->account = $data['data']['id'];
                break;

            case 'delete':
                $this->title = 'Deletar conta';
                $this->function = $data['function'];
                $this->form->name = $data['data']['name'];
                $this->form->bank_id = $data['data']['bank_id'];
                $this->form->account_number = $data['data']['account_number'];
                $this->account = $data['data']['id'];
                break;
        }

        $this->search();
    }

    public function search(string $value = ''){
        switch ($this->function) {
            case 'create':
                $this->results = Bank::where('name', 'like', '%'.$value.'%')
                    ->orWhere('full_name', 'like', '%'.$value.'%')
                    ->take(5)
                    ->orderBy('name')
                    ->get();
                break;

            case 'edit':
                $selectedOption = Bank::where('id', $this->form->bank_id)->get();
                $this->results = Bank::where('name', 'like', '%'.$value.'%')
                    ->orWhere('full_name', 'like', '%'.$value.'%')
                    ->take(5)
                    ->orderBy('name')
                    ->get()
                    ->merge($selectedOption);
                break;
                    
        }
    }

    public function close(){
        $this->modalOpen = false;
        $this->reset();
    }

    public function save(){

        switch ($this->function) {
            case 'create':
                $validated = $this->validate();
                BanksAccount::create([
                    ...$validated,
                    'user_id' => Auth::id()
                ]);
                $this->success('Conta criada com sucesso');
                $this->close();
                break;

            case 'edit':
                $account = BanksAccount::where('user_id', Auth::id())->where('id', $this->account);
                $account->update($this->validate());
                $this->success('Conta atualizada com sucesso');
                $this->close();
                break;

            case 'delete':
                $account = BanksAccount::where('user_id', Auth::id())->where('id', $this->account);
                $account->delete();
                $this->success('Conta excluída com sucesso');
                $this->close();
                break;
            
        }

        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.pages.settings.banks.partials.modal');
    }
}
