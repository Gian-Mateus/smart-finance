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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id(); // id INT NOT NULL AUTO_INCREMENT
            $table->foreignId('category_id')->constrained('categories') // FOREIGN KEY (categories_id)
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('user_id')->constrained('users') // Verificar se é necessário o campo user_id, pois categories já há relacionamento com users
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('name', 100); // name VARCHAR(100) NOT NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
