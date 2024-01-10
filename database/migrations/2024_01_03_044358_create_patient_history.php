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

        Schema::dropIfExists('past_medical_histories');
        Schema::create('patient_histories', function (Blueprint $table) {
            $table->id();
            $table->text('medical_history')->nullable();
            $table->text('surgical_history')->nullable();
            $table->text('birth_history')->nullable();
            $table->text('treatment_history')->nullable();
            $table->text('immunization_history')->nullable();
            $table->text('nutrition_history')->nullable();
            $table->text('development_history')->nullable();
            $table->json('contraception_history')->nullable();
            $table->json('personal_history')->nullable();
            $table->json('family_history')->nullable();
            $table->boolean('reproductive_plans')->nullable();
            $table->unsignedBigInteger('medical_record_id')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('medical_record_id')
                ->references('id')
                ->on('medical_records')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_histories');
        Schema::create('past_medical_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->longText('medical_history')->nullable();
            $table->longText('surgical_history')->nullable();
            $table->longText('family_history')->nullable();
            $table->longText('personal_history')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }
};
