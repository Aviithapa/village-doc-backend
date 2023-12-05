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
        Schema::create('medical_record_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_record_id');
            $table->text('description')->nullable();
            $table->text('reaction')->nullable();
            $table->enum('status',['CONNECTED','NOT CONNECTED','THIRD PERSON'])->default('NOT CONNECTED');
            $table->boolean('prescription')->default(false);
            $table->boolean('consult_doctor')->default(false);
            $table->timestamps();

            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_record_descriptions');
    }
};
