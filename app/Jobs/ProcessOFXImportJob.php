<?php

namespace App\Jobs;

use App\Models\Import;
use App\Models\Transaction;
use App\MoneyBRL;
use App\OFXParser;
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
    use MoneyBRL;

    protected string $filePath;

    protected Import $import;

    public $timeout = 300;

    public $tries = 3;

    public function __construct(string $filePath, Import $import)
    {
        $this->filePath = $filePath;
        $this->import = $import;
    }

    public function handle(): void
    {
        try {
            if (! Storage::disk('local')->exists($this->filePath)) {
                throw new \Exception("Arquivo de importação não encontrado em: {$this->filePath}");
            }

            $file = file(storage_path('app/private/'.$this->filePath));

            $parser = new OFXParser;
            $ofx = $parser->parse($file);

            foreach ($ofx['transactions'] as $tr) {

                Transaction::updateOrCreate(
                    [
                        'id_transaction_external' => $tr['id'],
                        'user_id' => $this->import->user_id,
                        'bank_account_id' => $this->import->banks_accounts_id,
                        'imports_id' => $this->import->id,
                        'value' => $this->floatToInteger($tr['amount']),
                        'date' => $tr['date'],
                        'description' => $tr['description'],
                        'type' => $tr['type'] == 'CREDIT' ? 1 : 0,
                    ]
                );
            }

        } catch (Throwable $e) {
            $this->fail($e);
        }
    }

    public function failed(Throwable $exception): void
    {
        $import = Import::where('file_path', $this->filePath)->first();

        if ($import) {
            $import->update([
                'status' => 'failed',
                'error_message' => $exception->getMessage(),
            ]);
        }

        Log::error("Falha ao processar importação #{$import->id}: ".$exception->getMessage());
    }
}
