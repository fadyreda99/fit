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
        Schema::create('customer_macros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nutritional_id');
            $table->foreign('nutritional_id')->references('id')
                ->on('customer_nutritional_infos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('target_amr');
            $table->float('protien_in_grams');
            $table->float('protien_in_kcals');
            $table->float('carb_in_grams');
            $table->float('carb_in_kcals');
            $table->float('fat_in_grams');
            $table->float('fat_in_kcals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_macros');
    }
};
