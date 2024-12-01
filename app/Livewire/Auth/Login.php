<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    protected $messages = [
        'email.required' => 'O e-mail é obrigatório',
        'email.email' => 'Digite um e-mail válido',
        'password.required' => 'A senha é obrigatória'
    ];

    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->intended(route('dashboard.index'));
        }

        $this->addError('email', 'Credenciais inválidas');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.empty');
    }
}