<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('medias',function(Blueprint $table){
            $table->unsignedBigInteger('doctor_id')->nullable();
            DB::statement("ALTER TABLE medias MODIFY `type` ENUM('PHOTO', 'TEST_REPORT', 'SIGNATURE','OTHER')");
            
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medias',function(Blueprint $table){
            $table->dropForeign(['doctor_id']);
            $table->dropColumn('doctor_id');
            DB::statement("ALTER TABLE medias MODIFY `type` ENUM('PHOTO', 'TEST_REPORT','OTHER')");

        });
    }
};
