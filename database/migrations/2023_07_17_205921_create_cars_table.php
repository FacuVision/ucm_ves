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
            //$table->enum("status", ["borrador", "registrado"]);
            $table->string("type"); //tipo
            $table->string("plate"); //placa
            $table->string("mileage"); //kilometraje
            $table->string("brand"); //marca
            $table->string("color"); //color
            $table->string("model"); // modelo
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
