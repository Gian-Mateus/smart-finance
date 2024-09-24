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
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id(); // id INT NOT NULL AUTO_INCREMENT
            $table->date('data'); // data DATE NOT NULL
            $table->string('descricao', 255); // descricao VARCHAR(255) NOT NULL
            $table->decimal('valor', 10, 2); // valor DECIMAL(10,2) NOT NULL
            $table->text('observacao')->nullable(); // observacao TEXT NULL
            $table->foreignId('subcategoria_id')->nullable()->constrained('subcategorias')->nullOnDelete(); // FOREIGN KEY subcategoria_id
            $table->foreignId('periodicidade_id')->constrained('periodicidade'); // FOREIGN KEY periodicidade_id
            $table->foreignId('tipo_transacao_id')->constrained('tipo_transacao'); // FOREIGN KEY tipo_transacao_id
            $table->foreignId('banco_id')->constrained('bancos'); // FOREIGN KEY banco_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacaos');
    }
};
