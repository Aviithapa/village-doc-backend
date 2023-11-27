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
        Schema::create('doctor_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->string('name')->nullable();
            $table->enum('day_of_week',['SUNDAY','MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY'])->default('SUNDAY');
            $table->enum('day_period',['MORNING','DAY','EVENING','NIGHT'])->default('DAY');
            $table->string('work_from');
            $table->string('work_to');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('doctor_id')
                    ->references('id')
                    ->on('doctors')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_schedules');
    }
};
