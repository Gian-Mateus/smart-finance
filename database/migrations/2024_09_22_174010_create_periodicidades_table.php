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
        Schema::create('periodicidade', function (Blueprint $table) {
            $table->id(); // id INT NOT NULL AUTO_INCREMENT
            $table->string('nome', 50); // nome VARCHAR(50) NOT NULL
            $table->integer('intervalo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodicidades');
    }
};