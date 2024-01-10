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
        Schema::dropIfExists('obstretic_histories');
        Schema::create('obstetric_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('year_of_marriage')->nullable();
            $table->integer('no_of_pregnancy')->nullable();
            $table->string('outcome_of_pregnancy')->nullable();
            $table->string('complication_during_pregnancy')->nullable();
            $table->string('mode_of_delivery')->nullable();
            $table->string('last_child_birth')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('medical_record_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obstetric_histories');
        Schema::create('obstretic_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('year_of_marriage')->nullable();
            $table->integer('no_of_pregnancy')->nullable();
            $table->string('outcome_of_pregnancy')->nullable();
            $table->string('complication_during_pregnancy')->nullable();
            $table->string('mode_of_delivery')->nullable();
            $table->string('last_child_birth')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('medical_record_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');
        });
    }
};
