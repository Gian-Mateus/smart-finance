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
        Schema::create('imports', function (Blueprint $table) {
            $table->id(); // id INT NOT NULL AUTO_INCREMENT
            $table->foreignId('user_id')->constrained('users');
            $table->string('file_name', 50); // nome_arquivo VARCHAR(50) NOT NULL
            $table->string('file_type', 50); // tipo_arquivo VARCHAR(50) NOT NULL
            $table->timestamp('imported_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_statements');
    }
};
