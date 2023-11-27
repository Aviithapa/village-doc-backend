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
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescription_id');
            $table->string('medication_name');
            $table->string('dosage');
            $table->string('quantity');
            $table->enum('form',['TABLET', 'CAPSULE', 'LIQUID'])->default('TABLET');
            $table->enum('route',['ORAL', 'INTRAVENOUS', 'TROPICAL'])->default('ORAL');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medications');
    }
};
