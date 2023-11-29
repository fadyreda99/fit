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
        Schema::table('customer_basic_info', function (Blueprint $table) {
            $table->string('weight')->change();
            $table->string('height')->change();
            $table->string('body_fat')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_basic_info', function (Blueprint $table) {
            $table->float('weight')->change();
            $table->float('height')->change();
            $table->float('body_fat')->change();
        });
    }
};
