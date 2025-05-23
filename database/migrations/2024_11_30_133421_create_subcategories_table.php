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
            $table->foreignId('category_id')->constrained('categories')
                                            ->onUpdate('cascade')
                                            ->onDelete('cascade'); // FOREIGN KEY (categories_id)
            // Verificar se é necessário o campo user_id, pois categories já há relacionamento com users
            $table->foreignId('user_id')->constrained('users');
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
