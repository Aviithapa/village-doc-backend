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
        Schema::table('vitals',function(Blueprint $table){
            $table->dropForeign(['patient_id']);
            $table->dropColumn('patient_id');
            $table->dropColumn('date_of_measurement');
            $table->dropColumn('name');
            $table->dropColumn('measurement');

            $table->unsignedBigInteger('medical_record_id')->after('id')->nullable();
            $table->string('blood_pressure')->after('medical_record_id')->nullable();
            $table->string('pulse')->after('blood_pressure')->nullable();
            $table->string('temperature')->after('pulse')->nullable();
            $table->string('respiration')->after('temperature')->nullable();
            $table->string('saturation')->after('respiration')->nullable();
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vitals',function(Blueprint $table){
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->date('date_of_measurement')->nullable();
            $table->string('name')->nullable();
            $table->string('measurement')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            $table->dropForeign(['medical_record_id']);
            $table->dropColumn('medical_record_id');
            $table->dropColumn('blood_pressure');
            $table->dropColumn('pulse');
            $table->dropColumn('temperature');
            $table->dropColumn('respiration');
            $table->dropColumn('saturation');
        });
    }
};
