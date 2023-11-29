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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('excess_fat')->nullable();
            $table->string('LBM')->nullable();
            $table->string('FFM')->nullable();
            $table->string('BMR')->nullable();
            $table->string('AMR')->nullable();
            $table->string('bulking')->nullable();
            $table->string('deficet')->nullable();
            $table->string('protien')->nullable();
            $table->string('fat')->nullable();
            $table->string('carb')->nullable();
            $table->string('water')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
