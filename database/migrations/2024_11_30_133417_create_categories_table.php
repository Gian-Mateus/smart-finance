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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // id INT NOT NULL AUTO_INCREMENT
            $table->foreignId('user_id')->constrained('users')
                                        ->cascadeOnDelete()
                                        ->cascadeOnUpdate(); // user_id INT NOT NULL
            $table->string('name', 100); // name VARCHAR(100) NOT NULL
            $table->string('icon', 50)->nullable(); // icon VARCHAR(50) NOT NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
