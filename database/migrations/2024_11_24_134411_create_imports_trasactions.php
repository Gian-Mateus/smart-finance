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
        Schema::create('imports_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('import_id')->constrained('imports');
            $table->foreignId('transaction_id')->constrained('transactions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imports_transactions');
    }
};
