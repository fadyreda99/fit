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
        Schema::table('progress_infos', function (Blueprint $table) {
            $table->string('current_weight')->change();
            $table->string('current_body_fat')->change();
            $table->string('current_excess_fat')->change();
            $table->string('current_LBM')->change();
            $table->string('current_FFM')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('progress_infos', function (Blueprint $table) {
            $table->float('current_weight')->change();
            $table->float('current_body_fat')->change();
            $table->float('current_excess_fat')->change();
            $table->float('current_LBM')->change();
            $table->float('current_FFM')->change();
        });
    }
};
