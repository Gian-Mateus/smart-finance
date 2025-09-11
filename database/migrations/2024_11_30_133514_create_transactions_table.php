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
            $table->string('id_transaction_external');

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate(); // FOREIGN KEY usuario_id

            $table->foreignId('bank_account_id')
                ->constrained('banks_accounts')
                ->cascadeOnUpdate()
                ->nullOnDelete(); // FOREIGN KEY banco_id

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('subcategory_id')
                ->nullable()
                ->constrained('subcategories')
                ->cascadeOnUpdate()
                ->nullOnDelete(); // FOREIGN KEY subcategoria_id

            $table->foreignId('recurrence_types_id')
                ->nullable()
                ->constrained('recurrence_types')
                ->cascadeOnUpdate()
                ->nullOnDelete(); // FOREIGN KEY periodicidade_id

            $table->foreignId('payment_methods_id')
                ->constrained('payment_methods')
                ->cascadeOnUpdate()
                ->nullOnDelete(); // FOREIGN KEY forma_pagamento_id

            $table->integer('value'); // valor INT() NOT NULL
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
