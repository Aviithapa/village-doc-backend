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
        Schema::create('medical_record_unit_week', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->nullable()->constrained('medical_records', 'id');
            $table->foreignId('patient_id')->nullable()->constrained('patients', 'id');
            $table->integer('percentage_of_alcohol');
            $table->integer('percentage_per_day');
            $table->integer('volume_consumed');
            $table->float('days_count',8,2);
            $table->integer('volume_consumed_per_week');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_record_unit_week');
    }
};
