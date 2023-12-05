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
            $table->string('BMR')->after('protien_factor');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_nutritional_infos', function (Blueprint $table) {
           $table->dropColumn('BMR');
        });
    }
};
