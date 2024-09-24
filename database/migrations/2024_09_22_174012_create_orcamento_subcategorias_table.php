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
        Schema::create('orcamento_subcategorias', function (Blueprint $table) {
            $table->id(); // id INT NOT NULL AUTO_INCREMENT
            $table->foreignId('subcategoria_id')->constrained('subcategorias'); // FOREIGN KEY subcategoria_id
            $table->foreignId('categoria_id')->constrained('categorias'); // FOREIGN KEY categoria_id
            $table->decimal('valor_orcado', 10, 2); // valor_orcado DECIMAL(10,2) NOT NULL
            $table->date('mes_referencia'); // mes_referencia DATE NOT NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orcamento_subcategorias');
    }
};
