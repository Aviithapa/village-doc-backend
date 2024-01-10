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
        Schema::table('pilccods', function ($table) {
            $table->dropColumn('lyimphadenopathy');
            $table->dropColumn('cynaosis');
            $table->dropColumn('dedema');

            $table->boolean('lymphadenopathy')->default(false);
            $table->boolean('cyanosis')->default(false);
            $table->boolean('oedema')->default(false);
        });

        Schema::table('medical_record_complaints', function ($table) {
            $table->dropForeign(['compalint_id']);
            $table->dropColumn('compalint_id');

            $table->unsignedBigInteger('complaint_id')->nullable()->after('id');
            $table->foreign('complaint_id')->references('id')->on('complaints')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_record_complaints', function ($table) {
            $table->dropForeign(['complaint_id']);
            $table->dropColumn('complaint_id');

            $table->unsignedBigInteger('compalint_id')->nullable()->after('id');
            $table->foreign('compalint_id')->references('id')->on('complaints')->onDelete('cascade');
        });
    }
};
