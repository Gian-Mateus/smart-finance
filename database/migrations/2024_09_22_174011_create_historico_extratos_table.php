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
        Schema::create('historico_extratos', function (Blueprint $table) {
            $table->id(); // id INT NOT NULL AUTO_INCREMENT
            $table->foreignId('transacoes_id')->constrained('transacoes'); // FOREIGN KEY transacao_id
            $table->date('data'); // data DATE NOT NULL
            $table->string('nome_arquivo', 50); // nome_arquivo VARCHAR(50) NOT NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_extratos');
    }
};
