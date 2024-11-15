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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // id INT NOT NULL AUTO_INCREMENT
            $table->date('date'); // data DATE NOT NULL
            $table->string('description', 255); // descricao VARCHAR(255) NOT NULL
            $table->decimal('value', 10, 2); // valor DECIMAL(10,2) NOT NULL
            $table->text('observation')->nullable(); // observacao TEXT NULL
            $table->foreignId('subcategory_id')->nullable()->constrained('subcategories')->nullOnDelete(); // FOREIGN KEY subcategoria_id
            $table->foreignId('periodicity_id')->constrained('periodicities'); // FOREIGN KEY periodicidade_id
            $table->foreignId('transaction_type_id')->constrained('transaction_type'); // FOREIGN KEY tipo_transacao_id
            $table->foreignId('bank_id')->constrained('banks'); // FOREIGN KEY banco_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
