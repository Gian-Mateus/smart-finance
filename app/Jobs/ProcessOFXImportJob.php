<?php

namespace App\Jobs;

use App\Models\Import;
use App\Models\Transaction;
use App\MoneyBRL;
use Endeken\OFX\OFX;
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
            if (!Storage::disk('local')->exists($this->filePath)) {
                throw new \Exception("Arquivo de importação não encontrado em: {$this->filePath}");
            }

            $ofxContent = Storage::disk('local')->get($this->filePath);
            $ofxContent = preg_replace('/\[0:(\w+)\]/', '[+0:$1]', $ofxContent);
            $ofxContent = preg_replace('/\\[([-+]\\d+):BRT\\]/', '[$1:UTC]', $ofxContent);
            $ofx = OFX::parse($ofxContent);

            foreach ($ofx->bankAccounts as $bankAccount) {
                
                foreach ($bankAccount->statement->transactions as $ofxTransaction) {
                    $ofxTransaction->amount = $this->toInteger($ofxTransaction->amount);

                    Transaction::updateOrCreate(
                        [
                            'id_transaction_external' => $ofxTransaction->uniqueId,
                            'user_id' => $this->import->user_id,
                            'bank_account_id' => $this->import->banks_accounts_id,
                            'payment_methods_id' => $ofxTransaction->type,
                            'imports_id' => $this->import->id,
                            'value' => $this->floatToInteger($ofxTransaction->amount),
                            'date' => $ofxTransaction->date,
                            'description' => $ofxTransaction->memo,
                            'type' => $ofxTransaction->type == 'CREDIT' ? 1 : 0,
                        ]
                    );
                }
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
                'error_message' => $exception->getMessage()
            ]);
        }

        Log::error("Falha ao processar importação #{$import->id}: " . $exception->getMessage());
    }
}
