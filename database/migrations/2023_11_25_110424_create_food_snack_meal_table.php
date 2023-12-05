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
        Schema::create('food_snack_meal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('snack_meal_id');
            $table->foreign('snack_meal_id')->references('id')
                ->on('snack_meals')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('food_id');
            $table->foreign('food_id')->references('id')
                ->on('foods')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('grams');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_snack_meal');
    }
};