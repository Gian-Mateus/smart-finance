<?php

namespace App\Livewire\Forms;

use App\Jobs\ProcessOFXImportJob;
use App\Models\Import;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ImportsForm extends Form
{
    public $file;

    #[Validate('required', message: 'Você precisa selecionar uma conta.')]
    public $accountSelected;

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'extensions:ofx',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'O arquivo é obrigatório.',
            'file.extensions' => 'O arquivo deve ser do tipo OFX.',
        ];
    }

    public function store($type)
    {

        $this->validate();
        $originalFilename = $this->file->getClientOriginalName();
        $storedPath = $this->file->store(path: 'imports');

        $import = Import::create([
            'user_id' => Auth::id(),
            'banks_accounts_id' => $this->accountSelected,
            'file_original_name' => $originalFilename,
            'file_locale_name' => $this->file->hashName(),
            'file_path' => $storedPath,
            'status' => 'pending',
            'file_type' => $type,
            'imported_at' => Carbon::now(),
        ])->first();

        ProcessOFXImportJob::dispatch(
            $storedPath,
            $import,
        );
    }
}
