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
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('original_name');
            $table->string('mime_type')->nullable();
            $table->string('path');
            $table->string('collection')->nullable();
            $table->string('disk')->nullable();
            $table->enum('type', ['PHOTO', 'TEST_REPORT', 'OTHER'])->default('OTHER');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('medical_record_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
