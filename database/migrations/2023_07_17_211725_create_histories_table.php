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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->text("datos_antiguos")->nullable();
            $table->text("datos_nuevos");
            $table->text("status_detail")->nullable();
            $table->enum("type", ["actualizacion", "primer ingreso","salida","eliminacion"]);
            $table->enum("status", ["conforme", "con modificaciones"]);

            $table->unsignedBigInteger('supply_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();


            $table->foreign('supply_id')
            ->references('id')
            ->on('supplies')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
