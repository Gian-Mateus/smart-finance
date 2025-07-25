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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            // Continuar com o relacionamento com subcategorias, pois elas também terão orçamentos e não poderam ultrapassar o orçamento da categoria
            // Interessante nesse caso utilizar morphs       
            $table->morphs('budgetable');
            $table->enum('recurrence', ['daily', 'weekly', 'monthly', 'yearly']);
            $table->integer('target_value');
            $table->enum('types', ['budget', 'goal']);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
