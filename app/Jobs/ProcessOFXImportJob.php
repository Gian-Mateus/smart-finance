<?php

namespace App\Jobs;

use App\Models\Import;
use App\Models\Transaction;
use Endeken\OFX\Ofx;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProcessOFXImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $filePath;
    protected int $bankAccountId;
    protected int $userId;
    protected string $originalFilename;
    protected string $fileType;

    public $timeout = 300;
    public $tries = 3;

    public function __construct(string $filePath, int $bankAccountId, int $userId, string $originalFilename, string $fileType)
    {
        $this->filePath = $filePath;
        $this->bankAccountId = $bankAccountId;
        $this->userId = $userId;
        $this->originalFilename = $originalFilename;
        $this->fileType = $fileType;
    }

    public function handle(): void
    {
        $import = Import::create([
            'user_id' => $this->userId,
            'file_name' => $this->originalFilename,
            'file_path' => $this->filePath,
            'status' => 'processing',
            'type' => $this->fileType,
        ]);

        try {
            if (!Storage::disk('local')->exists($this->filePath)) {
                throw new \Exception("Arquivo de importação não encontrado em: {$this->filePath}");
            }

            if ($this->fileType === 'ofx') {
                $this->processOfxFile($import);
            } else {
                throw new \Exception("Processamento de CSV ainda não implementado.");
            }

            $import->update(['status' => 'completed']);
            Storage::disk('local')->delete($this->filePath);

        } catch (Throwable $e) {
            $this->fail($e);
        }
    }

    private function processOfxFile(Import $import): void
    {
        $ofxContent = Storage::disk('local')->get($this->filePath);
        $ofx = Ofx::parse($ofxContent);

        foreach ($ofx->bankAccounts as $bankAccount) {
            
            foreach ($bankAccount->statement->transactions as $ofxTransaction) {
                Transaction::updateOrCreate(
                    [
                        // CORREÇÃO FINAL: A propriedade correta é `uniqueId`
                        'id_transaction_external' => $ofxTransaction->uniqueId,
                        'user_id' => $this->userId,
                        'banks_account_id' => $this->bankAccountId,
                    ],
                    [
                        'import_id' => $import->id,
                        'description' => $ofxTransaction->name,
                        'amount' => (int) ($ofxTransaction->amount * 100),
                        'type' => $ofxTransaction->amount < 0 ? 'expense' : 'income',
                        'date' => $ofxTransaction->date,
                    ]
                );
            }
        }
    }

    public function failed(Throwable $exception): void
    {
        $import = Import::where('file_path', $this->filePath)->first();

        if ($import) {
            $import->update([
                'status' => 'failed',
                'error_message' => $exception->getMessage()
            ]);
        }

        Log::error("Falha ao processar importação #{$import->id}: " . $exception->getMessage());
    }
}
