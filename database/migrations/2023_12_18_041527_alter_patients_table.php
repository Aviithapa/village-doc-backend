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
        Schema::table('patients', function (Blueprint $table) {
            $table->string('blood_group')->nullable();
            $table->string('citizenship_no')->nullable();
            $table->string('insurance_no')->nullable();
            $table->string('nid_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('blood_group');
            $table->dropColumn('citizenship_no');
            $table->dropColumn('insurance_no');
            $table->dropColumn('nid_no');
        });
    }
};
