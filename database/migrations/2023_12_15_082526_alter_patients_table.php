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
        Schema::table('patients',function(Blueprint $table){
            $table->integer('age')->nullable();
            $table->string('religion')->nullable();
            $table->enum('marital_status',['SINGLE','MARRIED','DIVORCED'])->default('SINGLE');
            $table->boolean('is_house_head')->default(0);
            $table->string('contact_no')->nullable();
            $table->string('househead_no')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients',function(Blueprint $table){
            $table->dropColumn('age');
            $table->dropColumn('religion');
            $table->dropColumn('marital_status');
            $table->dropColumn('is_house_head');
            $table->dropColumn('contact_no');
            $table->dropColumn('househead_no');
            $table->dropColumn('patient_id');
        });
    }
};
