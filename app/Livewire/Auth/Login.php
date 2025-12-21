<?php

namespace App\Livewire\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;

    public $password;

    protected $rules = [
        "email" => "required|email",
        "password" => "required",
    ];

    protected $messages = [
        "email.required" => "O e-mail é obrigatório",
        "email.email" => "Digite um e-mail válido",
        "password.required" => "A senha é obrigatória",
    ];
    
    /**
     * @return RedirectResponse
     */
    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            return redirect()->intended(route("dashboard.index"));
        }

        $this->addError("email", "Credenciais inválidas");

        return redirect()->back();
    }

    public function render()
    {
        return view("livewire.auth.login")->layout("components.layouts.empty");
    }
}
