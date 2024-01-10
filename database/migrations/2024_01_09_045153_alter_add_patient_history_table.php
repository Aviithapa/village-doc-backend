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
        Schema::table('patient_histories', function( Blueprint $table){
            $table->longText('socio_economic')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_histories', function( Blueprint $table){
            if (Schema::hasColumn('patient_histories', 'socio_economic')) {
                $table->dropColumn('socio_economic');
            }
        });
    }
};
