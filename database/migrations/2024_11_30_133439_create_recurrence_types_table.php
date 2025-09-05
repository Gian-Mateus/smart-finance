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
        Schema::create('recurrence_types', function (Blueprint $table) {
            $table->id(); // id INT NOT NULL AUTO_INCREMENT
            $table->string('name', 50);
            $table->enum('type', ['daily', 'weekly', 'monthly', 'yearly', 'custom']);
            $table->integer('interval')->nullable(); // a cada tantos dias
            $table->integer('day_of_month')->nullable(); // todo dia X de cada mês
            $table->enum('week_day', ['domingo', 'segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sabado'])->nullable();
            $table->date('start_date')->nullable(); // início da recorrência
            $table->date('end_date')->nullable(); // fim da recorrência
            $table->integer('occurrences')->nullable(); // vezes que vão ocorrer, null = infinito/indeterminado

            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurrence_types');
    }
};
