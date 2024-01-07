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
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->boolean('well_oriented')->default(false);
            $table->boolean('in_pain')->default(false);
            $table->integer('eye_opening_gcs')->nullable();
            $table->integer('verbal_response_gcs')->nullable();
            $table->integer('motor_response_gcs')->nullable();
            $table->text('inspection')->nullable();
            $table->text('palpation')->nullable();
            $table->text('percussion')->nullable();
            $table->text('auscultation')->nullable();
            $table->longText('head_toe_examination')->nullable();
            $table->enum('from', ['AI', 'PHYSICIAN', 'HEALTH-WORKER', 'DOCTOR'])->default('HEALTH-WORKER');
            $table->unsignedBigInteger('medical_record_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};
