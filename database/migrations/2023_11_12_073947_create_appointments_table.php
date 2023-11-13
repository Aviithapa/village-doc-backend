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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients', 'id');
            $table->foreignId('doctor_id')->constrained('doctors', 'id')->nullable();
            $table->foreignId('medical_record_id')->constrained('medical_records', 'id')->nullable();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->text('reason');
            $table->enum('status', ['queried', 'scheduled', 'completed', 'canceled'])->default('queried');
            $table->boolean('urgent')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->index(['appointment_date', 'appointment_time']); // Index for date and time for better query performance
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
