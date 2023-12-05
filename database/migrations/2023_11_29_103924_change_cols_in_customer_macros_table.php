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
        Schema::table('customer_macros', function (Blueprint $table) {
            $table->string('target_amr')->change();
            $table->string('protien_in_grams')->change();
            $table->string('protien_in_kcals')->change();
            $table->string('carb_in_grams')->change();
            $table->string('carb_in_kcals')->change();
            $table->string('fat_in_grams')->change();
            $table->string('fat_in_kcals')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_macros', function (Blueprint $table) {
            $table->float('target_amr')->change();
            $table->float('protien_in_grams')->change();
            $table->float('protien_in_kcals')->change();
            $table->float('carb_in_grams')->change();
            $table->float('carb_in_kcals')->change();
            $table->float('fat_in_grams')->change();
            $table->float('fat_in_kcals')->change();
        });
    }
};
