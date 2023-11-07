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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->enum('from', ['AI', 'PHYSICIAN', 'HEALTH-WORKER'])->default('HEALTH-WORKER');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('medical_record_id')->nullable();
            $table->date('prescription_date')->nullable();
            $table->text('suggested_treatment'); //Suggested treatment
            $table->text('notes')->nullable();
            $table->boolean('implementation')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
