<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->decimal('price_per_day', 8, 2);
            $table->decimal('price_caution', 8, 2);
            $table->integer('total_km');
            $table->string('transmission'); /**Manueel of Automatisch */
            $table->integer('seats');
            $table->string('fuel_type'); // Diesel/Essence/Electrique
            $table->string('photo')->nullable();
            $table->boolean('disponible')->default(true);
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
