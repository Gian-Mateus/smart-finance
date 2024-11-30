<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    
    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];
        
        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        
        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ]);
    }
    
    public function render()
    {
        return view('livewire.auth.login');
    }
}