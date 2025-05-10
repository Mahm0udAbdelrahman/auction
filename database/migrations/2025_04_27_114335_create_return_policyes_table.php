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
        Schema::create('return_policyes', function (Blueprint $table) {
            $table->id();
            $table->text('message_ar');
            $table->text('message_en');
            $table->text('message_ru');
            $table->foreignId('country_id')->constrained('countries', 'id')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_policyes');
    }
};
