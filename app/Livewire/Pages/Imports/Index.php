<?php

namespace App\Livewire\Pages\Imports;

use App\Models\Import;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public function openModal($type)
    {
        $this->dispatch('openModal', ['type' => $type]);
    }

    public $headers = [
        ['key' => 'file_original_name', 'label' => 'Nome do arquivo'],
        ['key' => 'banksAccount.name', 'label' => 'Conta'],
        ['key' => 'imported_at_formated', 'label' => 'Data Importação'],
    ];

    #[Computed]
    public function lastImports()
    {
        $lastImports = Import::with('banksAccount')
        ->where('user_id', Auth::id())
        ->latest('imported_at')
        ->take(10)
        ->get();

        $lastImports->map(function ($l) {
            $l->imported_at_formated = $l->imported_at->format('d/m/Y H:i');
        });

        return $lastImports;
    }
    
    public function render()
    {
        return view('livewire.pages.imports.index');
    }
}
