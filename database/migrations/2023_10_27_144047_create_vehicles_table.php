<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('vehicles', function (Blueprint $table) {
        $table->id();
        $table->string('brand');
        $table->string('model');
        $table->integer('year');
        $table->integer('seats');
        $table->decimal('deposit', 8, 2);
        $table->decimal('price', 8, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
