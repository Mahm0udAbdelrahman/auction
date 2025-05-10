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
        Schema::create('balance_insurances', function (Blueprint $table) {
            $table->id();
            $table->enum('service', ['vendor','buyer'])->nullable();
            $table->enum('category', ['dealer','my'])->nullable();
            $table->string('min_balance');
            $table->string('currency');
            $table->foreignId('country_id')->constrained('countries','id')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_insurances');
    }
};
