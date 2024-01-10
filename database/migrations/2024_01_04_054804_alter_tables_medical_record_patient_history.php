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
        //
        Schema::table(
            'patient_histories',
            function ($table) {
                $table->dropColumn('treatment_history');
            }
        );
        Schema::table('medical_records', function ($table) {
            $table->dropColumn('notes');
            $table->dropColumn('hopi');
            $table->dropColumn('diagnosis');
            $table->string('treatment_history')->nullable();
            $table->boolean('reproductive_plan')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_histories',function ($table) {
                $table->text('treatment_history')->nullable();
            }
        );
        Schema::table('medical_records', function ($table) {
            $table->text('notes')->nullable();
            $table->text('hopi')->nullable();
            $table->text('diagnosis')->nullable();
            $table->dropColumn('treatment_history');
            $table->dropColumn('reproductive_plan');
        });
    }
};
