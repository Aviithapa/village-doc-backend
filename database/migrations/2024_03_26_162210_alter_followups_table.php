<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('follow_ups', function (Blueprint $table) {
            DB::table('follow_ups')->update(['add_on_symptom' => NULL]); // if there is data in add_on_symptom columns it shows integrity contraints violation error
            $table->json('add_on_symptom')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('follow_ups', function (Blueprint $table) {
            $table->text('add_on_symptom')->nullable()->change();
        });
        //
    }
};
