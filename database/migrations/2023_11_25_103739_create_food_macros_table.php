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
        Schema::create('food_macros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('food_id');
            $table->foreign('food_id')->references('id')
                ->on('foods')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('protien')->comment('in gram per each gram of food');
            $table->float('carb')->comment('in gram per each gram of food');
            $table->float('fat')->comment('in gram per each gram of food');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_macros');
    }
};
