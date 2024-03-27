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
        Schema::create('follow_up_vitals', function (Blueprint $table) {
            $table->id();
            $table->enum('TPRBS', ['BLOOD-PRESSURE', 'PULSE', 'TEMPERATURE-°F', 'RESPIRATION', 'SPO2'])->nullable();
            $table->string('value')->nullable();
            $table->unsignedBigInteger('follow_up_id')->nullable();
            $table->foreign('follow_up_id')->references('id')->on('follow_ups')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vitals_follow_up');
    }
};
