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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('year');
            $table->string('color');
            $table->decimal('price_per_day', 10, 2);
            $table->decimal('security_deposit_per_day', 10, 2)->nullable();
            $table->decimal('security_deposit_fixed', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->json('options')->nullable(); // For storing car options list
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
