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
        Schema::table('medications',function(Blueprint $table){
            $table->dropColumn('prescription_id');
            $table->unsignedBigInteger('medical_record_id')->nullable();
            $table->string('timing')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->text('notes')->nullable();
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medications',function(Blueprint $table){
            $table->unsignedInteger('prescription_id')->nullable();
            $table->dropForeign(['medical_record_id']);
            $table->dropColumn('medical_record_id');
            $table->dropColumn('timing');
            $table->dropColumn('from');
            $table->dropColumn('to');
            $table->dropColumn('notes');
        });
    }
};
