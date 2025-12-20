<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;

    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    protected $messages = [
        'email.required' => 'O e-mail é obrigatório',
        'email.email' => 'Digite um e-mail válido',
        'password.required' => 'A senha é obrigatória',
    ];

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(): \Illuminate\Http\RedirectResponse
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            return redirect()->intended(route('dashboard.index'));
        }

        $this->addError('email', 'Credenciais inválidas');

        return redirect()->back();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.auth.login')->layout('components.layouts.empty');
    }
}
