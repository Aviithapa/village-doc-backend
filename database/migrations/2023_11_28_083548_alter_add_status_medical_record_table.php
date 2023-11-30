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
        Schema::table('medical_records', function (Blueprint $table) {
            $table->enum('status',['Pending','Appointment Booked','Consulting','Rescheduled','Follow Up','Closed'])->default('Pending')->after('diagnosis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_records', function($table) {
            $table->dropColumn('status');
        });
    }
};
