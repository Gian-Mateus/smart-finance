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
        Schema::create('subcategories_budget', function (Blueprint $table) {
            $table->id(); // id INT NOT NULL AUTO_INCREMENT
            $table->foreignId('subcategory_id')->constrained('subcategories'); // FOREIGN KEY subcategoria_id
            $table->foreignId('category_id')->constrained('categories'); // FOREIGN KEY categoria_id
            $table->decimal('budgeted_amount', 10, 2); // valor_orcado DECIMAL(10,2) NOT NULL
            $table->date('month_reference'); // mes_referencia DATE NOT NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories_budget');
    }
};
