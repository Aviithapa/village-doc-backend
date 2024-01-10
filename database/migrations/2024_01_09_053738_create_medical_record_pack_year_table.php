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
        Schema::create('medical_record_pack_year', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->nullable()->constrained('medical_records', 'id');
            $table->foreignId('patient_id')->nullable()->constrained('patients', 'id');
            $table->integer('no_of_cigarettes');
            $table->integer('pack_per_day');
            $table->float('duration',8,2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_record_pack_year');
    }
};
