<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name;

    public $email;

    public $password = '';

    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'password_confirmation' => 'required|same:password',
    ];

    protected $messages = [
        'name.required' => 'O nome é obrigatório',
        'name.min' => 'O nome deve ter no mínimo 3 caracteres',
        'email.required' => 'O e-mail é obrigatório',
        'email.email' => 'Digite um e-mail válido',
        'email.unique' => 'Este e-mail já está cadastrado',
        'password.required' => 'A senha é obrigatória',
        'password.min' => 'A senha deve ter no mínimo 6 caracteres',
        'password_confirmation.required' => 'A confirmação de senha é obrigatória',
        'password_confirmation.same' => 'As senhas não conferem',
    ];

    public function updated($propertyName)
    {
        if ($propertyName === 'password_confirmation') {
            $this->validateOnly('password_confirmation');
        }
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard.index');
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('components.layouts.empty');
    }
}
