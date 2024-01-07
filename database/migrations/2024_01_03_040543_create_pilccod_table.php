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
        Schema::create('pilccods', function (Blueprint $table) {
            $table->id();
            $table->boolean('pallor')->default(false);
            $table->boolean('icterus')->default(false);
            $table->boolean('lyimphadenopathy')->default(false);
            $table->boolean('clubbing')->default(false);
            $table->boolean('cynaosis')->default(false);
            $table->boolean('dedema')->default(false);
            $table->boolean('dehydration')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedBigInteger('medical_record_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('medical_record_id')
                ->references('id')
                ->on('medical_records')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilccods');
    }
};
