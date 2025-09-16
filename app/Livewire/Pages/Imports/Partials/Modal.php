<?php

namespace App\Livewire\Pages\Imports\Partials;

use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\BanksAccount;
use Livewire\WithFileUploads;
use App\Livewire\Forms\ImportsForm;
use Illuminate\Support\Facades\Auth;

class Modal extends Component
{
    use WithFileUploads;
    use Toast;
    public $modalOpen = false;
    public $accounts;
    public $type;
    public ImportsForm $form;

    #[On('openModal')]
    public function openModal($data)
    {
        $this->modalOpen = true;
        $this->type = $data['type'];
    }
    public function getAccounts()
    {
        $this->accounts = BanksAccount::where('user_id', Auth::id())
            ->get()
            ->toArray();

        if(count($this->accounts) == 1){
            $this->form->accountSelected = $this->accounts[0]['id'];
        }
    }
    public function cancel()
    {
        $this->modalOpen = false;
        $this->form->reset();
    }
    public function save()
    {
        $this->form->store($this->type);
        $this->success('Arquivo enviado! O processamento foi iniciado.');
        $this->cancel();
    }
    public function render()
    {
            $this->getAccounts();
            return view('livewire.pages.imports.partials.modal');
    }
}
