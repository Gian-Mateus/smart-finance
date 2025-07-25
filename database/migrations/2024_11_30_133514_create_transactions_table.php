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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // id INT NOT NULL AUTO_INCREMENT
            $table->foreignId('user_id')->constrained('users'); // FOREIGN KEY usuario_id
            $table->foreignId('bank_account_id')->constrained('banks_accounts')->cascadeOnDelete(); // FOREIGN KEY banco_id
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('subcategory_id')->nullable()->constrained('subcategories')->nullOnDelete(); // FOREIGN KEY subcategoria_id
            $table->foreignId('recurrence_types_id')->constrained('recurrence_types'); // FOREIGN KEY periodicidade_id
            $table->foreignId('payment_methods_id')->constrained('payment_methods'); // FOREIGN KEY forma_pagamento_id
            $table->decimal('value', 10, 2); // valor DECIMAL(10,2) NOT NULL
            $table->date('date'); // data DATE NOT NULL
            $table->string('description', 255); // descricao VARCHAR(255) NOT NULL
            $table->text('observation')->nullable(); // observacao TEXT NULL
            $table->boolean('type'); // 0 = débito / 1 = crédito
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
