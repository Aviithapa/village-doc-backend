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
        Schema::create('medical_record_complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compalint_id');
            $table->unsignedBigInteger('medical_record_id');
            $table->string('duration');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('compalint_id')->references('id')->on('complaints')->onDelete('cascade');
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_record_complaints');
    }
};
