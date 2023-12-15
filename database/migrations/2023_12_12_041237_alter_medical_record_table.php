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
        Schema::table('medical_records',function(Blueprint $table){
            $table->longText('hopi')->nullable()->after('diagnosis');
        });

        Schema::table('prescriptions',function(Blueprint $table){
            $table->longText('provisional_diagnosis')->nullable()->after('implementation');
            $table->longText('examination')->nullable()->after('provisional_diagnosis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_records', function($table) {
            $table->dropColumn('hopi');
        });

        Schema::table('prescriptions', function($table) {
            $table->dropColumn('provisional_diagnosis');
            $table->dropColumn('examination');
        });
    }
};
