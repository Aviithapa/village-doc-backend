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
        Schema::table('appointments', function($table) {
            $table->dropColumn('status');
        });

        Schema::table('appointments', function($table) {
            $table->enum('status',['QUERIED','SCHEDULED','COMPLETED', 'CANCELED','RESCHEDULED'])->default('QUERIED')->after('reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function($table) {
            $table->dropColumn('status');
        });

        Schema::table('appointments', function($table) {
            $table->enum('status', ['queried', 'scheduled', 'completed', 'canceled'])->default('queried')->after('reason');
        });
    }
};
