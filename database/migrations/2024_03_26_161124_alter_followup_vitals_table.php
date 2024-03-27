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
        Schema::table('follow_up_vitals', function (Blueprint $table) {
            $table->dropColumn('TPRBS');
            $table->dropColumn('value');

            $table->string('blood_pressure')->after('follow_up_id')->nullable();
            $table->string('pulse')->after('blood_pressure')->nullable();
            $table->string('temperature')->after('pulse')->nullable();
            $table->string('respiration')->after('temperature')->nullable();
            $table->string('saturation')->after('respiration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('follow_up_vitals', function (Blueprint $table) {

            $table->enum('TPRBS', ['BLOOD-PRESSURE', 'PULSE', 'TEMPERATURE-°F', 'RESPIRATION', 'SPO2'])->nullable();
            $table->string('value')->nullable();

            $table->dropColumn('blood_pressure');
            $table->dropColumn('pulse');
            $table->dropColumn('temperature');
            $table->dropColumn('respiration');
            $table->dropColumn('saturation');
        });
    }
};
