<?php

namespace App\Livewire\Pages\Profile;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $name;
    public $email;

    public function updateName()
    {
        // dd($this->name);
        $user = Auth::user();
        $user->name = $this->name;
        $user->save();
    }

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return \view('livewire.pages.profile.index');
    }
}
