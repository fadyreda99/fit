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
        Schema::create('customer_nutritional_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('excess_fat');
            $table->float('FFM');
            $table->float('LBM');
            $table->string('game');
            $table->float('activity_factor');
            $table->float('protien_factor');
            $table->float('AMR');
            $table->enum('program_type', ['bulking', 'lose_weight', 'cutting']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_nutritional_infos');
    }
};
