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
        Schema::table('customer_nutritional_infos', function (Blueprint $table) {
            $table->string('excess_fat')->change();
            $table->string('FFM')->change();
            $table->string('LBM')->change();
            $table->string('activity_factor')->change();
            $table->string('protien_factor')->change();
            $table->string('AMR')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_nutritional_infos', function (Blueprint $table) {
            $table->float('excess_fat')->change();
            $table->float('FFM')->change();
            $table->float('LBM')->change();
            $table->float('activity_factor')->change();
            $table->float('protien_factor')->change();
            $table->float('AMR')->change();
        });
    }
};
