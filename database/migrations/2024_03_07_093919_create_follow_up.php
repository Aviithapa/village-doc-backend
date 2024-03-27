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
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_record_id')->nullable();
            $table->text('add_on_symptom')->nullable();
            $table->text('reaction')->nullable();
            $table->enum('condition', ['IMPROVING-SUBSIDE', 'NOT-IMPROVING'])->default('NOT-IMPROVING');
            $table->boolean('medication')->default(false);
            $table->timestamps();

            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_up');
    }
};
