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
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->string("code")->unique();
            $table->string("name");
            $table->text("detail")->nullable();
            $table->text("observation_detail")->nullable();
            $table->integer("cant");
            $table->enum("line", ["parte", "suministro", "respuesto"]);
            $table->string("brand");
            $table->enum("unit",
                    ["unidades",
                    "kilogramos",
                    "litros"
                ]);
            $table->enum("observation", ["conforme", "con modificaciones"]);
            $table->enum("status", ["alta", "baja"])->default('alta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies');
    }
};
