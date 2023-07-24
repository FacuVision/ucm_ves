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
        Schema::create('motion_supply', function (Blueprint $table) {

        $table->id();

        $table->unsignedBigInteger('motion_id');
        $table->unsignedBigInteger('supply_id');


        $table->integer('cant');
        $table->float('motion_price', 8, 2);


        //RELACIONES
        $table->foreign('motion_id')
        ->references('id')
        ->on('motions')
        ->onDelete('cascade')
        ->onUpdate('cascade');

         //RELACIONES
         $table->foreign('supply_id')
         ->references('id')
         ->on('supplies')
         ->onDelete('cascade')
         ->onUpdate('cascade');

            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motion_supply');
    }
};
