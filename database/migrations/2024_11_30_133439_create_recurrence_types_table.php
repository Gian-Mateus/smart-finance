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
            $table->json('interval');
            /* 
                {
                    ??? "interval": 1,               // Quantos dias, semanas ou meses entre repetições
                    "type": "monthly",               // "daily", "weekly", "monthly", yearly, "custom"
                    "custom_days": [5, 20],          // Se for customizado, quais dias do mês (cada 5 e 20 de cada mês)
                    "day_of_month": 8,               // Se for mensal, em qual dia do mês
                    "week_day": null,                // Se for semanal, qual dia da semana (0 = Domingo, 6 = Sábado)
                    "start_date": "2025-06-01",      // Quando começa a recorrência
                    "end_date": "2027-01-01",        // Quando termina (pode ser null pra infinito)
                    "occurrences": null,             // Alternativa ao end_date: número total de vezes
                    "description": "Mensal no dia 8 por 20 meses"
                }
            */
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
