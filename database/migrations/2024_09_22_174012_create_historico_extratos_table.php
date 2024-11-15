<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_statements', function (Blueprint $table) {
            $table->id(); // id INT NOT NULL AUTO_INCREMENT
            $table->foreignId('transaction_id')->constrained('transactions'); // FOREIGN KEY transacao_id
            $table->date('date'); // data DATE NOT NULL
            $table->string('archive_name', 50); // nome_arquivo VARCHAR(50) NOT NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_statements');
    }
};
