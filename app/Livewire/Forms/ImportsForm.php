<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\WithFileUploads;
use App\Jobs\ProcessOFXImportJob;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class ImportsForm extends Form
{
    use WithFileUploads;
    
    #[Validate('required', message: 'O arquivo é obrigatório.')]
    #[Validate('file', message: 'Deve ser um arquivo válido.')]
    // O mime type oficial é application/x-ofx, mas text/plain é um fallback comum
    #[Validate('mimetypes:application/ofx,application/x-ofx,text/plain', message: 'O arquivo deve ser do tipo OFX.')]
    public $file;

    #[Validate('required', message: 'Você precisa selecionar uma conta.')]
    public $accountSelected;

    public function store($type)
    {
        $this->validate();
        try {
            $originalFilename = $this->file->getClientOriginalName();
            $fileExtension = strtolower($this->file->getClientOriginalExtension());
    
            // Armazena o arquivo e obtém o caminho relativo (ex: 'imports/xyz.ofx')
            $storedPath = $this->file->store('imports', 'local');
    
            // 3. Despachar o Job para processar o arquivo em segundo plano
            ProcessOFXImportJob::dispatch(
                $storedPath,                  // Caminho para o arquivo em storage/app/
                $this->accountSelected, // ID da conta bancária vinda do form
                Auth::id(),                   // ID do usuário que fez o upload
                $originalFilename,            // Nome original para registro
                $fileExtension                // Tipo do arquivo (ofx ou csv)
            );
    
            // 4. Notificar o usuário e fechar o modal
            $this->success('Arquivo enviado! O processamento foi iniciado.');
            $this->cancel();
    
        } catch (Exception $e) {
            // Log do erro para depuração
            Log::error('Erro ao despachar job de importação: ' . $e->getMessage());
            $this->addError('form.file', 'Ocorreu um erro inesperado ao enviar o arquivo.');
            return;
        }
    }
}
