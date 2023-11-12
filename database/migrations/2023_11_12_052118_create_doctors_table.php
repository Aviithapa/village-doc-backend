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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('salutation')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('Specialization');
            $table->string('nmc_number')->unique();
            $table->enum('gender', ['MALE', 'FEMALE', 'OTHER'])->default('MALE');
            $table->string('contact_number')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->date('hiring_date');
            $table->string('email');
            $table->text('address');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
